<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>RFID</title>
    <style>
      .background-radial-gradient {
        background-color: #037fe5;
      }

      #radius-shape-1 {
        height: 220px;
        width: 220px;
        top: -60px;
        left: -130px;
        background: #3561dbda;
        overflow: hidden;
      }

      #radius-shape-2 {
        border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
        bottom: -60px;
        right: -110px;
        width: 300px;
        height: 300px;
        background: #3561dbda;
        overflow: hidden;
      }

      /* Importing fonts from Google */
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

      /* Reseting */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
      }

      .wrapper {
        max-width: 350px;
        min-height: 500px;
        margin: 80px auto;
        padding: 40px 30px 30px 30px;
        background-color: #ecf0f3;
        border-radius: 15px;
        position: relative;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
      }

      .logo {
        width: 80px;
        margin: auto;
      }

      .logo img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
      }

      .wrapper .name {
        font-weight: 600;
        font-size: 1.4rem;
        letter-spacing: 1.3px;
        padding-left: 10px;
        color: #555;
      }

      .wrapper .form-field input {
        width: 100%;
        display: block;
        border: none;
        outline: none;
        background: none;
        font-size: 1.2rem;
        color: #666;
        padding: 10px 15px 10px 10px;
        /* border: 1px solid red; */
      }

      .wrapper .form-field {
        padding-left: 10px;
        margin-bottom: 20px;
        border-radius: 20px;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
      }

      .wrapper .form-field .fas {
        color: #555;
      }

      .wrapper .btn {
        box-shadow: none;
        width: 100%;
        height: 40px;
        background-color: #037fe5;
        color: #fff;
        border-radius: 25px;
        box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
        letter-spacing: 1.3px;
      }

      .wrapper .btn:hover {
        background-color: #037fe5;
      }

      .wrapper a {
        text-decoration: none;
        font-size: 0.8rem;
        color: #037fe5;
      }

      .wrapper a:hover {
        color: #037fe5;
      }

      @media(max-width: 380px) {
        .wrapper {
          margin: 30px 20px;
          padding: 40px 15px 15px 15px;
        }
      }
    </style>
  </head>
  <body class="background-radial-gradient overflow-hidden">
    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
    <div class="wrapper ">
      <div class="logo">
        <img src="https://i.ibb.co/yVGxFPR/2.png" alt="">
      </div>
      <div class="text-center mt-4 name"> Login RFID</div>
      <form class="p-3 mt-3" method="POST">
        @csrf
        <div class="form-field d-flex align-items-center">
          <span class="far fa-user"></span>
          <input type="text" name="username" id="userName" placeholder="Username">
        </div>
        <div class="form-field d-flex align-items-center">
          <span class="fas fa-key"></span>
          <input type="password" name="password" id="pwd" placeholder="Password">
        </div>
        <button class="btn mt-3">Login</button>
      </form>
      </section>
      <!-- Section: Design Block -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
