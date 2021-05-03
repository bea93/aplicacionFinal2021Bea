<?php
//Si el usuario ha pulsado Volver se guarda en la Sesión el controlador de la página anterior y se redirige al index
if(isset($_REQUEST['Volver'])){
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaEnCursoSinRegistro'] = $_SESSION['paginaAnterior'];
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['wip'];
require_once $vistas['layout'];