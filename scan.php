<!DOCTYPE html>
<html>
<head>
  <?php include "header.php"; ?>

  <script type="text/javascript">
    $(document).ready(function(){
      setInterval(function(){
        $("#cekkartu").load('bacakartu.php')
      },2000);
    });
  </script>
  
  <title>Scan Kartu</title>
</head>
<body>
  
  <?php include "menu.php"; ?>
  <div class="container-fluid">
    <div id="cekkartu"></div>
  </div>


  <?php include "footer.php"; ?>
</body>
</html>