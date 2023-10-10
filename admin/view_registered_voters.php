<?php
include '../database/connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login');
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: dashboard');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM `tbl_voters` WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() === 0) {
        header('location: dashboard');
    } else {
        $voter = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter's Certification</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/dashboard/css/registered_voters.css">
    <link rel="shortcut icon" href="../assets/dashboard/img/comelec.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/dashboard/print/print.css" media="print">
</head>
<body>
<div class="container mt-3">
    <div style="margin-left: 90px;" class="d-flex align-items-center">
        <img src="../assets/dashboard/img/comelec.png" alt="Logo" class="logo">
        <div class="title-container ml-3">
            <p class="header">Republic of the Philippines</p>
            <p class="header">Commission on Elections</p>
        </div>
    </div>
    <h1 class="text-center mt-5">Voter's Certification</h1>
    <p class="bold text-center">This is to certify that lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo rem dolores necessitatibus vel accusamus eum voluptatibus dolor quibusdam at nobis nesciunt fugiat, odit magnam aperiam blanditiis magni repellat dicta deserunt!</p>

    <p id="infoRegister" class="text-center">Registration Information</p>
    <div class="row voter-info">
        <div class="col-md-6">
            <img id="imageProfile" style="height: 100px; width: 100px;" src="../assets/dashboard/images/<?php echo $voter['profile_picture']; ?>" alt="">
            <p class="bold">Name: <?php echo $voter['name'] ?> </p>
            <p class="bold">Date of Birth: <?php echo date('m-d-Y', strtotime($voter['birthday'])); ?></p>
        </div>
        <div class="col-md-6">
            <p class="bold">Age: <?php echo $voter['age'] ?> </p>
            <p class="bold">Occupation: <?php echo $voter['occupation'] ?></p>
            <p class="bold">Address: <?php echo $voter['address']; ?></p>
        </div>
    </div>

    <div class="row voter-regis">
        <div class="col-md-6">
            <p class="bold">Date Issue : </p>
            <p id="datetime"></p>
        </div>
        <div class="col-md-6">
            <p class="bold">Signed by : </p>
            <p>Russel Vincent C. Cuevas</p>
        </div>
    </div>

    <footer class="footer text-center">
        <p style="color: black; font-weight: 900;">This individual is a registered voter in the <br> <span style="color: red; font-weight: 900;"><?php echo $voter['address']; ?></span> area.</p>
    </footer>

    <div class="d-flex justify-content-end mt-3">
        <button class="btn btn-info text-white" style="background-color: #337ab7 !important;" id="printButton">Print Voters Certificate</button>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../assets/dashboard/print/print.js"></script>
<script>
        function updateDateTime() {
            var now = new Date();
            var date = now.toLocaleDateString();
            var time = now.toLocaleTimeString();

            document.getElementById("datetime").innerHTML = date + " / " + time;
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>

</body>
</html>








