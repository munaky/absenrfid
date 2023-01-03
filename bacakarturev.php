<!DOCTYPE html>
<html>

<head>
  <title>Scan</title>
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



<?php 
 include "koneksi.php";


$data=mysqli_query($konek,"select * from mode");
$sql=mysqli_fetch_array($data);
$mode=$sql['mode'];
//echo $mode;
if ($mode==1)
  $ket="Masuk";
if ($mode==0)
  $ket="Pulang";

     //baca tabel tmprfid
    $baca_kartu = mysqli_query($konek, "select * from tmprfid");
    $data_kartu = mysqli_fetch_array($baca_kartu);
    //$nokartu = $data_kartu['nokartu'];
    $nokartu = isset($data_kartu['nokartu']) ? $data_kartu['nokartu'] : '';
    $idlab = isset($data_kartu['idlab']) ? $data_kartu['idlab'] : '';
?>


<div class="container-fluid" style="text-align: center;">
   <?php if ($nokartu=="") { ?>

    <h2>𝐒𝐢𝐥𝐚𝐡𝐤𝐚𝐧 𝐓𝐞𝐦𝐩𝐞𝐥𝐤𝐚𝐧 𝐊𝐚𝐫𝐭𝐮 𝐑𝐅𝐈𝐃 𝐀𝐧𝐝𝐚</h2>
    <h2>Attendance Mode : <b> <?php echo $ket; ?> </b></h2>
     <br><img src="images/kartu.gif" style="width:40%" ><br>
     <img src="images/animasi2.gif" >

     <h3>ᴾᵃˢᵗⁱᵏᵃⁿ ᴷᵃʳᵗᵘ ᵀᵉʳᵗᵉᵐᵖᵉˡ ᵈᵉⁿᵍᵃⁿ ᴮᵉⁿᵃʳ</h3>
   
     <?php } else {
      //cek nomor kartu RFID tersebut apakah terdaftar di tabel siswa
      $cari_siswa = mysqli_query($konek, "select * from siswa where nokartu='$nokartu'");
      $jumlah_data = mysqli_num_rows($cari_siswa);

      if($jumlah_data==0)
         echo "<h1>Maaf! Kartu Tidak Dikenali</h1>";
      else 
      {
         //ambil nama siswa
         $data_siswa = mysqli_fetch_array($cari_siswa);
         $nama = $data_siswa['nama'];

         //tanggal dan jam hari ini 
         date_default_timezone_set('Asia/Jakarta');
         $tanggal = date('y-m-d');
         $jam     = date('H:i:s');



         //cek di tabel absensi, apakah nomor kartu tersebut sudah ada sesuai tanggal saat ini.Apabila belum ada, maka dianggap absen masuk, tapi kalau sudah ada, maka update data sesuai mode absensi
         $cari_absen = mysqli_query($konek, "select * from absensi where nokartu='$nokartu' and tanggal='$tanggal'");
         //hitung jumlah datanya
         $jumlah_absen = mysqli_num_rows($cari_absen);
         if($jumlah_absen == 0)
         {

             //hitung jumlah datanya
               
                     echo "<h1>Selamat Datang <br> $nama</h1>";
            mysqli_query($konek, "insert into absensi(nokartu, tanggal, jam_masuk, idlab)values('$nokartu', '$tanggal', '$jam', '$idlab')");

      
            
         }
         else
         {
          echo "<h1>Anda sudah Presensi Masuk</h1>";
		 }
            //update sesuai pilihan mode absen
         if($mode == 0)
         {

            $cari_absen_pulang = mysqli_query($konek, "select jam_pulang from absensi where nokartu='$nokartu' and tanggal='$tanggal'");
            $cek=mysqli_fetch_object($cari_absen_pulang);
             //hitung jumlah datanya
                //if(empty($cek->jam_pulang))
				if($cek->jam_pulang==0)
                {
                     echo "<h1>Hati - Hati di Jalan <br> $nama</h1>";
              mysqli_query($konek, "update absensi set jam_pulang='$jam' where nokartu='$nokartu' and tanggal='$tanggal'");

                }
                else
                {
                    echo "<h1>Anda sudah Presensi Pulang</h1>";
                }
            

            }
         }

      //kosongkan tabel tmrfid
      mysqli_query($konek, "delete from tmprfid");
     } ?>

</div>