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

//Objeto usuario con los datos del usuario que ha iniciado sesión
$oUsuarioActual = $_SESSION['usuarioDAW2AplicacionFinal'];

//Variables que almacenan los datos del usuario
$codUsuario = $oUsuarioActual->getCodUsuario();
$numConexiones = $oUsuarioActual->getNumConexiones();
$descUsuario = $oUsuarioActual->getDescUsuario();
$perfil = $oUsuarioActual->getPerfil();
$fechaTS = date('H:i:s d/m/Y',$_SESSION['fechaHoraUltimaConexionAnterior']);
$imagen = $oUsuarioActual->getImagenPerfil();

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['detalle']; 
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['detalle'];