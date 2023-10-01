<?php
include '../../database/connection.php';

$response = array();

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: ../login.php');
    exit();
}

$admin_id = $_SESSION['admin_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($new_password) || empty($confirm_password)) {
        $response['status'] = 'warning';
        $response['message'] = 'Please fill up all fields';
        echo json_encode($response);
        exit();
    }

    if (strlen($new_password) < 8 || strlen($new_password) > 12) {
        $response['status'] = 'error';
        $response['message'] = 'Password must 8-12 characters';
        echo json_encode($response);
        exit();
    }

    if ($new_password !== $confirm_password) {
        $response['status'] = 'error';
        $response['message'] = 'Password not match';
        echo json_encode($response);
        exit();
    }

    $hashed_password = sha1($new_password);

    $update_query = "UPDATE `tbl_admin` SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->execute([$hashed_password, $admin_id]);

    if ($stmt->rowCount() > 0) {
        $response['status'] = 'success';
        $response['message'] = 'Change password successfully';
        echo json_encode($response);
        exit();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Password update failed';
        echo json_encode($response);
        exit();
    }
}
