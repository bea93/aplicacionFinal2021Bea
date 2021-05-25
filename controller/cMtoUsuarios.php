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
$aUsuarios = UsuarioPDO::buscaUsuariosPorDesc($descripcionBuscada);


//Si se pulsa Eliminar se le pasa al controlador de la ventana el código del usuario seleccionado y se le redirige
if (isset($_REQUEST['Eliminar'])) {
    $_SESSION['codUsuario'] = $_REQUEST['Eliminar'];
    $_SESSION['paginaEnCurso'] = $controladores['borrarCuenta'];
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['mtoUsuarios'];
require_once $vistas['layout'];

//Guardamos en una variable de sesión el controlador de la página para poder volver a ella
$_SESSION['paginaAnterior'] = $controladores['mtoUsuarios'];