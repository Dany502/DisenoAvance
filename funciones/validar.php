<?php

$correo=$_POST['correo'];
$password=$_POST['pass'];

include("../conexion/conexion.php");

$sql="SELECT id, correo, contraseña FROM usuarios WHERE correo='$correo' AND contraseña='$password'";
$result=mysqli_query($conexion,$sql);
if($row=$result->fetch_assoc()){
    $id=$row['id'];
    $email=$row['correo'];
    $pass=$row['contraseña'];

    if($email=$correo && $pass=$password){
        session_start();
        $_SESSION['usuario']=$id;
        $response = array (
            'response' => 'true',
        );
    }

}else{
    $response = array (
        'response' => 'false',
    );
}

die (json_encode($response));