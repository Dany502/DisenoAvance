<?php
    ob_start();
    require '../funciones/validarusuario.php';
    if(!isset($_SESSION['usuario'])){
        header('location: index_login.php');
    }
    include("../conexion/conexion.php");
    //parametro fecha
    $mes=$_POST['mes'];
    $salida="";
    $iduser=$_SESSION['usuario'];

    //Consulta Usuario
    $sql="SELECT nombre, apellido FROM usuarios Where id=$iduser";
    $respuesta=mysqli_query($conexion,$sql);
    if($row=$respuesta->fetch_assoc()){
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
    }

    //Consultas datos
    $sqlIngreso="SELECT SUM(total) ts FROM servicios WHERE mes='$mes'";
    $respuestaI=mysqli_query($conexion,$sqlIngreso);
    if($row1=$respuestaI->fetch_assoc()){
        $totalIngresoMes=$row1['ts'];
    }
    
    $sqlEgreso="SELECT SUM(total) tg FROM gastos WHERE mes='$mes'";
    $respuestaE=mysqli_query($conexion,$sqlEgreso);
    if($row2=$respuestaE->fetch_assoc()){
        $totalEgresoMes=$row2['tg'];
    }
    
    $ganancia=$totalIngresoMes-$totalEgresoMes;
    $d = date('t') + 1;
    $m = date('m') - 1;
    $y = date('Y') ;
    if($d < 10){
        $fe = "$y-$m-0$d";
    }else{
        $fe = "$y-$m-$d";
    }
    if($m < 10){
        $fe = "$y-0$m-$d";
    }else{
        $fe = "$y-$m-$d";
    }
    

?>
    <style>
        *{
            margin: 0;
            padding: 0;
            color: #222;
        }
        .logo{
            text-align: left;
        }
        .logo img{
            width: 150px;
            height: 150px;
        }
        .encabezado{
            text-align: right;
            padding-top: -100px;
        }
        .encabezado p{
            margin: 2px;
        }
        .title{
            text-align: center;
            margin-top: -70px;
            margin-bottom: 15px;
        }
        table{
            border-collapse: collapse;
            text-align: center;
            font-size: 10px;
            margin-left: 120;
        }
        .tabla2{
            margin-left: 180px;
        }
        thead th{
            padding-left: 45px;
            padding-right: 45px;
            padding-top: 5px;
            padding-bottom: 5px;
            background: #45aaf2;
        }
        tbody td{
            padding-left: 45px;
            padding-right: 45px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-bottom: 1px solid #999; 
            border-top: 1px solid #999; 
        }
        .pie{
            text-align: center;
            margin-top: 50px;
        }

    </style>
    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <div class="logo">
        <img src="../Img/cenet.png" alt="">
    </div>
    <div class="encabezado">
        <p><b>Fecha:</b> <?php echo $fe?></p>
        <p><?php echo $nombre ?></p>
        <p><?php echo $apellido ?></p>
    </div>
    <div class="cuerpo">
        <div class="title">
            <h3>Reporte Mensual</h3>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Fechas</th>
                        <th>Ingreso</th>
                        <th>Egreso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $inicio = date("Y-$mes-01");
                        $fin = date("Y-$mes-$d");
                        $fechaInicio=strtotime($inicio);
                        $fechaFin=strtotime($fin);
                        for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                            $dias = $dias + 1;
                            if($dias < 10){
                                $fechas = "$y-$mes-0$dias";
                            }else{
                                $fechas = "$y-$mes-$dias";
                            }
                            if($dias)
                            
                            $sqlIngreso="SELECT SUM(total) ts FROM servicios WHERE dia=$dias AND mes=$mes";
                            $respuestaI=mysqli_query($conexion,$sqlIngreso);
                            if($row1=$respuestaI->fetch_assoc()){
                                $totalIngresoDias=$row1['ts'];
                                
                            }
                            $sqlEgreso="SELECT SUM(total) tg FROM gastos WHERE dia=$dias AND mes=$mes";
                            $respuestaE=mysqli_query($conexion,$sqlEgreso);
                            if($row2=$respuestaE->fetch_assoc()){
                                $totalEgresoDias=$row2['tg'];
                                $salida.="<tr>
                                    <td>$fechas</td>
                                    <td>Q$totalIngresoDias</td>
                                    <td>Q$totalEgresoDias</td>
                                 </tr>";
                            }
                            

                        }
                        echo $salida;
                    
                    ?>
                    
                </tbody>
            </table>
        </div>
        <br><br>
        <div>
            <table class="tabla2">
                <thead>
                    <tr>
                        <th>Ingreso Total</th>
                        <th>Egreso Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Q<?php echo $totalIngresoMes?></td>
                        <td>Q<?php echo $totalEgresoMes?></td>
                    </tr>
                    <tr>
                        <td><b>Ganancia:</b></td>
                        <td> Q<?php echo $ganancia?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pie">
        <p>CENET © Entre Rios el Asintal Retalhuleu</p>
    </div>
    </page>

<?php
//CODIGO GENERADOR PDF
  $content = ob_get_clean();
  require_once(dirname(__FILE__).'/vendor/autoload.php');
  use Spipu\Html2Pdf\Html2Pdf;
  try
  {
    $html2pdf = new HTML2PDF('P', 'Carta', 'es', true, 'UTF-8', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('ReporteMes.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
?>

