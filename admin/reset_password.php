<?php
include '../database/connection.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn->prepare('SELECT admin_id, reset_expires FROM tbl_forgotpassword WHERE token = ?');
    $stmt->execute([$token]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header('Location: login');
        exit();
    }
} else {
    echo "Token parameter is missing. <a href='login'>Go back to login</a>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Comelec System </title>
    <link rel="stylesheet" href="../assets/form/css/form.css">
    <link rel="shortcut icon" href="../assets/dashboard/img/comelec.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/form/js/sweetalert2/dist/sweetalert2.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form id="reset-password-form" action="functions/reset_password.php" method="POST">
        <h2>Password Reset</h2><br>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <div>
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" required>
        </div>
        <div>
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
        </div>
        <div>
            <input type="submit" value="Reset Password">
        </div>
    </form>
    <script src="../assets/form/js/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="ajax/reset_pass.js"></script>
</body>

</html>