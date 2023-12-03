<?php
include '../database/connection.php';
require 'vendor/autoload.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST["email"];

//     $stmt = $conn->prepare("SELECT * FROM `tbl_admin` WHERE email = :email");
//     $stmt->bindParam(":email", $email);
//     $stmt->execute();
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($user) {
//         $otp = mt_rand(100000, 999999);

//         $mail = new PHPMailer(true);

//         try {
//             $mail->isSMTP();
//             $mail->SMTPDebug = 0;
//             $mail->SMTPAuth = true;
//             $mail->SMTPSecure = 'tls';
//             $mail->SMTPOptions = array(
//                 'ssl' => array(
//                     'verify_peer' => false,
//                     'verify_peer_name' => false,
//                     'allow_self_signed' => true
//                 )
//             );
//             $mail->Host = 'smtp.gmail.com';
//             $mail->Port = 587;
//             $mail->Username = 'russelarchiefoodorder@gmail.com';
//             $mail->Password = 'cjwitldatrerscln';

//             $mail->setFrom('your_email@example.com', 'Your Name');
//             $mail->addAddress($email);

//             $mail->isHTML(true);
//             $mail->Subject = 'OTP for Verification';
//             $mail->Body    = 'Your OTP is: ' . $otp;

//             $mail->send();

//             $stmt = $conn->prepare("UPDATE `tbl_admin` SET otp = :otp, otp_expiration = NOW() + INTERVAL 5 MINUTE WHERE id = :id");
//             $stmt->bindParam(":otp", $otp);
//             $stmt->bindParam(":id", $user["id"]);
//             $stmt->execute();

//             echo 'OTP sent successfully. Proceed to OTP verification.';
//         } catch (Exception $e) {
//             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//         }
//     } else {
//         echo "Invalid email.";
//     }
// }


?>

<!-- otp_verification.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>

<body>
    <form action="otp_verification.php" method="post">
        <label>Email:</label>
        <input type="text" name="email" placeholder="Enter your email" required>
        <br>
        <label>OTP:</label>
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <br>
        <input type="submit" name="submit" value="Verify OTP">
    </form>
</body>

</html>