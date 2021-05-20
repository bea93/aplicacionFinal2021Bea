<?php

//Si no se ha buscado nada
if (!isset($_SESSION['descripcionBuscada'])) {
    //La variable de sesión que almacenará la descripción buscada para recordarla al cambiar de página será "", así se mostrarán todos los departamentos
    $_SESSION['descripcionBuscada'] = "";
}
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

if (!isset($_SESSION['PaginaActual'])) {//Si no está establecida la pagina actual en la sesion
    $_SESSION['PaginaActual'] = 1; //Establecemos la página actual a 1
}

if (isset($_REQUEST['avanzarPagina'])) {//Si pulsa el botón de avanzar pagina
    $_SESSION['PaginaActual'] = $_REQUEST['avanzarPagina']; //el numero de la pagina es igual al valor de avanzarPagina
} else if (isset($_REQUEST['retrocederPagina'])) {//Si pulsa el botón de retroceder pagina
    $_SESSION['PaginaActual'] = $_REQUEST['retrocederPagina']; //el numero de la pagina es igual al valor de retrocederPagina
} else if (isset($_REQUEST['paginaInicial'])) {//Si pulsa el botón de pagina inicial
    $_SESSION['PaginaActual'] = $_REQUEST['paginaInicial']; //el numero de la pagina es igual al valor de paginaInicial
} else if (isset($_REQUEST['paginaFinal'])) {//Si pulsa el botón de pagina final
    $_SESSION['PaginaActual'] = $_REQUEST['paginaFinal']; //el numero de la pagina es igual al valor de paginaFinal
}

//Creación de variables
define("OPCIONAL", 0);
$aErrores = ['Departamento' => null,
            'CriterioBusqueda' => null
        ];
$entradaOK = true;
//La variable de sesión CriterioBusqueda guarda "Todos" para que salgan todos los departamentos, independientemente de su estado
$_SESSION['CriterioBusqueda'] = "Todos";

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

//Si todo ha ido bien la descripción a buscar pasa a ser la introducida en el formulario
if ($entradaOK) {
    $_SESSION['descripcionBuscada'] = $_REQUEST['descripcion'];
    $_SESSION['CriterioBusqueda'] = $_REQUEST['CriterioBusqueda'];
    $_SESSION['PaginaActual'] = 1;
}

//Crea un array con todos los departamentos obtenidos al llamar al método buscaDepartamentosPorDesc
$aResultadoBusqueda = DepartamentoPDO::buscaDepartamentosPorDescEstadoYPagina($_SESSION['descripcionBuscada'],$_SESSION['CriterioBusqueda'],$_SESSION['PaginaActual'], 5);

//Guardamos la descripción y el criterio en variables de sesión para recordarlas
$descBuscada = $_SESSION['descripcionBuscada'];
$criterioBusqueda = $_SESSION['CriterioBusqueda'];
$aDepartamentos = $aResultadoBusqueda[0];
$paginasTotales = $aResultadoBusqueda[1];
$paginaActual = $_SESSION['PaginaActual'];

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['mtoDepartamentos'];
require_once $vistas['layout'];

//Guardamos en una variable de sesión el controlador de la página para poder volver a ella
$_SESSION['paginaAnterior'] = $controladores['mtoDepartamentos'];