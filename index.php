<?php
require_once 'modelo/Database.php';

$controller = 'respuesta';

// Todo esta lógica es el FrontController
// Si no hay argumentos por URL lanza método Index de controller Respuesta
//primer caso: no hay controller ni acción.
//acción = Inicio. (carga vista Respuesta sin resultados
if(!isset($_REQUEST['c']))
{
    require_once "controlador/$controller.controlador.php";
    $controller = ucwords($controller) . 'Controlador';
    $controller = new $controller;
    $controller->Inicio();    
}
else
{
    //segundo caso: viene un controller con una acción
    // si vienen datos obtenemos el controlador que queremos cargar
    // y el método (acción)
    $controller = strtolower($_REQUEST['c']);
    //$accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    $accion = $_REQUEST['a'];
    
   
    // Instanciamos el controlador
    require_once "controlador/$controller.controlador.php";
    $controller = ucwords($controller) . 'Controlador';
    $controller = new $controller;
    

    // Llama la accion
    call_user_func( array( $controller, $accion) );
}
