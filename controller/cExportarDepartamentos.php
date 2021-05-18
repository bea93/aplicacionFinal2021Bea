<?php

//Si se ha pulsado el botón Cancelar
if (isset($_REQUEST['Cancelar'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del mtoDepartamentos
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
    header('Location: index.php');
    exit;
}

define("OBLIGATORIO", 1);
$entradaOK = true;

$errorArchivo = null;//Inicializamos la variable donde almacenaremos los errores del campo a null


if(isset($_REQUEST['Exportar'])){
    $errorArchivo = validacionFormularios::validarElementoEnLista($_REQUEST['Archivo'], ['xml', 'json']);
    
    if($errorArchivo!=null){//Si hay algún error
        $entradaOK=false;
    }
}else{
    $entradaOK = false;
}

if($entradaOK){
    DepartamentoPDO::exportarDepartamentos($_REQUEST['Archivo']);
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['exportar'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['exportar'];
