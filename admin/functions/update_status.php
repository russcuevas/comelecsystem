<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include '../../database/connection.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voterId = $_POST["voterId"];
    $status = "Approve";

    $sql = "UPDATE tbl_voters SET status = :status WHERE id = :voterId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":status", $status, PDO::PARAM_STR);
    $stmt->bindParam(":voterId", $voterId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $getVoterQuery = "SELECT * FROM tbl_voters WHERE id = :voterId";
        $getVoterStmt = $conn->prepare($getVoterQuery);
        $getVoterStmt->bindParam(":voterId", $voterId, PDO::PARAM_INT);
        $getVoterStmt->execute();
        $voters = $getVoterStmt->fetch(PDO::FETCH_ASSOC);

        if ($voters) {
            $email = $voters["email"];

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
            $mail->Subject = 'Voter Registration Approval';
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
                background-color: #ffffff;
            }
            
            .header {
                background-color: #242943;
                color: #ffffff;
                padding: 10px;
                text-align: center;
            }
            
            .content {
                padding: 20px;
            }
            
            .content p {
                margin-bottom: 15px;
            }
            
            .content ul {
                list-style-type: none;
                padding: 0;
            }
            
            .content li {
                margin-bottom: 10px;
            }
            
            .button {
                display: inline-block;
                margin-top: 20px;
                background-color: #242943;
                color: #ffffff;
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
                <h1>Congratulations!</h1>
            </div>
            <div class="content">
                <p>Your voter registration has been approved. Below are your details:</p>
                <ul>
                    <li><strong>Name:</strong> ' . $voters['name'] . '</li>
                    <li><strong>Age:</strong> ' . $voters['age'] . '</li>
                    <li><strong>Contact:</strong> ' . $voters['contact'] . '</li>
                    <li><strong>Address:</strong> ' . $voters['address'] . '</li>
                    <li><strong>Occupation:</strong> ' . $voters['occupation'] . '</li>
                </ul>
                <p>You can now get your voters certificate by visiting the Municipality.</p>
            </div>
            <div class="footer">
                <p>Thank you for choosing us!</p>
            </div>
        </div>
    </body>
    </html>
';


            try {
                $mail->send();
                $response['status'] = 'success';
                $response['message'] = 'Approve voters registration';
            } catch (Exception $e) {
                $response['status'] = 'error';
                $response['message'] = 'Error sending email: ' . $mail->ErrorInfo;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Voter not found';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Not updating';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
