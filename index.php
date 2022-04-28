<?php
    require 'funciones/validarusuario.php';
    if(!isset($_SESSION['usuario'])){
        header('location: index_login.php');
    }
    $id=$_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Diseño</title>
    <link rel="stylesheet" href="Estilos/estilo-bar.css">
    <link rel="stylesheet" href="Estilos/estilo-main-content.css">
    <link rel="stylesheet" href="Estilos/estilo-cards.css">
    <link rel="stylesheet" href="Estilos/estilo-card.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
     <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet"></link>
</head>

<body>
    <!--Opciones de menú side-brand-->
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <p>
                <span>Menu principal</span>
            </p>
        </div>
        <div class="sidebar-menu">
            <ul><br>
                <li><a href="index.php" class="active"><span><img src="Img/comienzo.png" width="30px" height="30px"></span><span>Inicio</span></a></li>
                <li><a href="Ingreso-egreso.html"><span><img src="Img/tabla-de-ingresos.png" width="30px" height="30px"></span><span>Ingreso/Egreso</span></a></li>
                <li><a href="Conteo.html"><span><img src="Img/moneda.png" width="30px" height="30px"></span><span>Conteo de efectivo</span></a></li>
                <li><a href="Reporte.html"><span><img src="Img/reporte-anual.png" width="30px" height="30px"></span><span>Reporte</span></a></li>
                <li><a href="index_login.php?CerrarSesion=true" class="Boton-salir"><span><img src="Img/salida.png" width="30px" height="30px"></span><span>Salir</span></a></li>
            </ul>
        </div>
    </div>

    <!--Botón para minimizar y maximizar el menú-->
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle" class="botton"><i class="bi bi-grid-3x3-gap-fill"></i></label>
                
            </h2>
            <div class="title-wrapper">
                <p>Sistema de Gestor para servicios</p>
            </div>
            
            <!--Inicio de sesión-->
            <div class="user-wrapper">
                <img src="Img/empleados.png" width="40px" height="40px">
                <div>
                    <h4 id="empleado"></h4>
                    <small>Empleado</small>
                </div>
            </div>
        </header>

        <!--Estadistica de reportes en las cards(tarjetas)-->
        <main>
            <div class="cards">
                <div class="card-single ingresos">
                    <div class="tarjeta">
                        <p id="ingreso-t"></p>
                        <span>Ingreso total</span>
                    </div>
                </div>

                <div class="card-single egresos">
                    <div class="tarjeta">
                        <p id="egreso-t"></p>
                        <span>Egreso total</span>
                    </div>
                </div>
                
                <div class="card-single ganacias">
                    <div class="tarjeta">
                        <p id="ganancia-t"></p>
                        <span>Ganancia total</span>
                    </div>
                </div>

            </div>
            <br>
            <!--Creacion de graficas-->
            <div class="grafic">
                <div class="card">
                    <div class="estadistic-header">
                        <h3>Ingresos/Egresos</h3>
                        <canvas id="myChart" width="400" height="250"></canvas>
                    </div>
                </div>
            </div>
        </main>
    
    </div>
   
</body>
</html>
    <script src="jQuery.js"></script>
    <script src="js/totales.js"></script>
    <script src="js/empleado.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    
    <script>
        $(document).ready(function(){
           
            $.ajax({
                url:'controlador_grafico.php',
                type:'POST',
                success:function(resp){
                    let titulo=[];
                    let cantidad=[];
                    let data = JSON.parse(resp)
                    for (let i = 0; i < data.length; i++) {
                        titulo.push(data[i][1]);
                        cantidad.push(data[i][2]);
                    }
                    const ctx = document.getElementById('myChart');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: titulo,
                            datasets: [{
                                label: '# of Votes',
                                data: cantidad,
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(0, 128, 0, 0.5)',
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(0, 128, 0, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                }
            })
            
        })
        
    </script>