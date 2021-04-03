<?php 
require '../../Assets/vendor/autoload.php';

session_start();
$found = $_SESSION['datos_carnet'];

$apellidos=$found['apellidos'];
$dni=$found['identificacion'];
$tipoCargo=$found['descrip'];
$contact="anthony@gmail.com";
$get_time="11";
$time=time();
$cargo=$found['nombrerol'];
$nombres=$found['nombres'];
$profile;

$fecha_emision = date("d-m-Y");
$fecha_caducidad = date("d-m-Y",strtotime($fecha_emision."+ 2 year"));

$a = (string)$dni;
$codigo = '20' . $a[1] . $a[2] . '567890';


$Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
$code = $Bar->getBarcode($codigo, $Bar::TYPE_CODE_128);

$departamento = $found['nomb_depart'];
$distrito = $found['nomb_distrito'];
$provincia = $found['nomb_provincia'];
$baserondera = $found['nomb_base'];
$direccion = $found['direccionfiscal'];

?>

<style>
  body {
    background: #008080;
  }

  #bg {
    width: 1000px;
    height: 450px;

    margin: 60px;
    float: left;

  }

  #id {
    width: 450px;
    height: 250px;
    position: absolute;
    opacity: 0.88;
    font-family: sans-serif;

    transition: 0.4s;
    background-color: #FFFFFF;
    border-radius: 2%;
    left: 50%;
    transform: translateX(-50%);
  }

  #id::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: url('Assets/images/carnet/fondo-carnet.png');
    /*if you want to change the background image replace logo.png*/
    background-repeat: repeat-x;
    background-size: 250px 450px;
    opacity: 0.6;
    z-index: -1;
    text-align: center;

  }

  .container {
    font-size: 12px;
    font-family: sans-serif;

  }

  .id-1 {
    width: 450px;
    height: 250px;
    position: absolute;
    opacity: 0.88;
    font-family: sans-serif;

    transition: 0.4s;
    background-color: #FFFFFF;
    border-radius: 2%;
    margin-top: 300px;
    left: 50%;
    transform: translateX(-50%);
  }

  #id-1::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: url('Assets/images/carnet/fondo-carnet.png');
    /*if you want to change the background image replace logo.png*/
    background-repeat: repeat-x;
    background-size: 250px 450px;
    opacity: 0.6;
    z-index: -1;
    text-align: center;
  }

  h3.titulo {
    font-size: 12px;
    color: #000;
    margin-bottom: -10px;
    padding-bottom: -10px;
  }
</style>

<body>
<br>
  <center><h1 style="color:#fff;">MI CREDENCIAL VIRTUAL</h1></center>

  <div id="bg">
    <div id="id">
      <table>
        <tr>
          <td>
            <img class="logo-nacional" src="Assets/images/carnet/escudo.png" alt="Avatar" width="50px" height="50px">
          </td>
          <td>
            <h3 class="titulo"><b>CENTRAL ÚNICA REGIONAL DE RONDAS CAMPESINAS</b></h3>
            <center>
              <h3 class="titulo"><b>LA LIBERTAD</b></h3>
            </center>
          </td>
        </tr>
      </table>

      <?php 
        echo"<img src='Assets/images/carnet/avatar.jpg' height='120px' width='110px' alt='' style='margin-left:10px; margin-top:15px;'>";	 
      ?>

      <div class="container" style="margin-left:135px; margin-top:-128px; font-size:13px;">

        <img src="Assets/images/carnet/logo2.png" alt="Avatar" width="170px"
          style="margin-top:-46px; margin-left:120px; position:absolute; opacity: 0.3; z-index:1">

        <p style="margin-top:2%">Apellidos:</p>
        <p style="font-weight: bold;margin-top:-4%">
          <?php if(isset($apellidos)){ $namez=$apellidos;echo$namez;} ?></p>
        <p style="margin-top:-4%">Nombres:</p>
        <p style="font-weight: bold;margin-top:-4%"><?php if(isset($nombres)){ echo$nombres;} ?></p>
        <p style="margin-top:-4%">Cargo:</p>
        <p style="font-weight: bold;margin-top:-4%"><?php if(isset($cargo)){ echo$cargo;} ?></p>
        <p style="margin-top:-4%">Tipo Cargo:</p>
        <p style="font-weight: bold;margin-top:-4%"><?php if(isset($tipoCargo)){ echo$tipoCargo;} ?></p>
        <div class="dni" style="margin-left:135px; margin-top:-45px;">
          <p style="">Dni:</p>
          <p style="font-weight: bold;margin-top:-6%"><?php if(isset($dni)){ echo$dni;} ?></p>
        </div>

        <div style="position:absolute; z-index:1000">
          <p style="font-weight: bold;margin-left: -120px; margin-top:8px; opacity: 1;">CREDENCIAL <?=$tipoCargo?>
          </p>
        </div>
        <div style="position:absolute; z-index:1000">
          <p style="font-weight: bold;margin-left: 120px; margin-top:8px; opacity: 1;">Código: <?=$codigo?>
          </p>

        </div>
        <div
          style="width:420px;margin-left: -135px; margin-top:0px; font-size:-10px; background-color: #fff;position:absolute; padding: 15px; opacity: 0.5; ; z-index:1">
        </div>

        <div style="position:abolute; margin-top:-140px; margin-left: 180px; z-index:1000">
          <table style="border: solid 1px; width: 125px; font-size: 13px">
            <tr>
              <td>Fecha de Emisión</td>
            </tr>
            <tr>
              <td style="font-weight: bold"><?=$fecha_emision?></td>
            </tr>
            <tr>
              <td style="border-top: solid 1px">Fecha Caducidad</td>
            </tr>
            <tr>
              <td style="color:red; font-weight: bold"><?=$fecha_caducidad?></td>
            </tr>
          </table>
        </div>


      </div>
    </div>
    <div class="id-1">
      <img src="Assets/images/carnet/logo.jpg" alt="Avatar" width="90px" height="85px"
        style="margin-top:80px; margin-left:15px; position:absolute;">

      <img src="Assets/images/carnet/logo.jpg" alt="Avatar" width="170px"
        style="margin-top:30px; margin-left:200px; position:absolute; opacity: 0.3;">

      <img src="Assets/images/carnet/PresidenteCUNARC.jpeg" alt="Avatar" width="90px"
        style="margin-top:27px; margin-left:40px; position:absolute;">
      <p style="font-size: 9px; margin-top: 60px; margin-left: 35px; position:absolute;">Presidente CUNARC - PERÚ</p>

      <img src="Assets/images/carnet/Presidentecurerc.jpeg" alt="Avatar" width="90px"
        style="margin-top:27px; margin-left:190px; position:absolute;">
      <p style="font-size: 9px; margin-top: 60px; margin-left: 180px; position:absolute;">Presidente CUNARC - PERÚ</p>

      <div class="container" style="margin-left:120px; margin-top:80px">
        <p style="margin-top:2%">Departamento:</p>
        <p style="font-weight: bold;margin-top:-4%">
          <?php if(isset($departamento)){ echo $departamento;} ?></p>
        <div class="dni" style="margin-left:100px; margin-top:-39px;">
          <p style="">Provincia:</p>
          <p style="font-weight: bold;margin-top:-6%"><?php if(isset($provincia)){ echo $provincia;} ?></p>
        </div>
        <div class="dni" style="margin-left:230px; margin-top:-40.5px;">
          <p style="">Distrito:</p>
          <p style="font-weight: bold;margin-top:-11%"><?php if(isset($distrito)){ echo$distrito;} ?></p>
        </div>
        <p style="margin-top:-4%">Dirección:</p>
        <p style="font-weight: bold;margin-top:-4%"><?php if(isset($direccion)){ echo$direccion;} ?></p>
        <p style="margin-top:-4%">Base Rondera:</p>
        <p style="font-weight: bold;margin-top:-4%"><?php if(isset($baserondera)){ echo$baserondera;} ?></p>

        <div style="position:absolute; z-index:1000">
          <p style="font-weight: bold;margin-left: -100px; margin-top:8px; opacity: 1; width:100px">CREDENCIAL REGIONAL
          </p>
        </div>
        <div style="margin-left: 130px; position:absolute; z-index:1000">
          <p style="opacity: 1;"> <?php if(isset($code)){ echo$code;}?></p>
        </div>
        <div
          style="width:400px;margin-left: -120px; margin-top:0px; font-size:-10px; background-color: #000;position:absolute; padding: 25px; opacity: 0.5; ; z-index:1">
        </div>

      </div>
    </div>

  </div>
  <script>
    var css = '@page { size: landscape; }',
      head = document.head || document.getElementsByTagName('head')[0],
      style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet) {
      style.styleSheet.cssText = css;
    } else {
      style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);
    window.print();
  </script>
</body>

</html>

<?php
/*     require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new DOMPDF();
    $dompdf->load_html(ob_get_clean());
    $dompdf->set_paper("letter", "portrait");
    $dompdf->render();
    $pdf = $dompdf->output();
    $filename = "profesionales.pdf";
    file_put_contents($filename, $pdf);
    $dompdf->stream($filename); */
?>