<?php

//Si no hay una sesión iniciada te manda al Login
if(!isset($_SESSION['usuarioDAW2AplicacionFinal'])){ 
    header('Location: index.php');
    exit;
}
//Si se ha pulsado Cancelar
if (isset($_REQUEST['volver'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del login
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['detalle']; 
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['detalle'];