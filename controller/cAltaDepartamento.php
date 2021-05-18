<?php

//Si se ha pulsado Cancelar
if(isset($_REQUEST['Cancelar'])){
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del login
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; 
    header('Location: index.php');
    exit;
}

//Defino e inicializo la constante a 1 para los campos que son obligatorios
define("OBLIGATORIO", 1); 

$entradaOK = true;

//Declaro e inicializo el array de errores
$aErrores = [ 
    'CodDepartamento' => null,
    'DescDepartamento' => null,
    'Volumen' => null
];

//Comprueba que el usuario le ha dado a al botón de IniciarSesion y valida la entrada de todos los campos
if (isset($_REQUEST["Alta"])) { 
    $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['CodDepartamento'], 15, 3, OBLIGATORIO);
    //Si no ha habido error en el campo CodDepartamento pero el código de usuario ya existe en la BBDD
    if($aErrores['CodDepartamento'] == null && DepartamentoPDO::validaCodNoExiste($_REQUEST['CodDepartamento']) == false){
        //Guarda en el array de errores el mensaje de error
        $aErrores['CodDepartamento']="El código de departamento ya existe"; 
    }

    $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 3, OBLIGATORIO);
    $aErrores['Volumen'] = validacionFormularios::comprobarEntero($_REQUEST['Volumen'], PHP_INT_MAX, 1, OBLIGATORIO);
    
    //Recorro el array de errores
    foreach ($aErrores as $campo => $error) {
        //Compruebo si hay algun mensaje de error en algun campo, en caso de que los haya $entradaOK pasa a false y se vacía el campo que dé error
        if ($error != null) {
            $entradaOK = false; 
            $_REQUEST[$campo] = "";
        }
    }
 //Si el usuario no le ha dado al boton de enviar $entradaOK pasa a false
} else {
    $entradaOK = false;
}

//Si la entrada esta bien recojo los valores introducidos y hago su tratamiento
if ($entradaOK) { 
    //Guardamos en la variable el resultado de la función que valida si existe un usuario con el código y password introducido
    $oDepartamento = DepartamentoPDO::altaDepartamento($_REQUEST['CodDepartamento'],$_REQUEST['DescDepartamento'],$_REQUEST['Volumen']);
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del inicio
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; 
    //Redirige al index.php
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['altaDepartamento']; 
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['altaDepartamento'];
$_SESSION['paginaEnCursoSinRegistro'] = $controladores['altaDepartamento'];