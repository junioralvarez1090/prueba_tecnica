<?php
date_default_timezone_set('America/Bogota');
setlocale(LC_MONETARY, 'es_US');
define('_HOY_',date('Y-m-d'));
@session_start();
require_once('./config.php');
require_once('./codex/lib/validacion.php');
require_once('./codex/lib/database.php');

/* Controlador por defecto */
$controller = 'portal';


// Todo esta lógica hara el papel de un FrontController
if(!isset($_REQUEST['c']))
{
    require_once "./codex/controller/" .$controller. "Controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    // Instanciamos el controlador
    require_once "./codex/controller/".$controller."Controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}