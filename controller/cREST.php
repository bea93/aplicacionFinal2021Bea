<?php
//Si se ha pulsado el botón Cancelar
if (isset($_REQUEST['Volver'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del inicio
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

//Creacion e inicialización de variables
$numeroPersonaje = null;
$error = null;
$aError = null;
$nombrePersonajeR = null;
$generoR = null;
$estadoR = null;
$especieR = null;
$imagenR = null;

//Si se ha pulsado el botón Aceptar el número introducido por el usuario se almacena y se hacen las comprobaciones
if (isset($_REQUEST['Aceptar'])){
    $numeroPersonaje = $_REQUEST['numero'];
    
    //Creacion e inicialización de variables
    define("OBLIGATORIO", 1);
    $entradaOK = true;

    //Variable que almacenará el error que pueda surgir al validar el campo usando la librería de validación
    $error = validacionFormularios::comprobarEntero($_REQUEST['numero'], 1000, 1, OBLIGATORIO);

    //Si la comprobación ha ido bien se llama a la API pasándole el número introducido por el usuario
    if ($error == null) {
        $aRespuesta = REST::personajeRM($_REQUEST['numero']);
        if ($aRespuesta[0] == true) {
            $nombrePersonajeR = $aRespuesta[1]['name'];
            $generoR = $aRespuesta[1]['gender'];
            $estadoR = $aRespuesta[1]['status'];
            $especieR = $aRespuesta[1]['species'];
            $imagenR = $aRespuesta[1]['image'];
            
        } else {
            $aError = $aRespuesta;
        }
    } else {
        $error = "El campo no es valido";
    }
}

/*Creo una variable de sesión para recordar el autor introducido en el formulario y la inicializo a null
$_SESSION['autorF'] = null;

//Si se ha pulsado el botón Buscar llamamos a la API y le pasamos el autor introducido por el usuario
if(isset($_REQUEST['Buscar'])){    
    $aLibro = Rest::libros($_REQUEST['autor']);  
    //Almacenamos el autor en la variable de sesión
    $_SESSION['autorF'] = $_REQUEST['autor'];
}*/

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['rest'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['rest'];