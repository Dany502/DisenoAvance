<?php
    ob_start();
    require '../funciones/validarusuario.php';
    if(!isset($_SESSION['usuario'])){
        header('location: index_login.php');
    }
    include("../conexion/conexion.php");
    //parametro fecha
    $fecha1=$_POST['semana1'];
    $fecha2=$_POST['semana2'];
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
    $sqlIngreso="SELECT SUM(total) ts FROM servicios WHERE fecha BETWEEN '$fecha1' AND '$fecha2'";
    $respuestaI=mysqli_query($conexion,$sqlIngreso);
    if($row1=$respuestaI->fetch_assoc()){
        $totalIngresoDia=$row1['ts'];
    }
    
    $sqlEgreso="SELECT SUM(total) tg FROM gastos WHERE fecha BETWEEN '$fecha1' AND '$fecha2'";
    $respuestaE=mysqli_query($conexion,$sqlEgreso);
    if($row2=$respuestaE->fetch_assoc()){
        $totalEgresoDia=$row2['tg'];
    }
    $ganancia=$totalIngresoDia-$totalEgresoDia;
    $ganancia=$totalIngresoDia-$totalEgresoDia;
    $d = date('d') - 1;
    $m = date('m') ;
    $y = date('Y') ;
    if($d < 10){
        $fe = "$y-$m-0$d";
    }else{
        $fe = "$y-$m-$d";
    }

    /* list($anio, $mes, $dia) = explode("-",$fecha1);
    $d=$dia;
    $di = "$anio-$mes-$d";
    list($anio2, $mes2, $dia2) = explode("-",$fecha2);
    $d2=$dia2; */

?>
    <style>
        *{
            margin: 0;
            padding: 0;
            color: #222;
        }
        .logo{
            text-align: center;
        }
        .logo img{
            width: 200px;
            height: 200px;
        }
        .encabezado{
            text-align: right;
            padding-top: 15px;
        }
        .encabezado p{
            margin: 5px;
            font-size: 18px;
        }
        .title{
            text-align: center;
            margin: 25px;
        }
        table{
            border-collapse: collapse;
            text-align: center;
            font-size: 18px;
            margin-left: 0;
        }
        .tabla2{
            margin-left: 90px;
        }
        thead th{
            padding-left: 80px;
            padding-right: 70px;
            padding-top: 15px;
            padding-bottom: 15px;
            background: #45aaf2;
        }
        tbody td{
            padding-left: 70px;
            padding-right: 70px;
            padding-top: 10px;
            padding-bottom: 10px;
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
            <h1>Reporte Semanal</h1>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Dias</th>
                        <th>Ingreso</th>
                        <th>Egreso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $fechaInicio=strtotime($fecha1);
                        $fechaFin=strtotime($fecha2);
                        for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                            $fechaSeparada = date("Y-m-d", $i);
                            $s=$s+1;
                            switch ($s) {
                                case 1:
                                    $dias="Lunes";
                                    break;
                                case 2:
                                    $dias="Martes";
                                    break;
                                case 3:
                                    $dias="Miercoles";
                                    break;
                                case 4:
                                    $dias="Jueves";
                                    break;
                                case 5:
                                    $dias="Viernes";
                                    break;
                                case 6:
                                    $dias="Sabado";
                                    break;
                                case 7:
                                    $dias="Domingo";
                                    break;
                                }
                                

                            $consulaSe2="SELECT SUM(total)totalgasto FROM gastos WHERE fecha='$fechaSeparada'";
                            $resultadoConsulta2=mysqli_query($conexion,$consulaSe2);
                            if($row2=$resultadoConsulta2->fetch_assoc()){
                                $totalgasto=$row2['totalgasto'];
                            }

                            $consulta="SELECT SUM(total) ts FROM servicios WHERE fecha='$fechaSeparada'";
                            $res=mysqli_query($conexion,$consulta);
                            if($rw=$res->fetch_assoc()){
                                $diatotal=$rw['ts'];
                                $salida.="<tr>
                                    <td>$dias</td>
                                    <td>Q$diatotal</td>
                                    <td>Q$totalgasto</td>
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
                        <th>Ingreso</th>
                        <th>Egreso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Q<?php echo $totalIngresoDia?></td>
                        <td>Q<?php echo $totalEgresoDia?></td>
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
    $html2pdf->Output('ReporteSemana.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
?>

