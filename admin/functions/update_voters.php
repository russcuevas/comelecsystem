<?php
include '../database/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $contact = $_POST['contact'];
    $occupation = $_POST['occupation'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE `tbl_voters` SET name = ?, email = ?, age = ?, birthday = ?, contact = ?, occupation = ?, address = ? WHERE id = ?");
    $result = $stmt->execute([$name, $email, $age, $birthday, $contact, $occupation, $address, $id]);

    if ($result) {
        header("Location: view_registered_voters.php");
        exit();
    } else {
        echo "Update failed. Please try again.";
    }
} else {
    echo "Invalid request.";
}
