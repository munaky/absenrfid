<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Rekapitulasi Absensi</title>
	<style>
        @media print {
            .input-group {
                display: none;
            }
            .button {
                display: none;
            }
            .find {
                display: none;
            }
            .nav-wrapper {
                display: none;
            }
            .footer {
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


	<!-- isi -->
	<div  class="container-fluid">
		<h3>𝐑𝐞𝐤𝐚𝐩 𝐀𝐛𝐬𝐞𝐧𝐬𝐢 𝐒𝐌𝐊𝐍 𝟒 𝐊𝐨𝐭𝐚 𝐁𝐨𝐠𝐨𝐫</h3>
		<div class="find">
			<form method="post">
				<p>Find by:</p>
				<select name="find_by" class="browser-default">
					<option value="a.nokartu">Nomor Kartu</option>
					<option value="b.nama">Nama</option>
					<option value="b.kelas">Kelas</option>
					<option value="a.tanggal">Tanggal</option>
					<option value="a.jam_masuk">Jam Masuk</option>
					<option value="a.jam_pulang">Jam Pulang</option>
					<option value="a.idlab">Lab</option>
				</select>
				<input type="text" name="target" placeholder="Masukan Data">
				<input type="submit" value="Find" name="search" class="btn blue">
				<button onclick="window.print()" class="btn red">Print Data</button>
			</form>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr style="background-color: #0e639c;  color:white">
					<th style="width: 10px; text-align: center">No.</th>
					<th style="text-align: center">Nomor Kartu</th>
					<th style="text-align: center">Nama</th>
					<th style="text-align: center">Kelas</th>
					<th style="text-align: center">Tanggal</th>
					<th style="text-align: center">Jam Masuk</th>
					<th style="text-align: center">Jam Pulang</th>
					<th style="text-align: center">Lab</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					include "koneksi.php";

					//baca tabel absensi dan relasikan dengan tabel siswa berdasarkan nomor kartu RFID untuk tanggal hari ini

					//baca tanggal saat ini
					date_default_timezone_set('Asia/Jakarta');
					$tanggal = date('Y-m-d');

					if(isset($_POST["search"])){
						$find_by = $_POST["find_by"];
						$target = $_POST["target"];
						
						if($konek->query("SELECT $find_by FROM absensi a, siswa b WHERE $find_by LIKE '%$target%'")->num_rows < 1){
							echo "<script>alert(\"data tidak ditemukan\");</script>";
							return;
						}

					//filter absensi berdasarkan tanggal saat ini
					$sql = mysqli_query($konek, "select b.nama, b.kelas, a.nokartu, a.tanggal, a.jam_masuk, a.jam_pulang, a.idlab from absensi a, siswa b where a.nokartu=b.nokartu and a.tanggal='$tanggal' AND $find_by LIKE '%$target%'");
					//$sql = mysqli_query($konek, "select * from absensi");
					$no = 0;
					while($data = mysqli_fetch_array($sql))
					{
						$no++;
					
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $data['nokartu']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['kelas']; ?></td>
					<td><?php echo $data['tanggal']; ?></td>
					<td><?php echo $data['jam_masuk']; ?></td>
					<td><?php echo $data['jam_pulang']; ?></td>
					<td><?php echo $data['idlab']; ?></td>
				</tr>
			<?php }} ?>
			</tbody>
		</table>
	</div>

	<?php include "footer.php"; ?>

</body>
</html>