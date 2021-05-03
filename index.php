<?php 
require_once 'config/config.php';

session_start();

require_once 'config/configDB.php';

//Si el usuario ha solicitado otra página distinta del login
if(isset($_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'])){
    //Incluimos el controlador de la página solicitada almacenado en la sesión
    require_once $_SESSION['paginaEnCurso'];
    //Si el usuario no ha iniciado sesión y ha solicitado una página en curso sin registro(opción registrarse o ventanas enlazadas al WIP) incluimos el controlador de esa página
} else if (isset($_SESSION['paginaEnCursoSinRegistro'])){ 
    require_once $_SESSION['paginaEnCursoSinRegistro'];
}else{ //Si el usuario no se ha identificado y no ha solicitado ninguna página en curso sin registro por defecto cargaremos el login
    require_once $controladores['login'];
}
 