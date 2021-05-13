<?php
require_once "core/210322ValidacionFormularios.php";

require_once "model/Usuario.php";
require_once "model/UsuarioPDO.php";
require_once "model/Departamento.php";
require_once "model/DepartamentoPDO.php";
require_once "model/DBPDO.php";
require_once "model/REST.php";

$controladores = [
    "login" => "controller/cLogin.php",
    "inicio" => "controller/cInicio.php",
    "registro" => "controller/cRegistro.php",
    "detalle" => "controller/cDetalle.php",
    "editar" => "controller/cEditar.php",
    "cambiarPassword" => "controller/cCambiarPassword.php",
    "borrarCuenta" => "controller/cBorrarCuenta.php",
    "wip" => "controller/cWIP.php",
    "rest" => "controller/cREST.php",
    "mtoDepartamentos" => "controller/cMtoDepartamentos.php"
];

$vistas = [
    "layout" => "view/layout.php",
    "login" => "view/vLogin.php",
    "inicio" => "view/vInicio.php",
    "registro" => "view/vRegistro.php",
    "detalle" => "view/vDetalle.php",
    "editar" => "view/vEditar.php",
    "cambiarPassword" => "view/vCambiarPassword.php",
    "borrarCuenta" => "view/vBorrarCuenta.php",
    "wip" => "view/vWIP.php",
    "rest" => "view/vREST.php",
    "mtoDepartamentos" => "view/vMtoDepartamentos.php"
];