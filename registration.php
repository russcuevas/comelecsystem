<?php
include './database/connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $contact = $_POST['contact'];
    $occupation = $_POST['occupation'];
    $address = $_POST['address'];

    $stmt = $conn->prepare('INSERT INTO `tbl_voters` (name, email, age, birthday, contact, occupation, address) VALUES (?,?,?,?,?,?,?)');
    $stmt->execute([$name, $email, $age, $birthday, $contact, $occupation, $address]);
    echo '<script>window.alert ("Registration success");</script>';
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Registration</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="shortcut icon" href="assets/dashboard/img/comelec.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header" class="alt">
            <a href="index" class="logo">
                <img style="margin-top: 5px;" src="assets/page/comelec_banner_sm.png" alt="">
            </a>
            <nav>
                <a href="#menu">Menu</a>
            </nav>
        </header>

        <!-- Menu -->
        <nav id="menu">
            <ul class="links">
                <li><a href="index">Home</a></li>
                <li><a href="about">About</a></li>
                <!-- <li><a href="generic">Generic</a></li> -->
                <li><a href="tutorial-registration">Tutorial registration</a></li>
            </ul>
            <ul class="actions stacked">
            </ul>
        </nav>

        <!-- Main -->
        <div id="main" class="alt">

            <!-- One -->
            <section id="one">
                <div class="inner">
                    <header class="major">
                        <h1>Please fill up the form to register</h1>
                        <span style="color: red;">Updated: 29 November 2023</span>
                    </header>

                    <!-- Content -->
                    <h2 id="content"></h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">Profile picture</label>
                        <input type="file" name="profile_picture" style="margin-bottom: 30px;">

                        <label for="">Name</label>
                        <input type="text" name="name" style="width: 500px; margin-bottom: 10px;">

                        <label for="">Email <span style="color: red;">(Please enter a valid email address)</span></label>
                        <input type="email" name="email" style="width: 500px;">

                        <label for="">Age</label>
                        <input type="text" name="age" style="width: 500px;">

                        <label for="">Birthday</label>
                        <input type="date" name="birthday" style="width: 500px; color: black;">

                        <label for="">Contact</label>
                        <input type="text" name="contact" style="width: 500px;">

                        <label for="">Occupation</label>
                        <input type="text" name="occupation" style="width: 500px;">

                        <label for="">Address</label>
                        <input type="text" name="address" style="width: 500px;">

                        <input type="submit" name="submit" style="margin-top: 5px;">
                    </form>
                    <hr class="major" />


                    <!-- Footer -->
                    <footer id="footer">
                        <div class="inner">
                            <ul class="icons">
                                <li><a target="_blank" href="https://www.facebook.com/comelec.ph/" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a>
                                </li>
                                <li><a target="_blank" href="https://twitter.com/COMELEC" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
                                <li><a target="_blank" href="https://www.instagram.com/comelecph/" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a>
                                </li>
                                <!-- <li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li> -->
                                <!-- <li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li> -->
                            </ul>
                            <ul class="copyright">
                                <li>&copy; 2023</li>
                                <li style="color: red;">This website is for educational purposes only</li>
                                <li>Made by: <a href="#">Russel Vincent C. Cuevas / Lyka Lalog / John Mark Manalo
                                        :)</a></li>
                            </ul>
                        </div>
                    </footer>

                </div>

                <!-- Scripts -->
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/js/jquery.scrolly.min.js"></script>
                <script src="assets/js/jquery.scrollex.min.js"></script>
                <script src="assets/js/browser.min.js"></script>
                <script src="assets/js/breakpoints.min.js"></script>
                <script src="assets/js/util.js"></script>
                <script src="assets/js/main.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                <!-- <script>
                    flatpickr("#birthday", {
                        dateFormat: "Y-m-d",
                    });
                </script> -->

</body>

</html>