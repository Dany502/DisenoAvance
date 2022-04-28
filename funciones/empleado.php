<?php
require '../funciones/validarusuario.php';
if(!isset($_SESSION['usuario'])){
    header('location: index_login.php');
}
include("../conexion/conexion.php");
$iduser=$_SESSION['usuario'];

$sql="SELECT nombre FROM usuarios Where id=$iduser";
$respuesta=mysqli_query($conexion,$sql);

if($row=$respuesta->fetch_assoc()){
    $nombre=$row['nombre'];

    echo $nombre;
}