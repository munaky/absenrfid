<!-- proses penyimpanan -->

<?php 
	include "koneksi.php";

	//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		//$nokartu = $_POST['nokartu'];
		$nama    = $_POST['nama'];
		$kelas  = $_POST['kelas'];

		// cek validasi nokartu
		if (isset($_POST['nokartu'])) {
		 $nokartu = $_POST['nokartu'];

		 $query = mysqli_query($konek, "SELECT nokartu FROM siswa WHERE nokartu = '$nokartu'"); 

		 if($query->num_rows > 0) {
		  echo "<script>
		  			alert('NO KARTU SUDAH TERDAFTAR'); 
		  			location.replace('tambah.php');
		  		</script>";
		 } else {
		 //simpan ke tabel siswa
		 mysqli_query($konek, "INSERT INTO siswa (nokartu, nama, kelas) VALUES ('$nokartu', '$nama', '$kelas')");
		 echo "<script>
		 			alert('DATA BERHASIL DISIMPAN'); 
		 			location.replace('datasiswa.php');
		 			</script>";
		 }
		}

	}

	//kosongkan tabel tmprfid
	mysqli_query($konek, "delete from tmprfid");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Tambah Data Siswa</title>

	<!-- pembacaan no kartu otomatis -->
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$("#norfid").load('nokartu.php')
			}, 0);  //pembacaan file nokartu.php, tiap 1 detik = 1000
		});
	</script>

</head>
<body>

	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<h3>Tambah Data Siswa</h3>

		<!-- form input -->
		<form method="POST">
			<div id="norfid"></div>

			<div class="form-group">
				<label>Nama Siswa</label>
				<input type="text" name="nama" id="nama" placeholder="Nama Siswa" class="form-control" style="width: 250px">
			</div>
			<div class="form-group">
				<label>Kelas</label>
				<select class="form-control" name="kelas" id="kelas" required="" style="width: 250px">
                                                <?php 
                                                include 'koneksi.php';
                                                $sql = "SELECT * FROM tb_kelas";
                                                $hasil = mysqli_query($konek, $sql);                                      
                                                while ($data = mysqli_fetch_array($hasil)) {           
                                                ?>
                                                <option value="<?php echo $data['kelas'];?>"><?php echo $data['kelas']; ?></option>
                                                <?php } ?>
                                                   
                </select>
			</div>

			<button class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
		</form>
	</div>

	<?php include "footer.php"; ?>

</body>
</html>