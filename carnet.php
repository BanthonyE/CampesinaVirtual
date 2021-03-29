<?php 
$servername = "localhost";
$database = "db_campesinavirtual";
$username = "root";
$password = "";

$db = mysqli_connect($servername, $username, $password, $database);


require 'Assets/vendor/autoload.php';

$serial="0001";
$Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
$code = $Bar->getBarcode($serial, $Bar::TYPE_CODE_128);

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
    margin-left: 550px;
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
  <script type="text/javascript">
  </script>

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
      <center>
        <?php  
        $idx = $_GET['id'];
        $sqlmember ="SELECT * FROM persona
        INNER JOIN rol ON persona.rolid=rol.idrol 
        INNER JOIN cargo ON rol.idcargo=cargo.idcargo         
        WHERE idpersona='$idx'";
        $retrieve = mysqli_query($db,$sqlmember);
        $count=0;
            
        while($found = mysqli_fetch_array($retrieve)){
    /*         $title=$found['Mtitle'];$firstname=$found['Firstname'];$sirname=$found['Sirname'];$rank=$found['Rank'];
          $id=$found['id'];$dept=$found['Department'];$contact=$found['Email'];
          $count=$count+1;  $get_time=$found['Time']; $time=time(); $pass=$found['Staffid'];
          $names=$firstname." ".$sirname;
          $profile= $found['Picname']; */

          $apellidos=$found['apellidos'];
          $dni=$found['identificacion'];
          $tipoCargo=$found['descrip'];
          $contact="anthony@gmail.com";
          $count=$count+1;
          $get_time="11";
          $time=time();
          $cargo=$found['nombrerol'];
          $nombres=$found['nombres'];
          $profile;
        }             	 	
			    
		  ?>
      </center>

      <?php 
        echo"<img src='Assets/images/carnet/avatar.jpg' height='120px' width='110px' alt='' style='margin-left:10px; margin-top:15px;'>";	 
      ?>

      <div class="container" style="margin-left:135px; margin-top:-128px; font-size:13px;">

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
          <p style="font-weight: bold;margin-left: 120px; margin-top:8px; opacity: 1;">Código: 2004619693
          </p>

        </div>
        <div
          style="width:420px;margin-left: -135px; margin-top:0px; font-size:-10px; background-color: #fff;position:absolute; padding: 15px; opacity: 0.5; ; z-index:1">
        </div>

        <div style="position:abolute; margin-top:-140px; margin-left: 180px;">
          <table style="border: solid 1px; width: 125px; font-size: 13px">
            <tr>
              <td>Fecha de Emisión</td>
            </tr>
            <tr>
              <td style="font-weight: bold">28 12 2020</td>
            </tr>
            <tr>
              <td style="border-top: solid 1px">Fecha Caducidad</td>
            </tr>
            <tr>
              <td style="color:red; font-weight: bold">05 01 2022</td>
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
          <?php if(isset($apellidos)){ $namez=$apellidos;echo$namez;} ?></p>
        <div class="dni" style="margin-left:110px; margin-top:-39px;">
          <p style="">Provincia:</p>
          <p style="font-weight: bold;margin-top:-6%"><?php if(isset($dni)){ echo$dni;} ?></p>
        </div>
        <div class="dni" style="margin-left:210px; margin-top:-40.5px;">
          <p style="">Distrito:</p>
          <p style="font-weight: bold;margin-top:-9%"><?php if(isset($dni)){ echo$dni;} ?></p>
        </div>
        <p style="margin-top:-4%">Dirección:</p>
        <p style="font-weight: bold;margin-top:-4%"><?php if(isset($nombres)){ echo$nombres;} ?></p>
        <p style="margin-top:-4%">Base Rondera:</p>
        <p style="font-weight: bold;margin-top:-4%"><?php if(isset($cargo)){ echo$cargo;} ?></p>

        <div style="position:absolute; z-index:1000">
          <p style="font-weight: bold;margin-left: -100px; margin-top:8px; opacity: 1; width:100px">CREDENCIAL REGIONAL</p>
        </div>
        <div style="margin-left: 190px; position:absolute; z-index:1000">        
          <p style="opacity: 1;"> <?php if(isset($code)){ echo$code;}?></p>
        </div>
        <div
          style="width:400px;margin-left: -120px; margin-top:0px; font-size:-10px; background-color: #000;position:absolute; padding: 25px; opacity: 0.5; ; z-index:1">
        </div>

      </div>
    </div>

  </div>
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