<?php

    include("../conexion/conexion.php");
    $servicio=$_POST['servicio'];
    $total=$_POST['total']; 
    $dia=$_POST['dia'];
    $mes=$_POST['mes'];
    $anio=$_POST['anio'];
    $fechaActual=$_POST['fechaActual'];
   
    if($servicio=='' || $total==''){
        echo 'vacio';
    }else{
        $insert="INSERT INTO servicios(servicio,total,fecha,dia,mes,anio) VALUES('$servicio',$total,'$fechaActual','$dia','$mes','$anio')";
        echo mysqli_query($conexion,$insert); 
    }