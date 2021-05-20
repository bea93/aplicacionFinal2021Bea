<?php

//Si se ha pulsado el botón Cancelar
if (isset($_REQUEST['Cancelar'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del mtoDepartamentos
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
    header('Location: index.php');
    exit;
} 

//Creación del objeto Departamento llamando al método que devuelve un departamento pasándole el código del mismo, en este caso almacenado en la sesión
$oDepartamento = DepartamentoPDO::buscaDepartamentoPorCod($_SESSION['codDepartamento']);

//Accedemos a los atributos del objeto y los almacenamos en variables
$codDep = $_SESSION['codDepartamento'];
$descDep = $oDepartamento->getDescDepartamento();
$volumen = $oDepartamento->getVolumenNegocio();
$fechaCreacion = $oDepartamento->getFechaCreacion();
if (!is_null($oDepartamento->getFechaBaja())) {
    $fechaBaja = date('d/m/Y', $oDepartamento->getFechaBaja());
}

//Si se ha pulsado Aceptar llama al método bajaLogicaDepartamento y se le pasa el código del departamento para que se actualicen en la BBDD y vuelve a la ventana mtoDepartamentos
if (isset($_REQUEST["Aceptar"])) {
    DepartamentoPDO::rehabilitaDepartamento($_SESSION['codDepartamento']);
   $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
    header('Location: index.php');
    exit; 
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['rehabilitar'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['rehabilitar'];