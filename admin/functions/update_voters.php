<?php
include '../../database/connection.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $contact = $_POST['contact'];
    $occupation = $_POST['occupation'];
    $address = $_POST['address'];
    $existingProfilePicture = $_POST['existing_profile_picture'];

    // Check if 'profile_picture' is set and not empty
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
        // Use the 'existing_profile_picture' value to update the profile picture
        $stmt = $conn->prepare("UPDATE `tbl_voters` SET `profile_picture` = ? WHERE `id` = ?");
        $stmt->execute([$existingProfilePicture, $id]);
    }

    $stmt = $conn->prepare("UPDATE `tbl_voters` SET `name` = ?, `email` = ?, `age` = ?, `birthday` = ?, `contact` = ?, `occupation` = ?, `address` = ? WHERE `id` = ?");
    $stmt->execute([$name, $email, $age, $birthday, $contact, $occupation, $address, $id]);
}
