<?php
include '../../database/connection.php';
require '../vendor/autoload.php';

date_default_timezone_set('Asia/Manila');
use PHPMailer\PHPMailer\PHPMailer;

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["forgot-email"];

    $stmt = $conn->prepare('SELECT id FROM tbl_admin WHERE email = ?');
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        $existingTokenStmt = $conn->prepare('SELECT token, reset_expires FROM tbl_forgotpassword WHERE admin_id = ?');
        $existingTokenStmt->execute([$admin['id']]);
        $existingToken = $existingTokenStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingToken) {
            $deleteTokenStmt = $conn->prepare('DELETE FROM tbl_forgotpassword WHERE admin_id = ?');
            if ($deleteTokenStmt->execute([$admin['id']])) {
                $token = bin2hex(random_bytes(32));
                $resetExpires = date('Y-m-d H:i:s', strtotime('+1 minute'));

                $insertStmt = $conn->prepare('INSERT INTO tbl_forgotpassword (admin_id, token, reset_expires) VALUES (?, ?, ?)');
                $insertStmt->execute([$admin['id'], $token, $resetExpires]);

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->Username = 'russelarchiefoodorder@gmail.com';
                $mail->Password = 'cjwitldatrerscln';

                $mail->setFrom('comelecdeveloper@gmail.com', 'Comelec Developer');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = 'Click the following link to reset your password: <a href="http://localhost/comelecsystem/admin/reset_password?token=' . $token . '">Reset Password</a>';

                if ($mail->send()) {
                    $response['status'] = 'success';
                } else {
                    $response['status'] = 'error';
                }
            } else {
                $response['status'] = 'error';
            }
        } else {
            $token = bin2hex(random_bytes(32));
            $resetExpires = date('Y-m-d H:i:s', strtotime('+1 minute'));

            $insertStmt = $conn->prepare('INSERT INTO tbl_forgotpassword (admin_id, token, reset_expires) VALUES (?, ?, ?)');
            $insertStmt->execute([$admin['id'], $token, $resetExpires]);

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->Username = 'russelarchiefoodorder@gmail.com';
            $mail->Password = 'cjwitldatrerscln';

            $mail->setFrom('comelecdeveloper@gmail.com', 'Comelec Developer');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = 'Click the following link to reset your password: <a href="http://localhost/comelecsystem/admin/reset_password?token=' . $token . '">Reset Password</a>';

            if ($mail->send()) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        }
    } else {
        $response['status'] = 'error';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
