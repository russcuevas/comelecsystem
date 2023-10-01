<?php
include '../database/connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login.php');
}

$admin_id = $_SESSION['admin_id'];

?>
<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Comelec System</title>

    <!-- Include Datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Include Datepicker JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <link rel="shortcut icon" href="../assets/dashboard/img/comelec.png" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <!-- {{-- <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> --}} -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="../assets/dashboard/css/sb-admin-2.min.css">
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="../assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.css">
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
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>

            <li class="nav-item">
                <a class="nav-link" href="registered_users.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Voters</span></a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle"
                                    src="../assets/dashboard/img/comelec.png" alt="'s Profile Picture">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
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

                <!-- Page Heading -->
                    <h1 class="h3 mb-2 ml-5 text-gray-800"><a href="dashboard.php" style="font-size: 20px; font-weight: 900; color: #337ab7
                        ; text-decoration: none;">
                        <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a><span style="font-size: 20px; color: grey;"> /
                    <a type="disabled" style="font-size: 20px; font-weight: 900">Profile</a></span></h1>

                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="font-size: 30px;">Update password</div>
                                <div class="card-body">
                                    <form id="change-pass" method="POST" action="functions/update_profile.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="hidden" name="id" value="<?php echo $admin_id ?>">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control" id="password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm_password">Confirm password</label>
                                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Change password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    <!-- Bootstrap core JavaScript-->
    <script src="../assets/dashboard/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/dashboard/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/dashboard/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.css"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/dashboard/js/demo/datatables-demo.js"></script>
    <!-- SWEETALERT -->
    <script src="../assets/form/js/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="ajax/change_pass.js"></script>
</body>

</html>
