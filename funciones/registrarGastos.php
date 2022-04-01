<?php

    include("../conexion/conexion.php");
    $gasto=$_POST['gasto'];
    $total=$_POST['total']; 
    $dia=$_POST['dia'];
    $mes=$_POST['mes'];
    $anio=$_POST['anio'];
    $fechaActual=$_POST['fechaActual'];
   
    if($gasto=='' || $total==''){
        echo 'vacio';
    }else{
        $insert="INSERT INTO gastos(gasto,total,fecha,dia,mes,anio) VALUES('$gasto',$total,'$fechaActual','$dia','$mes','$anio')";
        echo mysqli_query($conexion,$insert); 
    }