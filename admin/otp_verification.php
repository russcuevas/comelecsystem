<?php
include '../database/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $submittedOTP = $_POST["otp"];

    $stmt = $conn->prepare("SELECT * FROM `tbl_admin` WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($user["otp"] && $user["otp_expiration"] > date("Y-m-d H:i:s") && $submittedOTP == $user["otp"]) {
            $stmt = $conn->prepare("UPDATE `tbl_admin` SET otp = NULL, otp_expiration = NULL WHERE id = :id");
            $stmt->bindParam(":id", $user["id"]);
            $stmt->execute();

            session_start();
            $_SESSION['admin_id'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid OTP. Please try again.";
        }
    } else {
        echo "Invalid email.";
    }
}
