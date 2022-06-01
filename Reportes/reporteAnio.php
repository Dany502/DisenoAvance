<?php
    ob_start();
    require '../funciones/validarusuario.php';
    if(!isset($_SESSION['usuario'])){
        header('location: index_login.php');
    }
    include("../conexion/conexion.php");
    //parametro fecha
    $anio=$_POST['anio'];
    $iduser=$_SESSION['usuario'];

    //Consulta Usuario
    $sql="SELECT nombre, apellido FROM usuarios Where id=$iduser";
    $respuesta=mysqli_query($conexion,$sql);
    if($row=$respuesta->fetch_assoc()){
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
    }

    //Consultas datos
    $sqlIngreso="SELECT SUM(total) ts FROM servicios WHERE anio='$anio'";
    $respuestaI=mysqli_query($conexion,$sqlIngreso);
    if($row1=$respuestaI->fetch_assoc()){
        $totalIngresoAnio=$row1['ts'];
    }
    
    $sqlEgreso="SELECT SUM(total) tg FROM gastos WHERE anio='$anio'";
    $respuestaE=mysqli_query($conexion,$sqlEgreso);
    if($row2=$respuestaE->fetch_assoc()){
        $totalEgresoAnio=$row2['tg'];
    }
    
    $ganancia=$totalIngresoAnio-$totalEgresoAnio;
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
            margin-top: 0px;
            margin-bottom: 25px;
        }
        table{
            border-collapse: collapse;
            text-align: center;
            font-size: 17px;
            margin-left: 70;
        }
        .tabla2{
            margin-left: 130px;
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
            margin-top: 140px;
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
            <h1>Reporte Anual</h1>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Meses</th>
                        <th>Ingreso</th>
                        <th>Egreso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i=1; $i<=12; $i++){
                            $s=$s+1;
                            switch ($s) {
                                case 1:
                                    $mes="Enero";
                                    break;
                                case 2:
                                    $mes="Febrero";
                                    break;
                                case 3:
                                    $mes="Marzo";
                                    break;
                                case 4:
                                    $mes="Abril";
                                    break;
                                case 5:
                                    $mes="Mayo";
                                    break;
                                case 6:
                                    $mes="Junio";
                                    break;
                                case 7:
                                    $mes="Julio";
                                    break;
                                case 8:
                                    $mes="Agosto";
                                    break;
                                case 9:
                                    $mes="Septiembre";
                                    break;
                                case 10:
                                    $mes="Octubre";
                                    break;
                                case 11:
                                    $mes="Noviembre";
                                    break; 
                                case 12:
                                    $mes="Diciembre";
                                    break;
                                }
                                

                            $consulaSe2="SELECT SUM(total)totalgasto FROM gastos WHERE mes=$s AND anio=$anio";
                            $resultadoConsulta2=mysqli_query($conexion,$consulaSe2);
                            if($row2=$resultadoConsulta2->fetch_assoc()){
                                $totalgasto=$row2['totalgasto'];
                            }

                            $consulta="SELECT SUM(total) ts FROM servicios WHERE mes=$s AND anio=$anio";
                            $res=mysqli_query($conexion,$consulta);
                            if($rw=$res->fetch_assoc()){
                                $mestotal=$rw['ts'];
                                $salida.="<tr>
                                    <td>$mes</td>
                                    <td>Q$mestotal</td>
                                    <td>Q$totalgasto</td>
                                </tr>";
                            }
                        }
                        echo $salida;
                    
                    
                    
                    ?>
                    
                </tbody>
            </table>
        </div>
        <br><br><br><br>
        <div>
            <table class="tabla2">
                <thead>
                    <tr>
                        <th>Ingreso total</th>
                        <th>Egreso total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Q<?php echo $totalIngresoAnio?></td>
                        <td>Q<?php echo $totalEgresoAnio?></td>
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
    $html2pdf->Output('ReporteAnio.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
?>

