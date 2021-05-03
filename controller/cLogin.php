<?php
//Defino e inicializo la constante a 1 para los campos que son obligatorios
define("OBLIGATORIO", 1); 

$entradaOK = true;
//Declaro e inicializo el array de errores
$aErrores = [
    'CodUsuario' => null,
    'Password' => null
];

//Si se ha pulsado el botón de registrarse
if (isset($_REQUEST['Registrarse'])) { 
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCursoSinRegistro'] = $controladores['registro']; 
    header('Location: index.php');
    exit;
}

//Si se ha pulsado en Tecnologías
if (isset($_REQUEST['Tecnologias'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del wip
    $_SESSION['paginaEnCursoSinRegistro'] = $controladores['wip'];
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

//Comprueba que el usuario le ha dado al botón de IniciarSesion y valida la entrada de todos los campos
if (isset($_REQUEST["IniciarSesion"])) { 
    $aErrores['CodUsuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['CodUsuario'], 15, 3, OBLIGATORIO);
    $aErrores['Password'] = validacionFormularios::validarPassword($_REQUEST['Password'], 8, 1, 1, OBLIGATORIO);
    $oUsuario = UsuarioPDO::validarUsuario($_REQUEST['CodUsuario'], $_REQUEST['Password']);

    //Si es null (el usuario no se encuentra en la BBDD) salta un error
    if(!isset($oUsuario)){ 
        $aErrores['CodUsuario'] = "El codigo de usuario no se encuentra en la base de datos"; 
    }
    
    //Compruebo si hay algún mensaje de error en algún campo
    if ($aErrores['CodUsuario'] != null || $aErrores['Password'] != null) {
        //Le doy el valor false a $entradaOK
        $entradaOK = false; 
        unset($_REQUEST);
    }
    
//Si el usuario no le ha dado al botón de enviar $entradaOK pasa a ser false
} else { 
    $entradaOK = false;
}

//Si la entrada está bien recojo los valores introducidos y hago su tratamiento
if ($entradaOK) {
    
    $_SESSION['fechaHoraUltimaConexionAnterior'] = $oUsuario ->getFechaHoraUltimaConexion();
    $oUsuario = UsuarioPDO::registrarUltimaConexion($oUsuario ->getCodUsuario());
    $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'] = $oUsuario;
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del inicio
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; 
     //Redirige al index.php
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['login']; 

require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['login'];
$_SESSION['paginaEnCursoSinRegistro'] = $controladores['login'];
