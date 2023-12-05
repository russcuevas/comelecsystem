<?php
include '../database/connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login');
}

$response = ['status' => 'error', 'message' => 'Failed to delete message'];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare('SELECT id FROM `tbl_inquiry` WHERE id = ?');
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $deleteStmt = $conn->prepare('DELETE FROM `tbl_inquiry` WHERE id = ?');

        if ($deleteStmt->execute([$id])) {
            $response = ['status' => 'success', 'message' => 'Message successfully deleted'];
        }
    }
}

echo json_encode($response);
