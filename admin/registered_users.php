<?php
include '../database/connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login.php');
    exit();
}

$fetch = "SELECT * FROM `tbl_voters`";
$stmt = $conn->query($fetch);
$voter = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
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
                    <span>Registered Voters</span></a>
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
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-success"></i>
                                    Activity Log
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="">
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
                    <h1 class="h3 mb-2 text-gray-800"><a href="" style="font-size: 20px; font-weight: 900; color: #337ab7
                        ; text-decoration: none;">
                        <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a><span style="font-size: 20px; color: grey;"> /
                    <a type="disabled" style="font-size: 20px; font-weight: 900">Registered Voters</a></span></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="font-size: 30px">List of registered voters</h6>
                        </div>
                        <div style="margin-top: 20px; margin-left: 19px; display: flex; justify-content: space-between; align-items: center;">
                        <button style="margin-right: 10px;" id="employeeModalBtn" class="d-none d-sm-inline-block btn btn-m btn-primary shadow-sm">Add Voters +</button>
                            <a href="#" style="margin-right: 20px;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Full name</th>
                                            <th>Age</th>
                                            <th>Contact</th>
                                            <th>Birthday</th>
                                            <th>Address</th>
                                            <th>Occupation</th>
                                            <th>Date Registered</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($voter as $voters): ?>
                                        <tr>
                                        <td><img style="height: 50px; width: 50px; border-radius: 50px;"
                                            src="../assets/dashboard/images/<?php echo $voters['profile_picture']; ?>"
                                            alt="">
                                        </td>

                                            <td><?php echo $voters['name']; ?></td>
                                            <td><?php echo $voters['age']; ?></td>
                                            <td><?php echo $voters['contact']; ?></td>
                                            <td><?php echo $voters['birthday']; ?></td>
                                            <td><?php echo $voters['address']; ?></td>
                                            <td></td>
                                            <td><?php echo $voters['date_registered'] ?></td>
                                            <td>
                                                <a href="view_registered_voters.php?id=<?php echo $voters['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                                                <a href="edit_registered_voters.php?id="><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="delete_registered_voters.php?id="><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<!-- Modal -->
<div id="employeeModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Voters</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-form" method="POST" action="functions/add_voters.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Left Column -->
                            <div class="form-group">
                                <label for="profile_picture">Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control-file" id="profile_picture" accept="image/jpeg, image/png">
                                <img id="preview" src="#" alt="Profile Picture Preview" style="display: none; max-width: 100px; max-height: 100px;">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" name="age" class="form-control" id="age" placeholder="Enter Age" required>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="text" name="birthday" class="form-control" id="birthday" placeholder="Select Birthday" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Right Column -->
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" name="contact" class="form-control" id="contact" placeholder="Enter Contact" required
                                pattern="[0-9]{11}" maxlength="11">
                            </div>
                            <div class="form-group">
                                <label for="occupation">Occupation</label>
                                <input type="text" name="occupation" class="form-control" id="occupation" placeholder="Enter Occupation" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" required>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Voters</button>
                </div>
            </form>
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
    <script src="ajax/add_voters.js"></script>
</body>

</html>
