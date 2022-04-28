<?php

include("../conexion/conexion.php");

$sql="SELECT SUM(total) ts FROM servicios";
$respuesta=mysqli_query($conexion, $sql);
if($row=$respuesta->fetch_assoc()){
    $total=$row['ts'];
}
echo "Q$total";
