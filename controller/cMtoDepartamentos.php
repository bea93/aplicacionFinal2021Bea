<?php
//Si se ha pulsado Volver o Alta, Exportar o Importar se guarda en la variable de sesión 'paginaEnCurso' la ruta del controlador de la página a la que queramos ir
if (isset($_REQUEST['Volver'])) {
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['Alta'])) {
    $_SESSION['paginaEnCurso'] = $controladores['altaDepartamento'];
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['Importar'])) {
    $_SESSION['paginaEnCurso'] = $controladores['importar'];
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['Exportar'])) {
    $_SESSION['paginaEnCurso'] = $controladores['exportar'];
    header('Location: index.php');
    exit;
}

//Si se pulsa Modificar, Eliminar, Baja o Rehabilitar se redirige a las ventanas correspondientes pasándoles el código del departamento seleccionado en una variable de sesión
if (isset($_REQUEST['Modificar'])) {
    $_SESSION['codDepartamento'] = $_REQUEST['Modificar'];
    $_SESSION['paginaEnCurso'] = $controladores['modificarDepartamento'];
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['Eliminar'])) {
    $_SESSION['codDepartamento'] = $_REQUEST['Eliminar'];
    $_SESSION['paginaEnCurso'] = $controladores['borrarDepartamento'];
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['Baja'])) {
    $_SESSION['codDepartamento'] = $_REQUEST['Baja'];
    $_SESSION['paginaEnCurso'] = $controladores['bajaLogica'];
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['Rehabilitar'])) {
    $_SESSION['codDepartamento'] = $_REQUEST['Rehabilitar'];
    $_SESSION['paginaEnCurso'] = $controladores['rehabilitar'];
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

//Guardamos la descripción buscada en una variable de sesión para recordarla
$descBuscada = $_SESSION['descripcionBuscada'];



//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['mtoDepartamentos'];
require_once $vistas['layout'];

//Guardamos en una variable de sesión el controlador de la página para poder volver a ella
$_SESSION['paginaAnterior'] = $controladores['mtoDepartamentos'];