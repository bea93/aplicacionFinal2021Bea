<?php
$_SESSION['paginaAnterior'] = $controladores['borrarCuenta'];
//Si se ha pulsado el botón Cancelar
if(isset($_REQUEST['Cancelar'])){
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador de la edición del usuario
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; 
    header('Location: index.php');
    exit;
}

//Si se ha pulsado en Tecnologías
if (isset($_REQUEST['Tecnologias'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del wip
    $_SESSION['paginaEnCurso'] = $controladores['wip'];
    header("Location: index.php");
    exit;
}

//Si se ha pulsado en PHPDoc
if (isset($_REQUEST['PHPDoc'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del wip
    $_SESSION['paginaEnCurso'] = $controladores['wip'];
    header("Location: index.php");
    exit;
}

//Si se ha pulsado en RSS
if (isset($_REQUEST['RSS'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del wip
    $_SESSION['paginaEnCurso'] = $controladores['wip'];
    header("Location: index.php");
    exit;
}

//Si se ha pulsado en Doxygen
if (isset($_REQUEST['Doxygen'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del wip
    $_SESSION['paginaEnCurso'] = $controladores['wip'];
    header("Location: index.php");
    exit;
}

//Creación del objeto usuarioActual con los datos almacenados en la sesión
$oUsuarioActual = $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'];
//Variables que almacenan los datos del usuario
$codUsuario = $oUsuarioActual->getCodUsuario();
$descUsuario = $oUsuarioActual->getDescUsuario();
$numConexiones = $oUsuarioActual->getNumConexiones();

//Si se ha pulsado el botón Aceptar llamamos al método borrarUsuario y le pasamos el código del usuario para que ejecute el DELETE en la BBDD
if(isset($_REQUEST['Aceptar'])){
    UsuarioPDO::borrarUsuario($codUsuario);
    //Borramos los datos de la sesión y redirigimos al login
    session_destroy();
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['borrarCuenta']; 

require_once $vistas['layout'];
