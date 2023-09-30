<?php
include '../../database/connection.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $contact = $_POST['contact'];
    $occupation = $_POST['occupation'];
    $address = $_POST['address'];
    $existingProfilePicture = $_POST['existing_profile_picture'];

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0 && !empty($_FILES['profile_picture']['name'])) {
        $uploadDir = '../../assets/dashboard/images/';
        $fileName = $_FILES['profile_picture']['name'];
        $targetFilePath = $uploadDir . $fileName;

        if (file_exists($targetFilePath)) {
            unlink($targetFilePath);
        }

        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath);

        $stmt = $conn->prepare("UPDATE `tbl_voters` SET `profile_picture` = ? WHERE `id` = ?");
        $stmt->execute([$fileName, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE `tbl_voters` SET `profile_picture` = ? WHERE `id` = ?");
        $stmt->execute([$existingProfilePicture, $id]);
    }

    $stmt = $conn->prepare("UPDATE `tbl_voters` SET `name` = ?, `email` = ?, `age` = ?, `birthday` = ?, `contact` = ?, `occupation` = ?, `address` = ? WHERE `id` = ?");
    if ($stmt->execute([$name, $email, $age, $birthday, $contact, $occupation, $address, $id])) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
    }
} else {
    header('location: ../login.php');
}

header('Content-Type: application/json');
echo json_encode($response);
