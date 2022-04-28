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
            margin-bottom: 35px;
        }
        table{
            border-collapse: collapse;
            text-align: center;
            font-size: 17px;
            margin-left: 70px;
        }
        thead th{
            padding-left: 45px;
            padding-right: 45px;
            padding-top: 10px;
            padding-bottom: 10px;
            background: #45aaf2;
        }
        tbody td{
            padding-left: 45px;
            padding-right: 45px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #999; 
            border-top: 1px solid #999; 
        }
        .pie{
            text-align: center;
            margin-top: 140px;
        }
        .totales{
            font-size: 25px;
            margin-left: 70px;
        }
    </style>
    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <div class="logo">
        <img src="../Img/cenet.png" alt="">
    </div>
    <div class="encabezado">
        <p><b>Fecha:</b> <?php echo $fe?></p>
        <p>Alberto Fabricio</p>
        <p>Cabrera Dueñas</p>
    </div>
    <div class="cuerpo">
        <div class="title">
            <h1>Conteo Efectivo</h1>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Monedas</th>
                        <th>Cantidad</th>
                        <th>total</th>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                        <td>Q0.25</td>
                        <td><?php echo $modena1?></td>
                        <td><?php echo $modena11 ?></td>
                   </tr>
                   <tr>
                        <td>Q0.50</td>
                        <td><?php echo $modena2?></td>
                        <td><?php echo $modena22 ?></td>
                   </tr>
                   <tr>
                        <td>Q1</td>
                        <td><?php echo $modena3?></td>
                        <td><?php echo $modena33 ?></td>
                   </tr>
                   <tr>
                        <td>Q5</td>
                        <td><?php echo $modena4?></td>
                        <td><?php echo $modena44 ?></td>
                   </tr>
                   <tr>
                        <td>Q10</td>
                        <td><?php echo $modena5?></td>
                        <td><?php echo $modena55 ?></td>
                   </tr>
                   <tr>
                        <td>Q20</td>
                        <td><?php echo $modena6?></td>
                        <td><?php echo $modena66 ?></td>
                   </tr>
                   <tr>
                        <td>Q50</td>
                        <td><?php echo $modena7?></td>
                        <td><?php echo $modena77 ?></td>
                   </tr>
                   <tr>
                        <td>Q100</td>
                        <td><?php echo $modena8?></td>
                        <td><?php echo $modena88 ?></td>
                   </tr>
                   <tr>
                        <td>Q200</td>
                        <td><?php echo $modena9?></td>
                        <td><?php echo $modena99 ?></td>
                   </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="totales">
        <br><hr>
        <br><br>
        <p>Total Efectivo: <b>Q<?php echo $total?></b></p><br>
        <p>Total Caja Día: <b>Q<?php echo $totalCajaDia ?></b></p>
    </div>
    <div class="pie">
        <br><br>
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
    $html2pdf->Output('ReporteConteo.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
?>

