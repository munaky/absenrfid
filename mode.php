<!DOCTYPE html>
<html>
<head>
  <title>Contact</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
}
      .bg-4 { 
    background-color: #2f2f2f; /* Black Gray */
    color: #fff;
  }
    }
  </style>
</head>

<?php 
include "koneksi.php";

if(isset($_POST['btn']))
{
		$mode=$_POST['status'];
		mysqli_query($konek, "update mode set mode='$mode' where id=1");
}

///$konek=mysqli_connect("localhost", "root", "", "absen");
$data=mysqli_query($konek,"select * from mode");
$sql=mysqli_fetch_array($data);
$mode=$sql['mode'];
//echo $mode;
if ($mode==1)
	$ket="Masuk";
if ($mode==0)
	$ket="Pulang";



include "menu.php";
 ?>


<div class="jumbotron">
  <div class="container text-center">
    <h1>𝗦𝗲𝘁𝘁𝗶𝗻𝗴 𝗠𝗼𝗱𝗲</h1>      
    <p>Silahkan Pilih Mode Yang Akan Digunakan</p>
 
	
	<div class="panel panel-default"  >
		<div class="panel-body" >
			<form action="" method="POST">
				<h2><b><?php echo $ket; ?> </b></h2> 
					<h3>

						
 




					<input type="radio" value="1" name="status" id="status"> Masuk
					<input type="radio" value="0" name="status" id="status"> Pulang
				</h3>
			<button class="btn btn-primary" name="btn" id="btn">Save</button>	
			</form>
		</div>
	</div>
</div>



</html>