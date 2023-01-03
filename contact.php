<!DOCTYPE html>
<html lang="ID">
<head>
  <title>RFID</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <style>



   .bg-4 { 
    background-color: #2f2f2f; /* Black Gray */
    color: #fff;
    font-size:14px;
        font-family:'Arial', monospace;
       
        letter-spacing:1px;

  }
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      font-size:14px;
        font-family:'Inconsolata', monospace;
        color:#2f2f2f;
        letter-spacing:1px;
    }





.headin {
  font-size:17px;
        font-family:'Arial', monospace;
       
        letter-spacing:1px;
}


.headi {
font-size:14px;
        font-family:'Arial', monospace;
       
        letter-spacing:1px;

}


img.kiri {
    float: left;
    margin: 5px;
}
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #d1deff;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }

   
   
  </style>
</head>
<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">ABSENSI</a>
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

   

<div class="jumbotron">
  <div class="container text-center">
    <h1>SMKN 4</h1>      
    <p>Computer Network Engineering</p>
  </div>
</div>
  
<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading" >Administrator 1</div>
    <div class="panel-body"><a  href="siswa-1.php"><img src="images/jare.jpg" class="img-responsive" style="width:100%" alt="Image" /></a></div>
        <div class="panel-footer">Fajar Juliyanto</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">My Team</div>
    <div class="panel-body"><a  href="#"><img src="images/fmmmc.jpeg" class="img-responsive" style="width:100%" alt="Image" /></a></div>
        <div class="panel-footer">FMMMC</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Administrator 2</div>
    <div class="panel-body"><a  href="siswa-2.php"><img src="images/muhsin.jpg" class="img-responsive" style="width:100%" alt="Image" /></a></div>
        <div class="panel-footer">Fadilah Muhsin</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading" >Administrator 3</div>
    <div class="panel-body"><a  href="siswa-3.php"><img src="images/cahyo.jpeg" class="img-responsive" style="width:100%" alt="Image" /></a></div>
        <div class="panel-footer">Cahya Mulyani</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading" >Administrator 4</div>
    <div class="panel-body"><a  href="siswa-4.php"><img src="images/melon.jpg" class="img-responsive" style="width:100%" alt="Image" /></a></div>
        <div class="panel-footer">Melinda Juliyana</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading" >Administrator 5</div>
    <div class="panel-body"><a  href="siswa-5.php"><img src="images/Mita.jpeg" class="img-responsive" style="width:100%" alt="Image" /></a></div>
        <div class="panel-footer">Mita Yunisa</div>
      </div> 
    </div>
  </div>
</div><br><br>

<footer class="container-fluid bg-4 text-center">
  
  <div class="col-md-12">
      <div class="contact-info">
          <h5 class="nopadding"><b>Contact Us</b></h5>
          <p>Jl. Raya Tajur Kp. Buntar RT 02 RW 08 Kel. Muarasari Kec. Bogor Selatan Kota Bogor</p>
          <p><i class="fa fa-phone-square"></i><b>Phone</b> : +62 251 7547381</p>
          <p><i class="fa fa-envelope"></i><b>E-mail</b> : <a class="mail-link" href="mailto:smkn4@smkn4bogor.sch.id"> smkn4@smkn4bogor.sch.id</a></p>
      </div>
          <p><b>Copyright © 2022</b></p>

</footer>

</body>
</html>