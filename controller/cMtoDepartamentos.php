<?php
//Si se ha pulsado Volver
if (isset($_REQUEST['Volver'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del inicio
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

//Creación de variables
define("OPCIONAL", 0);
$error =  null;
$entradaOK = true;

//Si se ha pulsado Buscar validamos la descripción recogida en el formulario llamando a la librería
if (isset($_REQUEST['Buscar'])) {
    $error = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descripcion'], 255, 1, OPCIONAL);

    //Si hay un error $entradaOK pasa a ser false y el campo se vacía
    if ($error != null) {
        $entradaOK = false;
        $_REQUEST[$campo] = "";
    }
    
//Si no se ha pulsado Buscar $entradaOK pasa a false y la descripción a buscar se vacía para que salgan todos los departamentos de la BBDD
} else {
    $entradaOK = false;
    $_SESSION['descripcionBuscada'] = "";
}

//Si todo ha ido bien la descripción a buscar pasa a ser la introducida en el formulario
if ($entradaOK) {
    $_SESSION['descripcionBuscada'] = $_REQUEST['descripcion'];
}

//Crea un array con todos los departamentos obtenidos al llamar al método buscaDepartamentosPorDesc
$arrayDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc($_SESSION['descripcionBuscada']);


//Si se pulsa Modificar o Eliminar departamento se redirige al WIP
if (isset($_REQUEST['modificarDepartamento'])) {
    $_SESSION['paginaEnCurso'] = $controladores['wip'];
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['eliminarDepartamento'])) {
    $_SESSION['paginaEnCurso'] = $controladores['wip'];
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['mtoDepartamentos'];
require_once $vistas['layout'];

//Guardamos en una variable de sesión el controlador de la página para poder volver a ella
$_SESSION['paginaAnterior'] = $controladores['mtoDepartamentos'];