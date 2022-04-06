<?php

    include("../conexion/conexion.php");
    $servicio=$_POST['servicio'];
    $total=$_POST['total']; 
    $dia=$_POST['dia'];
    $mes=$_POST['mes'];
    $anio=$_POST['anio'];
    $fechaActual=$_POST['fechaActual'];
    $ingreso="Ingreso";
    $ganancia="Ganancia";

    if(buscarRepetido($ingreso,$conexion)==0){
        $registrar="INSERT INTO inventario (descripcion,total) values('$ingreso',$total)";
        mysqli_query($conexion,$registrar);
    }else{
        $consulta="SELECT Total FROM inventario WHERE descripcion='$ingreso'";
        $resultado=mysqli_query($conexion,$consulta);
        if($row=$resultado->fetch_assoc()){
            $totalInventario=$row['Total'];

            $nuevoTotalInventario=$totalInventario+$total;
            $actualizar="UPDATE inventario SET Total=$nuevoTotalInventario WHERE descripcion='$ingreso'";
            mysqli_query($conexion,$actualizar);

        }
    }
    if(buscarRepetidoGanancia($ganancia,$conexion)==0){
        $registrar2="INSERT INTO inventario (descripcion,total) values('$ganancia',$total)";
        mysqli_query($conexion,$registrar2);
    }else{
        $consulta2="SELECT Total FROM inventario WHERE descripcion='$ingreso'";
        $resultado2=mysqli_query($conexion,$consulta2);
        if($row2=$resultado2->fetch_assoc()){
            $totalIngreso=$row2['Total'];
        }
        $consulta3="SELECT Total FROM inventario WHERE descripcion='Egreso'";
        $resultado3=mysqli_query($conexion,$consulta3);
        if($row3=$resultado3->fetch_assoc()){
            $totalEgreso=$row3['Total'];
        }
        $nuevoTotalGanancia=$totalIngreso-$totalEgreso;
        $actualizar2="UPDATE inventario SET Total=$nuevoTotalGanancia WHERE descripcion='$ganancia'";
        mysqli_query($conexion,$actualizar2);
    }
   
    if($servicio=='' || $total==''){
        echo 'vacio';
    }else{
        $insert="INSERT INTO servicios(servicio,total,fecha,dia,mes,anio) VALUES('$servicio',$total,'$fechaActual','$dia','$mes','$anio')";
        echo mysqli_query($conexion,$insert); 
    }

    function buscarRepetido($i,$conexion){
        $sql="SELECT * FROM inventario where descripcion='$i'";
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