
<?php 
include "koneksi.php"; 

$sql=mysqli_query($konek,"select * from mode");
$data=mysqli_fetch_array($sql);
$mode=$data['mode'];

$mode_status="";
if($mode==1)
	$mode_status="Masuk";
else if ($mode==0)
	$mode_status="Pulang";

$baca_kartu = mysqli_query($konek,"select * from tmprfid");
$data_kartu = mysqli_fetch_array($baca_kartu);
$nokartu    = $data_kartu['nokartu'];

$cari = mysqli_query($konek,"select * from siswa where nokartu='$nokartu'");
$data=mysqli_fetch_array($cari);
if (mysqli_num_rows($cari)==0)
{
	$nama= "Anda tidak terdaftar...";
}
else
{
	$nama=$data['nama'];

}
//kosongkan tabel tmrfid
      mysqli_query($konek, "delete from tmprfid");
?>

<div class="container-fluid" style="text-align: center ;">
	<h2> Mode : <?php echo $mode_status; ?></h2>
    <h2>𝐒𝐢𝐥𝐚𝐡𝐤𝐚𝐧 𝐓𝐞𝐦𝐩𝐞𝐥𝐤𝐚𝐧 𝐊𝐚𝐫𝐭𝐮 𝐑𝐅𝐈𝐃 𝐀𝐧𝐝𝐚</h2>
	<h3> No Kartu : <?php echo $nokartu; ?></h3>
	<h3> Hallo <?php echo $nama; ?></h3>
	<br><img src="images/kartu.gif" style="width:20%" ><br>
    <img src="images/animasi2.gif" >


</div>