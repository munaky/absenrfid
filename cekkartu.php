<?php 
include "koneksi.php"; 
$cari=mysqli_query($konek,"select * from tmprfid");
$hasil=mysqli_fetch_array($cari);
//$nokartu=$hasil['nokartu'];
//$idlab=$hasil['idlab']; 
$nokartu = isset($data['nokartu']) ? $data['nokartu'] : '';
$idlab = isset($data['idlab']) ? $data['idlab'] : '';
echo $nokartu;
echo $idlab;
?>








