<?php
    ob_start();
    include("../conexion/conexion.php");
    //parametro fecha
    $anio=$_POST['anio'];

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
    $d = date('d') - 1;
    $m = date('m') ;
    $y = date('Y') ;
    if($d < 10){
        $fe = "$y-$m-0$d";
    }else{
        $fe = "$y-$m-$d";
    }
?>

    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <p>Fecha: <?php echo $fe?></p>
    <h3>Ingreso: <?php echo $totalIngresoAnio?></h3>
    <h3>Egreso: <?php echo $totalEgresoAnio?></h3>
    <h3>Ganancia: <?php echo $ganancia?></h3>
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

