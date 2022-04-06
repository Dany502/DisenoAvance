<?php

    include("../conexion/conexion.php");
    $gasto=$_POST['gasto'];
    $total=$_POST['total']; 
    $dia=$_POST['dia'];
    $mes=$_POST['mes'];
    $anio=$_POST['anio'];
    $fechaActual=$_POST['fechaActual'];
    $egreso="Egreso";
    $ganancia="Ganancia";

    if(buscarRepetido($egreso,$conexion)==0){
        $registrar="INSERT INTO inventario (descripcion,total) values('$egreso',$total)";
        mysqli_query($conexion,$registrar);
    }else{
        $consulta="SELECT Total FROM inventario WHERE descripcion='$egreso'";
        $resultado=mysqli_query($conexion,$consulta);
        if($row=$resultado->fetch_assoc()){
            $totalInventario=$row['Total'];

            $nuevoTotalInventario=$totalInventario+$total;
            $actualizar="UPDATE inventario SET Total=$nuevoTotalInventario WHERE descripcion='$egreso'";
            mysqli_query($conexion,$actualizar);

        }
    }
    
    if(buscarRepetidoGanancia($ganancia,$conexion)==0){
        $consulta1="SELECT Total FROM inventario WHERE descripcion='Ingreso'";
        $resultado1=mysqli_query($conexion,$consulta1);
        if($row1=$resultado1->fetch_assoc()){
            $totalIngreso1=$row1['Total'];
        }
        $consulta0="SELECT Total FROM inventario WHERE descripcion='$egreso'";
        $resultado0=mysqli_query($conexion,$consulta0);
        if($row0=$resultado0->fetch_assoc()){
            $totalEgreso0=$row0['Total'];
        }
        $nuevoTotalGanancia1=$totalIngreso1-$totalEgreso0;

        $registrar2="INSERT INTO inventario (descripcion,total) values('$ganancia',$nuevoTotalGanancia1)";
        mysqli_query($conexion,$registrar2);
    }else{
        $consulta2="SELECT Total FROM inventario WHERE descripcion='Ingreso'";
        $resultado2=mysqli_query($conexion,$consulta2);
        if($row2=$resultado2->fetch_assoc()){
            $totalIngreso=$row2['Total'];
        }
        $consulta3="SELECT Total FROM inventario WHERE descripcion='$egreso'";
        $resultado3=mysqli_query($conexion,$consulta3);
        if($row3=$resultado3->fetch_assoc()){
            $totalEgreso=$row3['Total'];
        }
        $nuevoTotalGanancia=$totalIngreso-$totalEgreso;
        $actualizar2="UPDATE inventario SET Total=$nuevoTotalGanancia WHERE descripcion='$ganancia'";
        mysqli_query($conexion,$actualizar2);
    }
   
    if($gasto=='' || $total==''){
        echo 'vacio';
    }else{
        $insert="INSERT INTO gastos(gasto,total,fecha,dia,mes,anio) VALUES('$gasto',$total,'$fechaActual','$dia','$mes','$anio')";
        echo mysqli_query($conexion,$insert); 
    }

    function buscarRepetido($e,$conexion){
        $sql="SELECT * FROM inventario where descripcion='$e'";
        $result=mysqli_query($conexion,$sql);
    
        if(mysqli_num_rows($result)>0){
            return 1;
        }
        else{
            return 0;
        }
    }

    function buscarRepetidoGanancia($g,$conexion){
        $sql2="SELECT * FROM inventario where descripcion='$g'";
        $result2=mysqli_query($conexion,$sql2);
    
        if(mysqli_num_rows($result2)>0){
            return 1;
        }
        else{
            return 0;
        }
    }