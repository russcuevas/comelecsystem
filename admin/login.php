<?php
include '../database/connection.php';

session_start();
if (isset($_SESSION['admin_id'])) {
  header('location: dashboard');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Comelec System </title>
  <link rel="stylesheet" href="../assets/form/css/form.css">
  <link rel="shortcut icon" href="../assets/dashboard/img/comelec.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/form/js/sweetalert2/dist/sweetalert2.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="../assets/dashboard/css/HoldOn.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="../assets/dashboard/img/comelec.png" alt="">
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Login</div>
          <form id="login-form" action="functions/login.php" method="POST">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="email" name="email" placeholder="Enter your email">
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Enter your password">
              </div>
              <div class="text" style="text-align: center;"><a href="#" id="forgot-password-link">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" name="submit" value="Login">
              </div>
            </div>
          </form>
          <div id="forgot-password-form" style="display: none; padding: 20px">
            <div style="font-size: 15px !important; text-align: center; font-weight: 900;">Forgot Password</div>
            <form id="forgot-password-form" action="functions/forgot_password.php" method="POST">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="forgot-email" name="forgot-email" placeholder="Enter your email">
              </div>
              <div class="button input-box">
                <input type="submit" value="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="loading-container">
      <div id="loading-spinner">
        <img src="../assets/dashboard/img/loading.gif" alt="Loading...">
      </div>
    </div>

    <script src="../assets/form/js/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/dashboard/js/HoldOn.min.js"></script>
    <script src="ajax/login.js"></script>
    <script src="ajax/forgot_pass.js"></script>
    <script>
      $(document).ready(function() {
        $("#forgot-password-link").click(function(e) {
          e.preventDefault();
          $("#forgot-password-form").toggle();
        });
      });
    </script>

</body>

</html>