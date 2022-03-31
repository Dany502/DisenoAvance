<?php

$correo=$_POST['correo'];
$password=$_POST['pass'];

include("../conexion/conexion.php");

$consulta="SELECT id, correo, contraseña FROM usuarios WHERE correo='$correo' AND contraseña='$pass'";
$resultado=mysqli_query($conexion,$consulta);

    if($row=$resultado->fetch_assoc()){
        $id=$row['id'];
        $usuario=$row['correo'];
        $pass=$row['contraseña'];

        if($usuario=$correo && $pass=$password){
            $response = array(
                'response' => 'true',
            );
            
        }

    }else{
        $response = array(
            'response' => 'false'
        );
        
    }

echo json_encode($response);