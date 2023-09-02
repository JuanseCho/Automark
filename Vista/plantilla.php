<?php

session_start();
include_once("Vista/modulos/cabecera.php");




if (isset($_SESSION["ruta"])) {

    include_once("modulos/menu.php");

    if ($_GET["ruta"] == "inicioAdmin" || 
    $_GET["ruta"] == "inicioEmpleado" ||
    $_GET["ruta"] == "inicioCliente" ||
    $_GET["ruta"] == "insumos" ||
    $_GET["ruta"] == "tipoServicio" ||
    $_GET["ruta"] == "tipoVehiculo" ||
    $_GET["ruta"] == "cerrarSesion") {
        
        include_once("vista/modulos/".$_GET["ruta"].".php");

    }
    

}else {
    include_once('Vista/modulos/login.php');
}


include_once("Vista/modulos/pie.php");
