<?php
//Si se ha pulsado Volver
if (isset($_REQUEST['Volver'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del inicio
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

//Si se ha pulsado Buscar
if (isset($_REQUEST['Buscar'])) {
    //Almacena la descripción a buscar en una variable
    $descripcionBuscada = $_REQUEST['descripcion'];
} else {
    //Si no se ha pulsado la descripcion a buscar estaría vacía y se mostrarían todos los departamentos
    $descripcionBuscada = "";
}

//Crea un array con todos los departamentos obtenidos al llamar al método buscaDepartamentosPorDesc
$arrayDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc($descripcionBuscada);


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