<!DOCTYPE html>
<html>
<head>
	<title>Melinda Juliyana</title>
	<?php include "header.php"; ?>
	
</head>
<style>
	   .navbar {
      margin-bottom: 0;
      border-radius: 0;
      font-size:14px;
        font-family:'Inconsolata', monospace;
        color:#2f2f2f;
        letter-spacing:1px;
    }
    .container .bg1 {
    width: 400px;
    min-height: 350px;
   background: rgba(255,255,255,0.04);
    border-radius: 5px;
    box-shadow: -1px 4px 28px 0px rgba(0,0,0,0.75);
    padding: 40px 30px;
}
	.bg-1 { 
    background-color: #474e5d; /* Green */
    color: #ffffff;
  }
  .bg-2 { 
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
  }
  .bg-3 { 
    background-color: #2f2f2f; /* White */
    color: white;
  }
  .bg-4 { 
    background-color: #2f2f2f; /* Black Gray */
    color: #fff;
    font-size:14px;
        font-family:'Arial', monospace;
       
        letter-spacing:1px;

  }

</style>
<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">ABSENSI</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li> <a href="index.php"> Home </a></li>
      <li> <a href="absensi.php"> Attendance Recap </a></li>
      <li> <a href="scan.php"> Scan Card </a></li>
   
      <li> <a href="contact.php"> Contact </a></li>
        
      </ul>
    </div>
  </div>
</nav>
<!-- isi -->
	<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Profile</h3>
  <img src="images/melon.jpg" class="img-responsive" style="display:inline" alt="" width="300" height="300">
  <h3>Melinda Juliyana</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  
  <p>"My Best Friends is Myself"</p>
</div>

<!-- Third Container (Grid) -->
<div class="container-fluid bg-3 text-center">    
  <h3 class="margin">Contact</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <p>Instagram</p>
      <a  href="https://www.instagram.com/melinjuliyana"><img src="images/instagram_icon.png" class="center" style="width:15%" alt="Image"></a>
	  <p>@melinjuliyana</p>
	</div>
    <div class="col-sm-4"> 
      <p>My House</p>
      <img src="images/maps_google.png" class="center" style="width:17%" alt="Image">
	  <p>Bogor, Jawa Barat, Indonesia</p>
	</div>
    <div class="col-sm-4"> 
      <p>Whatsapp</p>
      <a href="https://api.whatsapp.com/send/?phone=6285773164448&text&type=phone_number&app_absent=0">
      <img src="images/whatsapp.png" class="center" style="width:25%" alt="Image"></a>
	  <p>+62 857-7316-4448</p>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  
  <div class="col-md-12">
      <div class="contact-info">
        
          <p>Copyright © 2022</p>

</footer>
	
</body>
</html>