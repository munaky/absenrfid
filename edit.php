<!-- proses penyimpanan -->

<?php
	include "koneksi.php";

	//baca ID data yang akan di edit
	$id = $_GET['id'];

	//baca data karyawan berdasarkan id
	$cari = mysqli_query($konek, "select * from siswa where id='$id'");
	$hasil = mysqli_fetch_array($cari);

	//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		//Created By Fajar Juliyanto
		$nokartu = $_POST['nokartu'];
		$nama    = $_POST['nama'];
		$kelas  = $_POST['kelas'];


		//simpan ke tabel siswa
		$simpan = mysqli_query($konek, "update siswa set nokartu='$nokartu', nama='$nama',  kelas='$kelas'  where id='$id'");


		//jika berhasil tersimpan, tampilkan pesan Tersimpan,
		//kembali ke data siswa
		if($simpan)
		{
			echo "
			<script>
				alert('Tersimpan');
				location.replace('datasiswa.php');
			</script>
			";
		}
		else
		{
			echo "
			<script>
				alert('Gagal Tersimpan');
				location.replace('datasiswa.php');
			</script>
			";
		}

	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<tittle>Tambah Data Siswa</tittle>
</head>
<body>

	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<h3>Tambah Data Siswa</h3>

		<!-- form input -->
		<form method="POST">
			<div class="form-group">
				<label>No.Kartu</label>
				<input type="text" name="nokartu" placeholder="nomor kartu RFID" class="form-control" style="width: 200px" value="<?php echo $hasil['nokartu']; ?>">
			</div>
			<div class="form-group">
				<label>Nama Siswa</label>
				<input type="text" name="nama" placeholder="nama siswa" class="form-control" style="width: 400px" value="<?php echo $hasil['nama']; ?>">
			</div>

			<div class="form-group">
    		<label>Kelas</label>
                                                <select class="form-control" name="kelas" id="kelas" placeholder="Kelas" style="width: 400px">
                                                <?php 

                                                include 'koneksi.php';

                                                $sql = "SELECT * FROM tb_kelas";

                                                $result = mysqli_query($konek, $sql);

                                                $no = 0;

                                                while ($cari = mysqli_fetch_array($result)) {
                                                    
                                                $no++;
                                                

                                                 ?>
                                                <option value="<?php echo $cari['kelas'];?>"><?php echo $cari['kelas']; ?></option>
                                                <?php } ?>
                                                   
                                                </select>
             </div>
			<button class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
		</form>
	</div>

	<?php include "footer.php"; ?>

</body>
</html>