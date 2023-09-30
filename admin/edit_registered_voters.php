<?php
include '../database/connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login.php');
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: dashboard.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM `tbl_voters` WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() === 0) {
        header('location: dashboard.php');
        exit();
    } else {
        $voter = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
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

            <li class="nav-item active">
                <a class="nav-link" href="registered_users.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Voters</span></a>
            </li>

            <li class="nav-item">
                <a href="profile.php" class="nav-link">
                    <i class="fas fa-user"></i>
                    <span>Settings</span>
                </a>
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
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-success"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-success"></i>
                                    Settings
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-success"></i>
                                    Activity Log
                                </a> -->

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
                    <h1 class="h3 mb-2 ml-5 text-gray-800"><a href="registered_users.php" style="font-size: 20px; font-weight: 900; color: #337ab7
                        ; text-decoration: none;">
                        <i class="fas fa-fw fa-tachometer-alt"></i> Add voters</a><span style="font-size: 20px; color: grey;"> /
                    <a type="disabled" style="font-size: 20px; font-weight: 900">Update voters</a></span></h1>

                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" style="font-size: 30px;">Update voters</div>
                                <div class="card-body">
                                    <form id="update-form" method="POST" action="functions/update_voters.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="existing_profile_picture" value="<?php echo $voter['profile_picture']; ?>">
                                                    <label for="profile_picture">Profile Picture</label>
                                                    <input type="file" name="profile_picture" class="form-control-file" id="profile_picture" accept="image/jpeg, image/png" value="<?php echo $voter['profile_picture']; ?>">
                                                    <img id="preview" src="#" alt="Profile Picture Preview" style="display: none; max-width: 100px; max-height: 100px;">
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $voter['id'] ?>">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $voter['name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $voter['email'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="age">Age</label>
                                                    <input type="number" name="age" class="form-control" id="age" value="<?php echo $voter['age'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="birthday">Birthday</label>
                                                    <input type="text" name="birthday" class="form-control" id="birthday" value="<?php echo $voter['birthday'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact">Contact</label>
                                                    <input type="text" name="contact" class="form-control" id="contact" value="<?php echo $voter['contact'] ?>" required pattern="[0-9]{11}" maxlength="11">
                                                </div>
                                                <div class="form-group">
                                                    <label for="occupation">Occupation</label>
                                                    <input type="text" name="occupation" class="form-control" id="occupation" value="<?php echo $voter['occupation'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" class="form-control" id="address" value="<?php echo $voter['address'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary">Update Voter</button>
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
    <script src="../assets/dashboard/js/users.js"></script>
    <!-- SWEETALERT -->
    <script src="../assets/form/js/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="ajax/update_voters.js"></script>
    <script src="../assets/dashboard/js/users.js"></script>
</body>

</html>
