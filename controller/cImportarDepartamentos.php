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

$errorArchivo = null;//Inicializamos la variable donde almacenaremos los errores del campo a nul
$errorTipo = null;

if(isset($_REQUEST['Importar'])){
    $errorTipo = validacionFormularios::validarElementoEnLista($_REQUEST['Tipo'], ['xml', 'json']); // validamos la entrada

    if($errorTipo == null){
        switch ($_REQUEST['Tipo']) { // en funcion del tipo que el usuario haya seleccionado en el formulario
            case 'xml':
                if ($_FILES['Archivo']['type'] != 'text/xml') {//Si la extension del archivo no es xml
                    $errorArchivo = "El fomato de archivo debe ser .xml";
                }
                break;
            
            case 'json':
                if ($_FILES['Archivo']['type'] != 'application/json') {//Si la extension del archivo no es json
                    $errorArchivo = "El fomato de archivo debe ser .json";
                }
                break;
        }
    }
    
    if($errorArchivo!=null || $errorTipo!=null){//Si hay algún error
        $entradaOK=false;
    }
}else{
    $entradaOK = false;
}

if($entradaOK){
    DepartamentoPDO::importarDepartamentos($_FILES['Archivo']['tmp_name'], $_REQUEST['Tipo']); // importamos el archivo
    
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['importar'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['importar'];