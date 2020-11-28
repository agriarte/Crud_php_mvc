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
        
        //controlar la entrada del archivo. Errores y mover de temp a mi carpeta imagenes
            if ($_FILES['fichero']['error']) {
                switch ($_FILES['fichero']['error']) {
                    case 1://UPLOAD_ERR_INI_SIZE
                        echo "Tamaño de archivo excedido según archivo PHP.ini<br>";
                        break;
                    case 2://UPLOAD_ERR_FORM_SIZE
                        echo "Tamaño de archivo excedido según form html. 2 Mb<br>";
                        break;
                    case 3://UPLOAD_ERR_PARTIAL
                        echo "El envío de archivo se interrumpió<br>";
                        break;
                    case 4://UPLOAD_ERR_NO_FILE
                        echo "No se ha enviado ninguna imagen<br>";
                        break;
                }
            } else {
                echo "Entrada subida correctamente <br>";
                if ((isset($_FILES['fichero']['name']) && ($_FILES['fichero']['error'] == UPLOAD_ERR_OK))) {
                    $destino_imagenes = "./upload/";
                    move_uploaded_file($_FILES['fichero']['tmp_name'], $destino_imagenes . $_FILES['fichero']['name']);

                    echo "El archivo " . $_FILES['fichero']['name'] . " se ha copiado al directorio<br>";
                } else {
                    echo "Error. No se ha copiado el archivo<br>";
                }
            }
        
        
        $respuesta = new respuesta();

//objeto respuesta almacena campos.
//Primeros atributos son del objeto
//Segundos son del form (name="lo que sea")
        $respuesta->id = $_REQUEST['id'];
        $respuesta->Titulo = $_REQUEST['titulo'];
        $respuesta->Fecha = $_REQUEST['fecha'];
        $respuesta->Comentario = $_REQUEST['comentario'];
        $respuesta->Fichero = $_FILES['fichero']['name'];


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

}
