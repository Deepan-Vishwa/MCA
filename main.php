<?php include 'config.php';
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION["clientid"])) {
    header('Location: index.html');
    exit();
}

date_default_timezone_set('Asia/Kolkata');

$today_date =  date('Y-m-d');

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="main.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-fire-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FCMS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="main.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link " href="profile.php">
                    <i class="fas fa-user-circle"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dietchart.php">
                    <i class="fas fa-utensils"></i>
                    <span>Diet Chart</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="workoutchart.php">
                    <i class="fas fa-dumbbell"></i>
                    <span>Workout Chart</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="checkins.php">
                    <i class="fas fa-calendar-check"></i>
                    <span>Check In's</span>
                </a>
            </li>
            <li class="nav-item">

                <a class="nav-link" href="payment.php">
                <i class="fa-solid fa-cart-shopping"></i>
                    <span>payment</span>
                </a>

            </li>

            <!-- Nav Item - Utilities Collapse Menu -->










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
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>




                        <!-- Nav Item - User Information -->


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>

                    <?php



                    $query = "SELECT 
                    (SELECT weight FROM checkin WHERE client_id = " . $_SESSION["clientid"] . " ORDER BY id  LIMIT 1) as initial,
                    (SELECT weight FROM checkin WHERE client_id = " . $_SESSION["clientid"] . " ORDER BY id DESC LIMIT 1) as curr,
                    (SELECT goal FROM client WHERE id = " . $_SESSION["clientid"] . " ) as goal,
                    FORMAT(
                        (SELECT weight FROM checkin WHERE client_id = " . $_SESSION["clientid"] . " ORDER BY id LIMIT 1)
                        -
                        (SELECT weight FROM checkin WHERE client_id = " . $_SESSION["clientid"] . " ORDER BY id DESC LIMIT 1)
                        ,2) AS lost,
                        
                    (SELECT muscle FROM checkin WHERE client_id = " . $_SESSION["clientid"] . " ORDER BY id  DESC LIMIT  1) as muscle,
                    (SELECT fat FROM checkin WHERE client_id = " . $_SESSION["clientid"] . " ORDER BY id DESC LIMIT  1) as fat,
                    (SELECT DATEDIFF(paymet_info.due,'" . $today_date . "') FROM `checkin` INNER JOIN paymet_info on paymet_info.client_id = checkin.client_id  WHERE checkin.client_id = " . $_SESSION["clientid"] . " ORDER BY paymet_info.id DESC LIMIT 1) as days
                    
                    
                        ";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);

                    $cleint_qu = "SELECT gender,activity_level,dob from client where id = " . $_SESSION["clientid"] . "";
                    $result_2 = mysqli_query($conn, $cleint_qu);
                    $row_2 = mysqli_fetch_assoc($result_2);



                    ?>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Subscription</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row['days'] ?> days left</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Initial Weight</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row['initial'] ?> kg</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Current Weight</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row['curr'] ?> kg</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php
                                            $diff = 0;
                                            $cap = "Weight Gained";
                                            if ($row['goal'] == 'Fat Loss') {
                                                $cap = "Lost Weight";
                                                $diff = $row['initial'] - $row['curr'];
                                            } else {

                                                $diff =  $row['curr'] - $row['initial'];
                                            }

                                            ?>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <?php echo $cap ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $diff ?> kg</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->


                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Fat %
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row['fat'] ?> %</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Muscle
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row['muscle'] ?> Kg</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Analytics</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Check In</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class=" pt-4 pb-2">
                                        <form id="checkinform">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Height cm</label>
                                                    <input type="number" id="height" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Weight kg</label>
                                                    <input type="number" id="weight" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Waist cm</label>
                                                    <input type="number" id="waist" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Hip cm</label>
                                                    <input type="number" id="hip" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Neck cm</label>
                                                    <input type="number" id="neck" class="form-control">
                                                </div>
                                            </div>

                                            <input type="text" id="gender" value="<?php echo $row_2['gender'] ?>" class="form-control" hidden>
                                            <input type="text" id="activity" value="<?php echo $row_2['activity_level'] ?>" class="form-control" hidden>
                                            <input type="text" id="dob" value="<?php echo $row_2['dob'] ?>" class="form-control" hidden>

                                            <div class="form-row">

                                                <div class="form-group col-md-12">
                                                    <label for="inputState">Cheat Meal</label>
                                                    <select id="inputState" class="form-control">
                                                        <option selected>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <button type="button" id="checkin_submit" class="btn btn-primary">Submit</button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">


                        <div class="col-lg-8 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">What are the necessary measurements?</h6>
                                </div>
                                <div class="card-body">
                                    <p>You'll only need a measuring tape. Then, start taking measurements:</p>
                                    <ol>
                                        <li><strong>Height</strong> - make sure you stand up straight and barefoot.</li>
                                        <li><strong>Neck</strong> - the circumference should be measured just underneath the larynx (Adam's apple).</li>
                                        <li><strong>Waist</strong> - should be measured horizontally, around the narrowest part of the abdomen for women and at the at the navel level for men.</li>
                                        <li><strong>Hips</strong> - should be measured at the widest part of the buttocks or hip.</li>
                                    </ol>

                                </div>
                            </div>

                            <!-- Approach -->


                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-4 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">How to measure Waist Circumference</h6>
                                </div>
                                <div class="card-body">

                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/b-BXpE0itSY">
                                    </iframe>


                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Neck Circumference</h6>
                                </div>
                                <div class="card-body">
                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/c62-UsM7GhQ">
                                    </iframe>

                                </div>
                            </div>

                            <!-- Approach -->


                        </div>

                        <div class="col-lg-4 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">How to Find Your Waist to Hip Ratio</h6>
                                </div>
                                <div class="card-body">

                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/jyL8UfGZMJE">
                                    </iframe>
                                </div>
                            </div>

                            <!-- Approach -->


                        </div>


                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>


    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>




    <!-- Page level custom scripts -->
    <script src="./js/chart-area-demo.js"></script>

    <script src="./js/main.js"></script>
    <!-- <script src="js/demo/chart-pie-demo.js"></script> -->

</body>

</html>