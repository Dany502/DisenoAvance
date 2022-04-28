<?php

include("../conexion/conexion.php");

$sql="SELECT SUM(total) ts FROM servicios";
$respuesta=mysqli_query($conexion, $sql);
if($row=$respuesta->fetch_assoc()){
    $totalS=$row['ts'];
}

$sql2="SELECT SUM(total) tg FROM gastos";
$respuesta2=mysqli_query($conexion, $sql2);
if($row2=$respuesta2->fetch_assoc()){
    $totalG=$row2['tg'];
}
$total=$totalS-$totalG;
echo "Q$total";
