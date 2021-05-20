<?php

//Por defecto descripcionBuscada será "" para que muestre todos los departamentos, la paginaActual será la 1 y el CriterioBusqueda "todos"
if (!isset($_SESSION['descripcionBuscada'])) {
    $_SESSION['descripcionBuscada'] = "";
}
if (!isset($_SESSION['PaginaActual'])) {
    $_SESSION['PaginaActual'] = 1;
}
$_SESSION['CriterioBusqueda'] = "Todos";

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

//Botones para navegar entre las páginas
if (isset($_REQUEST['avanzarPagina'])) {
    $_SESSION['PaginaActual'] = $_REQUEST['avanzarPagina'];
} else if (isset($_REQUEST['retrocederPagina'])) {
    $_SESSION['PaginaActual'] = $_REQUEST['retrocederPagina'];
} else if (isset($_REQUEST['paginaInicial'])) {
    $_SESSION['PaginaActual'] = $_REQUEST['paginaInicial'];
} else if (isset($_REQUEST['paginaFinal'])) {
    $_SESSION['PaginaActual'] = $_REQUEST['paginaFinal'];
}

//Creación de variables para la validación de datos
define("OPCIONAL", 0);
$aErrores = ['Departamento' => null,
            'CriterioBusqueda' => null
        ];
$entradaOK = true;


//Si se ha pulsado Buscar validamos la información recogida en el formulario llamando a la librería
if (isset($_REQUEST['Buscar'])) {
    $aErrores['Departamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descripcion'], 255, 1, OPCIONAL);
    $aErrores['CriterioBusqueda'] = validacionFormularios::validarElementoEnLista($_REQUEST['CriterioBusqueda'], ['Todos', 'Baja', 'Alta']);

    //Recorre el array de errores y si hay alguno el campo se vacía y $entradaOK pasa a ser false
    foreach ($aErrores as $campo => $error) {
        if ($error != null) {
            $entradaOK = false;
            $_REQUEST[$campo] = "";
        }
    }

//Si no se ha pulsado Buscar $entradaOK pasa a false y la descripción a buscar se vacía para que salgan todos los departamentos de la BBDD
} else {
    $entradaOK = false;
}

//Si todo ha ido bien
if ($entradaOK) {
    $_SESSION['descripcionBuscada'] = $_REQUEST['descripcion'];
    $_SESSION['CriterioBusqueda'] = $_REQUEST['CriterioBusqueda'];
    $_SESSION['PaginaActual'] = 1;
}

//Crea un array con todos los departamentos obtenidos al llamar al método buscaDepartamentosPorDesc
$aResultadoBusqueda = DepartamentoPDO::buscaDepartamentosPorDescEstadoYPagina($_SESSION['descripcionBuscada'],$_SESSION['CriterioBusqueda'],$_SESSION['PaginaActual'], 5);

//Guardamos la descripción, el criterio y el número de página actual en variables de sesión para recordarlas
$descBuscada = $_SESSION['descripcionBuscada'];
$criterioBusqueda = $_SESSION['CriterioBusqueda'];
$paginaActual = $_SESSION['PaginaActual'];


$aDepartamentos = $aResultadoBusqueda[0];
$paginasTotales = $aResultadoBusqueda[1];


//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['mtoDepartamentos'];
require_once $vistas['layout'];

//Guardamos en una variable de sesión el controlador de la página para poder volver a ella
$_SESSION['paginaAnterior'] = $controladores['mtoDepartamentos'];