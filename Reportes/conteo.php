<?php
    ob_start();
    include("../conexion/conexion.php");
    //parametro fecha
    $modena1=$_POST['moneda1'];
    $modena2=$_POST['moneda2'];
    $modena3=$_POST['moneda3'];
    $modena4=$_POST['moneda4'];
    $modena5=$_POST['moneda5'];
    $modena6=$_POST['moneda6'];
    $modena7=$_POST['moneda7'];
    $modena8=$_POST['moneda8'];
    $modena9=$_POST['moneda9'];

    $modena11=$modena1*0.25;
    $modena22=$modena2*0.50;
    $modena33=$modena3*1;
    $modena44=$modena4*5;
    $modena55=$modena5*10;
    $modena66=$modena6*20;
    $modena77=$modena7*50;
    $modena88=$modena8*100;
    $modena99=$modena9*200;

    $total=$modena11+$modena22+$modena33+$modena44+$modena55+$modena66+$modena77+$modena88+$modena99;
    
    $d = date('d') - 1;
    $m = date('m') ;
    $y = date('Y') ;
    if($d < 10){
        $fecha = "$y-$m-0$d";
    }else{
        $fecha = "$y-$m-$d";
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

    $totalCajaDia=$totalIngresoDia-$totalEgresoDia;
    
?>

    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <h1>Conteo de Efectivo</h1>
    <h5>Monedas------------Cantidad------------Total</h5>
    <p>Q0.25:---------------------<?php echo $modena1?>----------------<?php echo $modena11 ?></p>
    <p>Q0.50:---------------------<?php echo $modena2?>----------------<?php echo $modena22 ?></p>
    <p>Q1:------------------------<?php echo $modena3?>----------------<?php echo $modena33 ?></p>
    <p>Q5:------------------------<?php echo $modena4?>----------------<?php echo $modena44 ?></p>
    <p>Q10:-----------------------<?php echo $modena5?>----------------<?php echo $modena55 ?></p>
    <p>Q20:-----------------------<?php echo $modena6?>----------------<?php echo $modena66 ?></p>
    <p>Q50:-----------------------<?php echo $modena7?>----------------<?php echo $modena77 ?></p>
    <p>Q100:----------------------<?php echo $modena8?>----------------<?php echo $modena88 ?></p>
    <p>Q200:----------------------<?php echo $modena9?>----------------<?php echo $modena99 ?></p>
    <hr>
    <h5>Total Efectivo: <b>Q<?php echo $total?></b></h5>
    <p>Total Caja Dia: <?php echo $totalCajaDia ?></p>
    
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

