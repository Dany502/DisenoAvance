<?php
    ob_start();
    require '../funciones/validarusuario.php';
    if(!isset($_SESSION['usuario'])){
        header('location: index_login.php');
    }
    include("../conexion/conexion.php");
    //parametro fecha
    $fecha=$_POST['dia'];
    $iduser=$_SESSION['usuario'];

    //Consulta Usuario
    $sql="SELECT nombre, apellido FROM usuarios Where id=$iduser";
    $respuesta=mysqli_query($conexion,$sql);
    if($row=$respuesta->fetch_assoc()){
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
    }

    //Consultas datos
    $sqlIngreso="SELECT SUM(total) ts FROM servicios WHERE fecha='$fecha'";
    $respuestaI=mysqli_query($conexion,$sqlIngreso);
    if($row1=$respuestaI->fetch_assoc()){
        $totalIngresoDia=$row1['ts'];
    }
    
    $sqlEgreso="SELECT SUM(total) tg FROM gastos WHERE fecha='$fecha'";
    $respuestaE=mysqli_query($conexion,$sqlEgreso);
    if($row2=$respuestaE->fetch_assoc()){
        $totalEgresoDia=$row2['tg'];
    }
    
    $ganancia=$totalIngresoDia-$totalEgresoDia;
    /* $d = date('d') - 1;
    $m = date('m') ;
    $y = date('Y') ;
    if($d < 10){
        $fe = "$y-$m-0$d";
    }else{
        $fe = "$y-$m-$d";
    } */
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
            padding-top: 20px;
        }
        .encabezado p{
            margin: 5px;
            font-size: 18px;
        }
        .title{
            text-align: center;
            margin: 80px;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 20px;
            margin-left: 80px;
        }
        thead th{
            padding-left: 80px;
            padding-right: 80px;
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
            margin-top: 280px;
        }

    </style>
    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <div class="logo">
        <img src="../Img/cenet.png" alt="">
    </div>
    <div class="encabezado">
        <p><b>Fecha:</b> <?php echo $fecha?></p>
        <p><?php echo $nombre ?></p>
        <p><?php echo $apellido ?></p>
    </div>
    <div class="cuerpo">
        <div class="title">
            <h1>Reporte del Dia</h1>
            <p></p>
        </div>
        <div class="tabl">
            <table>
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
    $html2pdf->Output('ReporteDia.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
?>

