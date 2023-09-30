<?php
include '../database/connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login.php');
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare('SELECT id FROM `tbl_voters` WHERE id = ?');
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $deleteStmt = $conn->prepare('DELETE FROM `tbl_voters` WHERE id = ?');

        if ($deleteStmt->execute([$id])) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        header('location: dashboard.php');
    }
} else {
    header('location: dashboard.php');
}
