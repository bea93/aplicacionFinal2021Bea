<?php 
$_SESSION['paginaAnterior'] = $controladores['cambiarPassword'];
//Si se ha pulsado el botón Cancelar
if(isset($_REQUEST['Cancelar'])){
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador de la edición de usuario
    $_SESSION['paginaEnCurso'] = $controladores['editar'];
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

//Definición y declaración de variables
define("OBLIGATORIO", 1);
$entradaOK = true;
$aErrores = [
    'Password' => null,
    'NuevaPassword' => null,
    'RepetirPassword' => null
];

//Creación del objeto usuarioActual con los datos almacenados en la sesión
$oUsuarioActual = $_SESSION['usuarioDAW2AplicacionFinal'];

//Variables que almacenan los datos del usuario
$codUsuario = $oUsuarioActual->getCodUsuario();
$password = $oUsuarioActual ->getPassword();

//Si se ha pulsado Aceptar comprobamos los campos introducidos llamando a la librería de validación
if(isset($_REQUEST['Aceptar'])){
    $aErrores['Password'] = validacionFormularios::validarPassword($_REQUEST['Password'], 8, 1, 1, OBLIGATORIO);
    $aErrores['NuevaPassword'] = validacionFormularios::validarPassword($_REQUEST['NuevaPassword'], 8, 1, 1, OBLIGATORIO);
    $aErrores['RepetirPassword'] = validacionFormularios::validarPassword($_REQUEST['RepetirPassword'], 8, 1, 1, OBLIGATORIO);
    
    //Si las contraseñas nuevas no coinciden se muestra un mensaje de error
    if($_REQUEST['NuevaPassword'] != $_REQUEST['RepetirPassword']){
        $aErrores['RepetirPassword'] = "Las contraseñas no coinciden";
    }
    
    //Recorremos el array de errores y, en caso de que haya alguno, asignamos a $entradaOK el valor false y vaciamos el campo
    foreach ($aErrores as $campo => $error) {
        if ($error != null) {
            $entradaOK = false;
            $_REQUEST[$campo] = "";
        }
    }

    //Si todo ha ido bien se comprueba que la contraseña introducida como Contraseña Actual sea correcta
    if($entradaOK){
        //$passwordEncriptada es la encriptación de la concatenación del código de usuario y la contraseña
        $passwordEncriptada = hash("sha256", $codUsuario . $_REQUEST['Password']);
        //Si Contraseña Actual no coincide con la contraseña del usuario $entradaOK pasa a false y se vacía el campo
        if($password != $passwordEncriptada){
            $entradaOK = false;
            $_REQUEST['Password'] = "";
        }
    }
    //Si no se ha pulsado Aceptar
}else{
    $entradaOK = false;
}

//Si todo ha ido bien llamamos al método cambiarPassword y le pasamos el código de usuario y la contraseña nueva para que ejecute el UPDATE en la BBDD
if($entradaOK){
    $_SESSION['usuarioDAW2AplicacionFinal'] = UsuarioPDO::cambiarPassword($codUsuario, $_REQUEST['NuevaPassword']);
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador de la edición de usuarios
    $_SESSION['paginaEnCurso'] = $controladores['editar']; 
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['cambiarPassword']; 

require_once $vistas['layout'];