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
    background-color: #1c1c1c; /* Black Gray */
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


    <nav class="navbar-inverse" style="background-color:#1c1c1c;">
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

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/depan8.jpeg" style="width:75%" alt="Image">
        <div class="carousel-caption">
          <h3>Internet of Things</h3>
          <p>Absensi RFID Berbasis Web</p>
        </div>      
      </div>

      <div class="item">
        <img src="images/depan4.jpeg" style="width:75%" alt="Image">
        <div class="carousel-caption">
          <h3>We Are Administrators</h3>
          <p>Absensi RFID Berbasis Web</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
   
<div class="heading">
  <div class="container text-center">
    <h1><p>𝐒𝐞𝐥𝐚𝐦𝐚𝐭 𝐃𝐚𝐭𝐚𝐧𝐠 𝐝𝐢</P></h1>
  <h2> <P>Aplikasi Sistem Absensi Berbasis RFID </p><h2>      
   

<p><img src="images/maintenance.gif" style="width:50%"> </p>



<div class='headin'>
 

  <div class="row">
    
    <div class="col-sm-6">
            <p>Sistem Absensi Siswa RFID berbasis WEB yang Simpel dan Praktis</p>
    </div>
    <div class="col-sm-6"> 
      
      <p>Lebih Efisien dalam Meng-Absensi para Siswa dimanapun dan kapanpun</p>    
    </div>
</div>

    <div class="col-sm-12">
      <div class="well">


<br>
        <div class="headi">
            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <img src="images/scan1.png"
                            style="width:25%"
                                class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                           <!-- <h5 class="card-title">Simulasi penggambaran cara kerja dari absensi RFID ini.</h5> -->
                            <p class="card-text">Scan Kartu RFID ini  adalah Program  baru yang dibuat sekaligus digunakan untuk mengabsensi para siswa dengan desain dan UI yang simpel dan mudah untuk digunakan.</p>
                            <a href="#" class="btn btn-primary">Kembali ke Menu Awal</a>
                        </div>
                    </div>
                </div>
               </div>
             </div>
           </div>
         </div>
       </div>
            </div>  <br>

</div>
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