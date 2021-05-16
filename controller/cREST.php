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

//Creacion e inicialización de variables
$nombreAutor = null;
$error2 = null;

//Si se ha pulsado el botón Buscar el autor introducido por el usuario se almacena y se hacen las comprobaciones
if (isset($_REQUEST['Buscar'])) {
    $nombreAutor = $_REQUEST['autor'];

    //Creacion e inicialización de variables
    define("OBLIGATORIO", 1);
    $entradaOK = true;

    //Variable que almacenará el error que pueda surgir al validar el campo usando la librería de validación
    $error2 = validacionFormularios::comprobarAlfaNumerico($_REQUEST['autor'], 255, 1, OBLIGATORIO);

    //Si la comprobación ha ido bien se llama a la API pasándole el autor introducido por el usuario
    if ($error2 == null) {
        $aLibro = REST::libros($_REQUEST['autor']);
        
    //Si no se muestra un mensaje de error    
    } else {
        $error2 = "El nombre introducido no es válido";
    }
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['rest'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['rest'];