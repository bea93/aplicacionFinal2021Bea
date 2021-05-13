<?php

//Si el usuario no ha iniciado sesión se le redirige al login.php
if(!isset($_SESSION['usuarioDAW2AplicacionFinal'])){ 
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón de Cerrar Sesión
if (isset($_REQUEST['cerrarSesion'])) {
    //Destruye todos los datos asociados a la sesión
    session_destroy();
    //Redirige al login.php
    header("Location: index.php"); 
    exit;
}
//Si se ha pulsado el botón de detalle
if (isset($_REQUEST['detalle'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['detalle']; 
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón de editar
if (isset($_REQUEST['editar'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['editar']; 
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón Borrar Cuenta
if (isset($_REQUEST['borrarCuenta'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del editor de contraseña
    $_SESSION['paginaEnCurso'] = $controladores['borrarCuenta'];
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón MtoDepartamentos
if (isset($_REQUEST['mtoDepartamentos'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del editor de contraseña
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón REST
if (isset($_REQUEST['rest'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del editor de contraseña
    $_SESSION['paginaEnCurso'] = $controladores['rest'];
    header('Location: index.php');
    exit;
}

$oUsuarioActual = $_SESSION['usuarioDAW2AplicacionFinal'];

//Variables que almacenan los datos del usuario sacadas de la BBDD
$numConexiones = $oUsuarioActual->getNumConexiones();
$descUsuario = $oUsuarioActual->getDescUsuario();
$ultimaConexionAnterior = $_SESSION['fechaHoraUltimaConexionAnterior'];
$imagenUsuario = $oUsuarioActual->getImagenPerfil();

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['inicio']; 
require_once $vistas['layout'];

//Guardamos en una variable de sesión el controlador de la página para poder volver a ella
$_SESSION['paginaAnterior'] = $controladores['inicio'];