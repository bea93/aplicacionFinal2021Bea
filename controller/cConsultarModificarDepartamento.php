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

//Declaración y definición de variables
define("OBLIGATORIO", 1); 
$entradaOK = true;
$aErrores = [
    'DescDepartamento' => null,
    'VolumenNegocio' => null
];

//Si se ha pulsado Aceptar se validan los campos llamando a los métodos necesarios de la librería
if (isset($_REQUEST["Aceptar"])) {
    $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 35, 3, OBLIGATORIO);
    $aErrores['VolumenNegocio'] = validacionFormularios::comprobarEntero($_REQUEST['VolumenNegocio'], PHP_INT_MAX, 1, OBLIGATORIO);

    //Recorremos el array de errores y, en caso de que haya alguno, $entradaOk pasa a ser false y se vacía el campo con el error
    foreach ($aErrores as $campo => $error) {
        if ($error != null) {
            $entradaOK = false;
            $_REQUEST[$campo] = "";
        }
    }
    
  //Si no $entradaOK pasa a ser false  
} else {
    $entradaOK = false;
}

//Si todo ha ido bien llama al método modificaDepartamento y se le pasan los datos introducidos en el formulario para que se actualicen en la BBDD y vuelve a la ventana mtoDepartamentos
if ($entradaOK) {
    DepartamentoPDO::modificaDepartamento($_REQUEST['VolumenNegocio'], $_REQUEST['DescDepartamento'], $_SESSION['codDepartamento']);
   $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['modificarDepartamento'];
require_once $vistas['layout'];

$_SESSION['paginaAnterior'] = $controladores['modificarDepartamento'];