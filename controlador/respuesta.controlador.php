<?php

require_once 'modelo/respuesta.php';

class respuestaControlador {

    private $model;

    public function __construct() {
        $this->model = new respuesta();
    }

    public function Index() {
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

        //objeto respuesta almacena campos.
        //Primeros atributos son del objeto
        //Segundos son del form (name="lo que sea")
        $respuesta->id = $_REQUEST['id'];
        $respuesta->Titulo = $_REQUEST['titulo'];
        $respuesta->Fecha = $_REQUEST['fecha'];
        $respuesta->Comentario = $_REQUEST['comentario'];
        $respuesta->Fichero = $_REQUEST['fichero'];


        $respuesta->id > 0 ? $this->model->Actualizar($respuesta) : $this->model->Registrar($respuesta);

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
        //header('Location: index.php');
    }

}
