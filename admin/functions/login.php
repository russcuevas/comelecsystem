<?php
include '../../database/connection.php';
session_start();

$response = array();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM `tbl_admin` WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && sha1($password) === $admin['password']) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['login_success'] = true;
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
    }
} else {
    $response['status'] = 'error';
}

header('Content-Type: application/json');
echo json_encode($response);
