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
        background: url('Assets/images/carnet/malawi.png');
        /*if you want to change the background image replace logo.png*/
        background-repeat: repeat-x;
        background-size: 250px 450px;
        opacity: 0.2;
        z-index: -1;
        text-align: center;

    }

    .container {
        font-size: 12px;
        font-family: sans-serif;

    }

    .id-1 {
        transition: 0.4s;
        width: 450px;
        height: 250px;
        background: #FFFFFF;
        text-align: center;
        font-size: 16px;
        font-family: sans-serif;
        float: left;
        margin: auto;
        margin-left: 570px;
        border-radius: 2%;
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
                        <img src="Assets/images/carnet/love.png" alt="Avatar" width="50px" height="50px">
                    </td>
                    <td>
                        <h3><b>CENTRAL ÚNICA REGIONAL DE RONDAS CAMPESINAS</b></h3>
                        <center><h3><b>LA LIBERTAD</b></h3></center>
                    </td>
                </tr>
            </table>
            <center>
                <?php  
     $idx = $_GET['id'];
      $sqlmember ="SELECT * FROM persona WHERE idpersona='$idx'";
			$retrieve = mysqli_query($db,$sqlmember);
			$count=0;
      
     
      while($found = mysqli_fetch_array($retrieve)){
/*         $title=$found['Mtitle'];$firstname=$found['Firstname'];$sirname=$found['Sirname'];$rank=$found['Rank'];
        $id=$found['id'];$dept=$found['Department'];$contact=$found['Email'];
        $count=$count+1;  $get_time=$found['Time']; $time=time(); $pass=$found['Staffid'];
        $names=$firstname." ".$sirname;
        $profile= $found['Picname']; */
        $title="Mr. ";
        $firstname="Anthony";
        $sirname="Enciso";
        $rank="1";
        $id="1";
        $dept="Lima";
        $contact="anthony@gmail.com";
        $count=$count+1;
        $get_time="11";
        $time=time();
        $pass="a";
        $names="aaaa vvv";
        $profile;
      }

             	 	
									echo"<img src='Assets/images/carnet/avatar.jpg' height='175px' width='200px' alt='' style='border: 2px solid black;'>";	   
										
             	 	 ?> </center>
            <div class="container" align="center">

                <p style="margin-top:2%">Name</p>
                <p style="font-weight: bold;margin-top:-4%">
                    <?php if(isset($names)){ $namez=$title.' '.$names;echo$namez;} ?></p>
                <p style="margin-top:-4%">Rank</p>
                <p style="font-weight: bold;margin-top:-4%"><?php if(isset($rank)){ echo$rank;} ?></p>
                <p style="margin-top:-4%">STAFF ID:</p>
                <p style="font-weight: bold;margin-top:-4%"><?php if(isset($pass)){ echo$pass;} ?></p>
                <p style="margin-top:-4%">MINISTRY/DEARTMENT:</p>
                <p style="font-weight: bold;margin-top:-4%"><?php if(isset($dept)){ echo$dept;} ?></p>
                <p style="margin-top:-4%">HOLDER SIGNATURE</p>

            </div>
        </div>
        <div class="id-1">

            <center><img src="Assets/images/carnet/malawi.png" alt="Avatar" width="200px" height="175px">
                <div class="container" align="center">
                    <p style="margin:auto">The bearer whose photograph appears overleaf is a staff of</p>
                    <h2 style="color:#00BFFF;margin-left:2%">THE STATE GOVERNMENT OF MALAWI </h2>
                    <p style="margin:auto">If lost and found please return to the nearest police station</p>
                    <hr align="center" style="border: 1px solid black;width:80%;margin-top:13%">
                    </hr>

                    <p align="center" style="margin-top:-2%">Authorised Signature</p>
                    <p> <?php if(isset($code)){ echo$code;}?>
                    </p>
                    <?php if(isset($name)){ echo"Property of ".$name;}?>
            </center>
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
