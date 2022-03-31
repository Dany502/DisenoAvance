<?php
$local="localhost";
$user="root";
$pass="";
$baseDatos="gestorservicios";

$tabla1="servicios";
$tabla2="usuarios";
error_reporting(0);

$conexion=new mysqli($local,$user,$pass,$baseDatos);

if($conexion->connect_errno){
    echo "la conexion fallo";
    exit();
}