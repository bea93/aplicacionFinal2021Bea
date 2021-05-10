<?php

//Si se ha pulsado el botón Cancelar
if(isset($_REQUEST['Cancelar'])){
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del inicio
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; 
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón Cambiar contraseña
if(isset($_REQUEST['CambiarPassword'])){
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del editor de contraseña
    $_SESSION['paginaEnCurso'] = $controladores['cambiarPassword']; 
    header('Location: index.php');
    exit;
}

//Definición y declaración de variables
define("OBLIGATORIO", 1);
define("OPCIONAL", 0);

$entradaOK = true;
$errorDescripcion = "";

//Creación del objeto usuarioActual con los datos almacenados en la sesión
$oUsuarioActual = $_SESSION['usuarioDAW2AplicacionFinal'];
//Variables que almacenan los datos del usuario
$codUsuario = $oUsuarioActual->getCodUsuario();
$numConexiones = $oUsuarioActual->getNumConexiones();
$descUsuario = $oUsuarioActual->getDescUsuario();

//Si se ha pulsado el botón Aceptar llamamos a la librería de validación para comprobar el campo introducido
if(isset($_REQUEST['Aceptar'])){
    $errorDescripcion = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescUsuario'], 255, 3, OBLIGATORIO);

    // Recorremos los arrays de errores comprobando que los campos no estén vacíos
    if ($errorDescripcion != null) {
        //En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario
        $entradaOK = false;
        //Limpiamos los campos del formulario
        $_REQUEST['Descripcion'] = "";
    }
}else{
    //Si el usuario no ha enviado el formulario asignamos a entradaOK el valor false para que rellene el formulario
    $entradaOK = false; 
}
//Si todo ha ido bien llamamos al método modificarUsuario, le pasamos los valores que necesita y volvemos a la página de inicio
if($entradaOK){
    $_SESSION['usuarioDAW2AplicacionFinal']=UsuarioPDO::modificarUsuario($codUsuario, $_REQUEST['DescUsuario'], $imagenSubida);
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['editar']; 
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['editar'];
