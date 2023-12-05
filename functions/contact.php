<?php
include '../database/connection.php';

$response = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO `tbl_inquiry` (name, email, message) VALUES (?,?,?)");
    $stmt->execute([$name, $email, $message]);
    $response['status'] = 'success';
    $response['message'] = 'Your inquiry has been sent';
};

header('Content-type: application/json');
echo json_encode($response);
