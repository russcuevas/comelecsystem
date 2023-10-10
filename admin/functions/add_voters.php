<?php
include '../../database/connection.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $occupation = $_POST['occupation'];

    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_size = $_FILES['profile_picture']['size'];
    $profile_tmp_name = $_FILES['profile_picture']['tmp_name'];
    $profile_folder = '../../assets/dashboard/images/' . $profile_picture;

    if ($profile_size > 2000000) {
        $response['status'] = 'error';
    } else {
        move_uploaded_file($profile_tmp_name, $profile_folder);

        date_default_timezone_set('Asia/Manila');
        $date_registered = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO `tbl_voters` (name, email, age, birthday, contact, address, occupation, profile_picture, date_registered) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$name, $email, $age, $birthday, $contact, $address, $occupation, $profile_picture, $date_registered]);
        $response['status'] = 'success';
    }
} else {
    header('location: ../login');
}

header('Content-Type: application/json');
echo json_encode($response);
