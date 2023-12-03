<?php
include '../../database/connection.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM `tbl_admin` WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && sha1($password) === $admin['password']) {
        $otp = mt_rand(100000, 999999);
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->Username = 'russelarchiefoodorder@gmail.com';
            $mail->Password = 'cjwitldatrerscln';

            $mail->setFrom('russelarchiefoodorder@gmail.com', 'Comelec Developer');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'OTP for Verification';
            $mail->Body = 'Your OTP is: ' . $otp;

            $mail->send();

            $stmt = $conn->prepare("UPDATE `tbl_admin` SET otp = :otp, otp_expiration = NOW() + INTERVAL 5 MINUTE WHERE id = :id");
            $stmt->bindParam(":otp", $otp);
            $stmt->bindParam(":id", $admin["id"]);
            $stmt->execute();

            $response['status'] = 'success';
            $response['message'] = 'Check your email OTP has been sent verify it';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid credentials';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
