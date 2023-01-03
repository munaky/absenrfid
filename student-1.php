<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>IoT Absensi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 20px Montserrat, sans-serif;
    line-height: 1.8;
    color: #f5f6f7;
  }
  p {font-size: 16px;}
  .margin {margin-bottom: 45px;}
  .bg-1 { 
    background-color: #1abc9c; /* Green */
    color: #ffffff;
  }
  .bg-2 { 
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
  }
  .bg-3 { 
    background-color: #ffffff; /* White */
    color: #555555;
  }
  .bg-4 { 
    background-color: #2f2f2f; /* Black Gray */
    color: #fff;
  }
  .container-fluid {
    padding-top: 70px;
    padding-bottom: 70px;
  }
  .navbar {
    padding-top: 15px;
    padding-bottom: 15px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 12px;
    letter-spacing: 5px;
  }
  .navbar-nav  li a:hover {
    color: #1abc9c !important;
  }
  .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">HOME</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
		<li><a href="mode.php">MODE</a></li>
        <li><a href="scan.php">SCAN KARTU</a></li>
        <li><a href="contact.php">CONTACT</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Profile</h3>
  <img src="images/IMG-20220615-WA0021.jpg" class="img-responsive" style="display:inline" alt="" width="350" height="350">
  <h3>Muhammad Zaki Sahil Mubarok</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <h3 class="margin">About Me</h3>
  <p> Hamba Allah yang terlahir di bumi pada tanggal, 23 Juni 1996, saat ini sedang mencari teman hidup</p>
  <p>"Man Jadda Wajada"</p>
</div>

<!-- Third Container (Grid) -->
<div class="container-fluid bg-3 text-center">    
  <h3 class="margin">Contact</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <p>Instagram</p>
      <a  href="https://www.instagram.com/mzakisahil"><img src="images/instagram_icon.png" class="center" style="width:20%" alt="Image"></a>
	  <p>@mzakisahil</p>
	</div>
    <div class="col-sm-4"> 
      <p>My House</p>
      <img src="images/maps_google.png" class="center" style="width:20%" alt="Image">
	  <p>Bogor, Jawa Barat, Indonesia</p>
	</div>
    <div class="col-sm-4"> 
      <p>Phone Number</p>
      <img src="images/phone.png" class="center" style="width:20%" alt="Image">
	  <p>085714856750</p>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>© 2022 www.smkn4bogor.sch.id <a href="https://www.smkn4bogor.sch.id">www.smkn4bogor.sch.id</a></p> 
</footer>

</body>
</html>