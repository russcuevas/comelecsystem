<?php
include '../database/connection.php';
require 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/form/css/otp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/dashboard/css/HoldOn.min.css">
    <link rel="stylesheet" href="../assets/form/js/sweetalert2/dist/sweetalert2.css">
    <title>OTP Verification</title>
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
                    <div class="title">OTP Verification</div>
                    <form id="otp-form" action="otp_verification.php" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" id="email" name="email" placeholder="Re-enter your email">
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="text" id="otp" name="otp" placeholder="Enter OTP">
                            </div>
                            <div class="button input-box">
                                <input type="submit" name="submit" value="Verify OTP">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="../assets/form/js/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../assets/dashboard/js/HoldOn.min.js"></script>
        <script src="ajax/otp_verification.js"></script>
</body>

</html>