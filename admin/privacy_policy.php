<?php
include '../database/connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login');
    exit();
}

// GET THE TOTAL NUMBER OF REGISTERED VOTERS
$stmt = $conn->query("SELECT COUNT(*) FROM `tbl_voters`");
$totalVoters = $stmt->fetchColumn();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Comelec System</title>

    <link rel="shortcut icon" href="../assets/dashboard/img/comelec.png" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="../assets/dashboard/vendor/fontawesome-free/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="../assets/dashboard/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../assets/form/js/sweetalert2/dist/sweetalert2.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon">
                    <img style="width: 50px; border-radius: 50px;" src="../assets/dashboard/img/comelec.png" alt="">
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: 15px;">COMELEC<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="registered_users">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Voters</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="privacy_policy">
                    <i class="fas fa-fw fa-lock"></i>
                    <span>Privacy Policy</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i style="color: white;" class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle" src="../assets/dashboard/img/comelec.png" alt="'s Profile Picture">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-success"></i>
                                    Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="functions/logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="text-transform: capitalize">Privacy Policy</h1>
                    </div> -->

                    <!-- Content Row -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <!-- <h1 class="h3 mb-2 text-gray-800"><a href="" style="font-size: 20px; font-weight: 900; color: #242943
                        ; text-decoration: none;">
                                <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a><span style="font-size: 20px; color: grey;"> /
                                <a type="disabled" style="font-size: 20px; font-weight: 900">Registered Voters</a></span></h1> -->

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 30px">Privacy Policy</h6>
                            </div>
                            <div class="content p-3">
                                <p><span style="font-weight: 700; color: black;">Privacy :</span> <br>
                                    <span>The information that can be gathered in this site will be treated as highly confidential.
                                        The Comelec may use your contact information in order to send e-mail or other communications regarding your clearance or
                                        updates about this service. We may also use your data for statistics, summaries,
                                        research and studies for development of new markets and standards.</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container-fluid">

                </div>

                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Bootstrap core JavaScript-->
                <script src="../assets/dashboard/vendor/jquery/jquery.min.js"></script>
                <script src="../assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- Core plugin JavaScript-->
                <script src="../assets/dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="../assets/dashboard/js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="../assets/dashboard/vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="../assets/dashboard/js/demo/chart-area-demo.js"></script>
                <script src="../assets/dashboard/js/demo/chart-pie-demo.js"></script>


                <script src="../assets/form/js/sweetalert2/dist/sweetalert2.min.js"></script>
                <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) : ?>
                    <script>
                        $(document).ready(function() {
                            Swal.fire({
                                icon: "success",
                                iconColor: '#242943',
                                title: "Successfully logged in",
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        });
                    </script>
                    <?php unset($_SESSION['login_success']); ?>
                <?php endif; ?>
</body>

</html>