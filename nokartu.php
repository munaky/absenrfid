<?php
	include "koneksi.php";
	//baca isi tabel tmprfid
	$sql = mysqli_query($konek, "select * from tmprfid");
	$data = mysqli_fetch_array($sql);
	//baca nokartu
	//$nokartu = $data['nokartu'];
	$nokartu = isset($data['nokartu']) ? $data['nokartu'] : '';
	$idlab = isset($data['idlab']) ? $data['idlab'] : '';
?>

<div class="form-group">
	<label>No Kartu</label>
	<input type="text" name="nokartu" id="nokartu" placeholder="Tempelkan Kartu RFID" class="form-control" style="width: 200px" value="<?php echo $nokartu; ?>">
</div>


<div class="form-group">
	<label>ID Lab</label>
	<input type="text" name="idlab" id="idlab" placeholder="idlab" class="form-control" style="width: 200px" value="<?php echo $idlab; ?>">
</div>