<?php
include '../database/connection.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $contact = $_POST['contact'];
    $occupation = $_POST['occupation'];
    $address = $_POST['address'];

    $check_existing = $conn->prepare("SELECT COUNT(*) FROM `tbl_voters` WHERE email = ?");
    $check_existing->execute([$email]);
    $email_count = $check_existing->fetchColumn();

    if ($email_count > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Email already exists. Please try a new one.';
    } else {
        $profile_picture = $_FILES['profile_picture']['name'];
        $profile_size = $_FILES['profile_picture']['size'];
        $profile_tmp_name = $_FILES['profile_picture']['tmp_name'];
        $profile_folder = 'assets/dashboard/images/' . $profile_picture;

        $stmt = $conn->prepare('INSERT INTO `tbl_voters` (name, email, age, birthday, contact, occupation, address, profile_picture) VALUES (?,?,?,?,?,?,?,?)');
        $stmt->execute([$name, $email, $age, $birthday, $contact, $occupation, $address, $profile_picture]);

        $response['status'] = 'success';
        $response['message'] = 'Registration successful';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
