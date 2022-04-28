<?php

include("../conexion/conexion.php");

$sql="SELECT SUM(total) tg FROM gastos";
$respuesta=mysqli_query($conexion, $sql);
if($row=$respuesta->fetch_assoc()){
    $total=$row['tg'];
}
echo "Q$total";
