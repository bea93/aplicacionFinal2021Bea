<?php
if (isset($_REQUEST['Cancelar'])) {
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
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

//Si se ha pulsado el botón Aceptar
if (isset($_REQUEST['Aceptar'])) { 
    //llamamos al servicio y le pasamos la fecha introducida por el usuario
    $ValoresPersonaje = REST::personajeRM($_REQUEST['numero']);
} else {
    $ValoresPersonaje = null;
}
if (is_null($ValoresPersonaje)) {
    $nombrePersonajeR = null;
    $imagenR = null;
    $estadoR = null;
    $especieR = null;
    $tipoR = null;
    $generoR = null;
} else {
    $nombrePersonajeR = $ValoresPersonaje['name'];
    $imagenR = $ValoresPersonaje['image'];
    $estadoR = $ValoresPersonaje['status'];
    $especieR = $ValoresPersonaje['species'];
    $tipoR = $ValoresPersonaje['type'];
    $generoR = $ValoresPersonaje['gender'];
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['rest'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['rest'];