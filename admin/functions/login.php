<?php
include '../../database/connection.php';

$response = array();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM `tbl_admin` WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && sha1($password) === $admin['password']) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
    }
} else {
    $response['status'] = 'error';
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
