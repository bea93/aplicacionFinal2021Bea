<?php
if (isset($_REQUEST['Cancelar'])) {
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
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

$vistaEnCurso = $vistas['rest']; //variable que contiene la vista que va a ejecutarse
require_once $vistas['layout']; //llamamos al layout