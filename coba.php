<?php

// koneksi database
$conn = mysqli_connect('localhost', 'root', '', 'absenrfid');

// cek nis
if (isset($_POST['nokartu'])) {
 $nokartu = $_POST['nokartu'];

 $query = mysqli_query($conn, "SELECT nokartu FROM siswa WHERE nokartu = '$nokartu'"); 

 if($query->num_rows > 0) {
  echo "<script>alert('NO Kartu sudah terdaftar');</script>";
 } else {
  mysqli_query($conn, "INSERT INTO siswa (nokartu) VALUES ('$nokartu')");
 }
}

// tampilkan data
$stmt = mysqli_query($conn, "SELECT nokartu FROM siswa");

?>

<!DOCTYPE html>
<html>
<head>
 <title>Validasi data yang sudah ada didatabase dengan PHP</title>
</head>
<body>

 <h3>Contoh validasi NIS</h3>

 <form method="POST" action="">
  <label for="nokartu">Masukan Nomor Kartu</label>
  <input type="text" name="nokartu" id="nokartu">
  <button type="submit" name="submit">Kirim</button>
 </form>
 
 <br/>
 <hr/>
 <br/>

 <table border="1">
  <tr>
   <td>No.</td>
   <td>NOKARTU</td>
  </tr>

  <?php
  $no = 1;
  foreach ($stmt as $rows) :
  ?>
   
  <tr>
   <td><?= $no++; ?></td>
   <td><?= $rows['nokartu']; ?></td>
  </tr>

  <?php endforeach; ?>

 </table>

</body>
</html>
