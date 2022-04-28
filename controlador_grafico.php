<?php
    include("modelo.php");

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatos();
    echo json_encode($consulta);