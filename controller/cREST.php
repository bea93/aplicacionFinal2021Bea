<?php
//Si se ha pulsado el botón Cancelar
if (isset($_REQUEST['Volver'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del inicio
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

//Variable de sesión que almacenará el número del personaje inicializada a null
$_SESSION['numeroPersonaje'] = null;

//Si se ha pulsado el botón Aceptar llamamos a la API y le pasamos el número introducido por el usuario
if (isset($_REQUEST['Aceptar'])){
    $ValoresPersonaje = REST::personajeRM($_REQUEST['numero']);
    $_SESSION['numeroPersonaje'] = $_REQUEST['numero'];
} else {
    $ValoresPersonaje = null;
}
if (!is_null($ValoresPersonaje)) {
    $nombrePersonajeR = $ValoresPersonaje['name'];
    $imagenR = $ValoresPersonaje['image'];
    $estadoR = $ValoresPersonaje['status'];
    $especieR = $ValoresPersonaje['species'];
    $generoR = $ValoresPersonaje['gender'];
}

/*Si se ha pulsado el botón Buscar llamamos a la API y le pasamos el autor introducido por el usuario
if(isset($_REQUEST['Buscar'])){    
    $aLibro = Rest::libros($_REQUEST['autor']);    
}*/

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['rest'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['rest'];