<?php
    require 'funciones/validarusuario.php';
    if(isset($_GET['CerrarSesion'])){
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="assets/">

    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login-info-container">
            <h1 class="title">Iniciar sesion</h1>
            <div class="logo-form">
               
                 <img src="assets/user.png" alt="">    
            </div>
            <div class="alert" id="error">
                <p>Verifique bien sus datos</p>
            </div>
        <!-- <p id="error" style="color: red;">contraseña incorrecta</p> -->
        <form class="inputs-container" id="formulario" method="POST" action="funciones/validar.php" enctype="multipart/form-data">
             <input id="correo" name="correo" class="input" type="email" placeholder="Usuario" required autofocus>
             <input id="pass" name="pass" class="input" type="password" placeholder="Contraseña" required>
             <button  id="btnIniciar" class="btn-login">Iniciar sesion</button>
        </form>
        </div>
        <div class="image-container">
            <img src="assets/logo.png" alt="login"> 
        </div>
        
    </div>
    


    </main>

   <script src="js/login.js"></script>
</body>
</html>