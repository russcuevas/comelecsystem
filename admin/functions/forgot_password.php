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
                $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 0;
                        }
                        
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                        }
                        
                        .header {
                            background-color: #242943;
                            padding: 10px;
                            text-align: center;
                        }
                        
                        .content {
                            padding: 20px;
                            background-color: #ffffff;
                        }
                        
                        .button {
                            display: inline-block;
                            margin-top: 20px;
                            background-color: #242943;
                            padding: 10px 20px;
                            text-decoration: none;
                            border-radius: 4px;
                        }
        
                        .footer {
                            margin-top: 20px;
                            font-size: 12px;
                            color: #808080;
                            text-align: center;
                        }
                    </style>
                </head>
                <body>
                <div class="container">
                    <div class="header">
                    <img style="height: 100px; width: 100px;" src="https://wowjohn.com/wp-content/uploads/2022/05/comelec-logo-png-6-Transparent-Images-600x600.png" alt="Comelec Logo">
                    </div>
                    <div class="content">
                        <p>Greetings, <span style="font-weight: bold;"></span></p>
                        <p>Please click the following link to reset your password:</p>
                        <p><a class="button" style="color: white;" href="http://localhost/comelecsystem/admin/reset_password?token=' . $token . '">Click to reset</a></p>
                        <p>If the button above does not work, you can copy and paste the following URL into your browser:</p>
                        <p>http://localhost/comelecsystem/admin/reset_password?token=' . $token . '</p>
                        <p class="footer" style="text-align: center;">© to Mr. Russel Vincent C. Cuevas, Ms. Lyka Lalog, &amp; Mr. John Mark Manalo, developers of the Comelec System<br>
                        This message was sent to ' . $email . '.<br>
                        To help keep your account secure, please don\'t forward this email.</p>
                    </div>
                </div>
            </body>
            </html>
            ';
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
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                    }
                    
                    .header {
                        background-color: #242943;
                        padding: 10px;
                        text-align: center;
                    }
                    
                    .content {
                        padding: 20px;
                        background-color: #ffffff;
                    }
                    
                    .button {
                        display: inline-block;
                        margin-top: 20px;
                        background-color: #242943;
                        padding: 10px 20px;
                        text-decoration: none;
                        border-radius: 4px;
                    }
    
                    .footer {
                        margin-top: 20px;
                        font-size: 12px;
                        color: #808080;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                    <img style="height: 100px; width: 100px;" src="https://wowjohn.com/wp-content/uploads/2022/05/comelec-logo-png-6-Transparent-Images-600x600.png" alt="Comelec Logo">
                    </div>
                    <div class="content">
                        <p>Greetings, <span style="font-weight: bold;"></span></p>
                        <p>Please click the following link to reset your password:</p>
                        <p><a class="button" style="color: white;" href="http://localhost/comelecsystem/admin/reset_password?token=' . $token . '">Click to reset</a></p>
                        <p>If the button above does not work, you can copy and paste the following URL into your browser:</p>
                        <p>http://localhost/comelecsystem/admin/reset_password?token=' . $token . '</p>
                        <p class="footer" style="text-align: center;">© to Mr. Russel Vincent C. Cuevas, Ms. Lyka Lalog, &amp; Mr. John Mark Manalo, developers of the Comelec System<br>
                        This message was sent to ' . $email . '.<br>
                        To help keep your account secure, please don\'t forward this email.</p>
                    </div>
                </div>
            </body>
            </html>
            ';
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
