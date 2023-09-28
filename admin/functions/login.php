<?php
include '../../database/connection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo 'error';
    } else {
        $stmt = $conn->prepare("SELECT * FROM `tbl_admin` WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && sha1($password) === $admin['password']) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
} else {
    echo 'error';
}
