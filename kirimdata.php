<?php 
include "koneksi.php"; 

$nokartu=$_GET['nokartu'];
$idlab=$_GET['idlab'];
mysqli_query($konek,"delete from  tmprfid");
mysqli_query($konek,"insert into tmprfid(nokartu,idlab) values('$nokartu','$idlab')");


// cek terdaftar atau tidak 
$datamode= mysqli_query($konek,"select * from mode");
$mode1=mysqli_fetch_array($datamode);
$mode_absen=$mode1['mode'];

$cari = mysqli_query($konek,"select * from siswa where nokartu='$nokartu'");
		$data=mysqli_num_rows($cari);

if ($data==0)
	echo "Anda belum terdaftar...";
else 
{
$cari_siswa = mysqli_query($konek,"select * from siswa where nokartu='$nokartu'");
$data=mysqli_fetch_array($cari_siswa);
$nama=$data['nama'];


date_default_timezone_set('Asia/Makassar');
$tanggal=date('Y-m-d');
$jam    =date('H:i:s');

$cariabsen = mysqli_query($konek,"select * from absensi where nokartu='$nokartu' and tanggal='$tanggal'");
$jml_absen = mysqli_fetch_array($cariabsen);
if ($jml_absen==0) 
{

		echo "selamat dtg ";
		echo $nama;
		mysqli_query($konek,"insert into absensi (nokartu, tanggal, jam_masuk, idlab)values('$nokartu','$tanggal','$jam','$idlab')");
	}
	else 
	{
		echo "Anda sdh absen ";
	} 
	if ($mode_absen==0)
		{
		$ket= "& TTDJ";
		echo " ".$ket;
		mysqli_query($konek,"update absensi set jam_keluar='$jam' where nokartu='$nokartu' and tanggal='$tanggal'");
		}
//mysqli_query($konek,"delete from tmprfid");
}
//mysqli_query($konek,"delete from tmprfid");

?>