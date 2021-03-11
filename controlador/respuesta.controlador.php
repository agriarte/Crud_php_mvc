<?php

require_once 'modelo/respuesta.php';

class respuestaControlador {

    private $model;

    public function __construct() {
        $this->model = new respuesta();
    }

    public function Inicio() {
        require_once 'vista/header.php';
        require_once 'vista/respuesta/respuesta.php';
    }

    public function Crud() {
        $respuesta = new respuesta();

        if (isset($_REQUEST['id'])) {
            $respuesta = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'vista/header.php';
        require_once 'vista/respuesta/respuesta-editar.php';
    }

    public function Guardar() {

        $respuesta = new respuesta();

        $miId = $_REQUEST['id'];

        $fichero = $_REQUEST['ficherodb'];

        $imagenCopia = $_REQUEST['imagen-copia'];
       
        //ID
        //Nuevo registro: no hay Id buscar el ultimo y incrementar en 1
        //si hay id se usa el actual del registro
        //OJO! el if con isset() no funciona a pesar de que no tiene contenido si id no existe
        if ($_REQUEST['id'] > 0) {
            $miId = $_REQUEST['id'];
        } else {
            $ultimoId = $this->model->getUltimoId();
            $miId = $ultimoId + 1;
        }


        //IMAGEN
        //si pulsamos borrar llegan "".
        //si ya existía una imagen (ficherodb) se debe borrar
        if ($_REQUEST['cambio'] == "") {
            //comprobar si existe imagen anterior para borrarla
            if ($_REQUEST['ficherodb'] != "") {
                $ficheroAntiguo = $_REQUEST['ficherodb'];
                unlink('./upload/' . $ficheroAntiguo);
            }
            $respuesta->Fichero = "";
        }
        //si no tocamos el campo imagen llega "igual"
        if ($_REQUEST['cambio'] == "igual") {
            // no cambiar valores
            $respuesta->Fichero = $_REQUEST['ficherodb'];
        }


        //si no llega "" ni "igual" viene un blob con imagen
        if (($_REQUEST['cambio'] != "igual") && ($_REQUEST['cambio'] != "")) {
            //crear nombre único de fichero
            $nombreunico = "id" . $miId . "_" . $_FILES['nombreFichero']['name'];

            //crear y guardar imagen en directorio ./upload
            if (!empty($_POST['imagen-copia'])) {
                //prefijo que concateno a las imagenes para que tengan nombre único, añado numid_

                file_put_contents('./upload/' . $nombreunico, file_get_contents($_POST['imagen-copia']));
            } else {
                //todo:
                //como no viene blob comprobar valor de REGISTRO con valor de idxx_nombrefichero
                //si son iguales se mantiene nombre unico, si son diferentes file_put_contents
                if ($this->model->Fichero != $nombreunico) {
                    $nombreunico = "id" . $miId . "_" . $_FILES['nombreFichero']['name'];
                    file_put_contents('./upload/' . $nombreunico, file_get_contents($_POST['imagen-copia']));
                }
            }
        }


        //objeto respuesta almacena campos.
        //Primeros atributos son del objeto
        //Segundos son del form (name="lo que sea")
        $respuesta->id = $_REQUEST['id'];
        $respuesta->Titulo = $_REQUEST['titulo'];
        $respuesta->Fecha = $_REQUEST['fecha'];
        $respuesta->Comentario = $_REQUEST['comentario'];

        $respuesta->Fichero = $nombreunico;

        ($respuesta->id > 0 ? $this->model->Actualizar($respuesta) : $this->model->Registrar($respuesta));

        header('Location: index.php');
    }

    public function Eliminar() {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

    public function Buscar() {

        $datos = $_REQUEST['t'] ? $_REQUEST['t'] : "";


        $respuesta = $this->model->Buscar($datos);
        require_once 'vista/header.php';
        require_once 'vista/respuesta/respuesta.php';
    }

    public function updateArchivo() {
        //request id trae el ID)
        $miId = $_REQUEST['id'];

        $this->model->actualizaFichero_vacio($miId);
        header('Location: index.php');
    }

}
