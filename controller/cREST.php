<?php
if (isset($_REQUEST['Cancelar'])) {
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

//Si se ha pulsado el botón Aceptar llamamos a la API y le pasamos el número introducido por el usuario
if (isset($_REQUEST['Aceptar'])){
    $ValoresPersonaje = REST::personajeRM($_REQUEST['numero']);
} else {
    $ValoresPersonaje = null;
}
if (is_null($ValoresPersonaje)) {
    $nombrePersonajeR = null;
    $imagenR = null;
    $estadoR = null;
    $especieR = null;
    $generoR = null;
} else {
    $nombrePersonajeR = $ValoresPersonaje['name'];
    $imagenR = $ValoresPersonaje['image'];
    $estadoR = $ValoresPersonaje['status'];
    $especieR = $ValoresPersonaje['species'];
    $generoR = $ValoresPersonaje['gender'];
}

//Si se ha pulsado el botón Buscar llamamos a la API y le pasamos el autor introducido por el usuario
if(isset($_REQUEST['Buscar'])){    
    $libros = Rest::libros($_REQUEST['autor']);    
}else {
    $libros = null;
}

//Si se ha encontrado algún libro de ese autor
if (!is_null($libros)){
    $titulo = $libros['book_title'];
    $resumen = $libros['summary'];
    $fechaPublicacion = $libros['publication_dt'];
    $urlResumen = $libros['url'];
    $mensaje = null;
    //Si se ha pulsado el botón Buscar pero no se ha encontrado ningún libro del autor se mostrará un mensaje
} else {
    $titulo = null;
    $resumen = null;
    $fechaPublicacion = null;
    $urlResumen = null;
    $mensaje = "No se ha encontrado ningún libro de ese autor";;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['rest'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['rest'];