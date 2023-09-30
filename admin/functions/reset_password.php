<?php
include '../../database/connection.php';

date_default_timezone_set('Asia/Manila');
$response = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $newPassword = $_POST["new-password"];
    $confirmPassword = $_POST["confirm-password"];

    if ($newPassword === $confirmPassword) {
        $stmt = $conn->prepare('SELECT admin_id, reset_expires FROM tbl_forgotpassword WHERE token = ?');
        $stmt->execute([$token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $adminId = $row['admin_id'];
            $resetExpires = strtotime($row['reset_expires']);
            $currentTimestamp = time();

            if ($currentTimestamp <= $resetExpires) {
                $hashedPassword = sha1($newPassword);

                $updateStmt = $conn->prepare('UPDATE tbl_admin SET password = ? WHERE id = ?');
                if ($updateStmt->execute([$hashedPassword, $adminId])) {
                    $response['status'] = 'success';

                    $deleteStmt = $conn->prepare('DELETE FROM tbl_forgotpassword WHERE admin_id = ?');
                    $deleteStmt->execute([$adminId]);
                } else {
                    $response['status'] = 'error';
                }
            } else {
                $response['status'] = 'token_expired';
            }
        } else {
            $response['status'] = 'error';
        }
    } else {
        $response['status'] = 'error';
    }
} else {
    $response['status'] = 'error';
}

header('Content-Type: application/json');
echo json_encode($response);
