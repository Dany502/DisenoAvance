<?php
    ob_start();
    include("../conexion/conexion.php");
    //parametro fecha
    $fecha=$_POST['dia'];

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
    $d = date('d') - 1;
    $m = date('m') ;
    $y = date('Y') ;
    if($d < 10){
        $mes = "$y-$m-0$d";
    }else{
        $mes = "$y-$m-$d";
    }
?>

    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <p>Fecha Dia: <?php echo $fecha?></p>
    <h3>Ingreso: <?php echo $totalIngresoDia?></h3>
    <h3>Egreso: <?php echo $totalEgresoDia?></h3>
    <h3>Ganancia: <?php echo $ganancia?></h3>
    <p>Fecha php: <?php echo $mes?></p>
    </page>

<?php
//CODIGO GENERADOR PDF
  $content = ob_get_clean();
  require_once(dirname(__FILE__).'/vendor/autoload.php');
  use Spipu\Html2Pdf\Html2Pdf;
  try
  {
    $html2pdf = new HTML2PDF('P', 'A5', 'es', true, 'UTF-8', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('ReporteDia.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
?>

