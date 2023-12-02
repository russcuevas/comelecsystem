<?php
include '../../database/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voterId = $_POST["voterId"];
    $status = "Approve"; // Set status to "Approve"

    // Update the status in the database
    // Replace the following lines with your actual database update query
    $sql = "UPDATE tbl_voters SET status = :status WHERE id = :voterId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":status", $status, PDO::PARAM_STR);
    $stmt->bindParam(":voterId", $voterId, PDO::PARAM_INT);
    $stmt->execute();

    // Return a response (if needed)
    echo "Status updated successfully";
}
