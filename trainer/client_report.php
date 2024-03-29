<?php include 'config.php';
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION["trainerid"])) {
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

    <title>Client Report</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

</head>

<body id="page-top">

    <input type="text" value="<?php echo $_GET['client']; ?>" id="client_id" hidden>

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
            <li class="nav-item">
                <a class="nav-link " href="profile.php">
                    <i class="fa-solid fa-address-card"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="invite.php">
                <i class="fa-solid fa-envelope"></i>
                    <span>Invite Client</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="view_clients.php">
                <i class="fa-solid fa-flag"></i>
                    <span>View Clients</span>
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





                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
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

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Client Report</h1>

                    </div>

                    <?php



                    $query = "SELECT 
                    (SELECT weight FROM checkin WHERE client_id = " . $_GET['client'] . " ORDER BY id  LIMIT 1) as initial,
                    (SELECT weight FROM checkin WHERE client_id = " . $_GET['client'] . " ORDER BY id DESC LIMIT 1) as curr,
                    (SELECT goal FROM client WHERE id = " .  $_GET['client'] . " ) as goal,

                    FORMAT(
                        (SELECT weight FROM checkin WHERE client_id = " . $_GET['client'] . " ORDER BY id LIMIT 1)
                        -
                        (SELECT weight FROM checkin WHERE client_id = " . $_GET['client'] . " ORDER BY id DESC LIMIT 1)
                        ,2) AS lost,
                        
                    (SELECT muscle FROM checkin WHERE client_id = " . $_GET['client'] . " ORDER BY id  DESC LIMIT  1) as muscle,
                    (SELECT fat FROM checkin WHERE client_id = " . $_GET['client'] . " ORDER BY id DESC LIMIT  1) as fat,
                    (SELECT DATEDIFF(paymet_info.due,'" . $today_date . "') FROM `checkin` INNER JOIN paymet_info on paymet_info.client_id = checkin.client_id  WHERE checkin.client_id = " . $_GET['client'] . " ORDER BY paymet_info.id DESC LIMIT 1) as days
                    
                    
                        ";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);



                    ?>

                    <input type="number" name="c_id" id="c_id" value="<?php echo $_GET['client'] ?>" hidden>

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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $d = $row['days']; 

                                            if($d <= 0){

                                                echo "Subscription Over";
                                              
                                                

                                            }
                                            else{
                                                echo $d."days left";

                                            }

                                            
                                            
                                            


                                            
                                            
                                            
                                            
                                            ?> </div>
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
                            <div class="card border-left-info shadow h-100 py-2">
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
                            <div class="card border-left-danger shadow h-100 py-2">
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
                            <div class="card border-left-primary shadow h-100 py-2">
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

                    <div class="row">

                        <?php


                        $c_query = "SELECT * FROM `client` inner join paymet_info on client.id = paymet_info.client_id  WHERE client.id = " . $_GET['client'] . " ORDER by paymet_info.id DESC LIMIT 1";
                        $c_result = mysqli_query($conn, $c_query);
                        $c_row = mysqli_fetch_assoc($c_result);
                        ?>


                        <div class="col-lg-12 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Client Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>

                                                        <th>Name</th>
                                                        <td><?php echo $c_row['name'] ?></td>

                                                    </tr>
                                                    <tr>

                                                        <th>Email</th>
                                                        <td><?php echo $c_row['email'] ?></td>

                                                    </tr>
                                                    <tr>

                                                        <th>Contact</th>
                                                        <td><?php echo $c_row['contact'] ?></td>

                                                    </tr>
                                                    <tr>


                                                        <th>DOB</th>
                                                        <td><?php echo $c_row['dob'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-3">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>

                                                        <th>Gender</th>
                                                        <td><?php echo $c_row['gender'] ?></td>

                                                    </tr>
                                                    <tr>

                                                        <th>Address</th>
                                                        <td><?php echo $c_row['Address'] ?></td>

                                                    </tr>
                                                    <tr>

                                                        <th>Drinking</th>
                                                        <td><?php echo $c_row['alcohol'] ?></td>

                                                    </tr>
                                                    <tr>


                                                        <th>Smoking</th>
                                                        <td><?php echo $c_row['smoke'] ?></td>
                                                    </tr>
                                                    <tr bgcolor="#4e73df" class="text-white">


                                                        <th>Total Diet Calories</th>
                                                        <td><?php

                                                            $tdc_s = $c_row['tdc'];
                                                            echo  $tdc_s ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-lg-3">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>

                                                        <th>Activity Level</th>
                                                        <td><?php echo $c_row['activity_level'] ?></td>

                                                    </tr>
                                                    <tr>

                                                        <th>Goal</th>
                                                        <td><?php
                                                        $goal = $c_row['goal']; echo $goal ?></td>

                                                    </tr>
                                                    <tr>


                                                        <th>Profession</th>
                                                        <td><?php echo $c_row['profession'] ?></td>
                                                    </tr>
                                                    <tr>


                                                        <th>Meal Type</th>
                                                        <td><?php echo $c_row['meal_type'] ?></td>
                                                    </tr>
                                                    <?php


                                                    $t_query = "SELECT bmr,tdee FROM checkin WHERE client_id = " . $_GET['client'] . " ORDER BY id DESC LIMIT 1";
                                                    $t_result = mysqli_query($conn, $t_query);
                                                    $t_row = mysqli_fetch_assoc($t_result);
                                                    ?>
                                                    <tr bgcolor="#4e73df" class="text-white">


                                                        <th>BMR</th>
                                                        <td><?php echo $t_row['bmr'] ?></td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-lg-3">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>


                                                        <th>Medical</th>
                                                        <td><?php echo $c_row['medical'] ?></td>
                                                    </tr>
                                                    <tr>

                                                        <th>Last Payment</th>
                                                        <td><?php echo $c_row['date'] ?></td>

                                                    </tr>
                                                    <tr>

                                                        <th>Subscription Type</th>
                                                        <td><?php echo $c_row['sub_type'] ?> months</td>

                                                    </tr>
                                                    <tr>


                                                        <th>Due Date</th>
                                                        <td><?php echo $c_row['due'] ?></td>
                                                    </tr>

                                                    <tr bgcolor="#4e73df" class="text-white">


                                                        <th>TDEE</th>
                                                        <td><?php
                                                            $tdee_s = $t_row['tdee'];
                                                            echo $tdee_s; ?></td>
                                                    </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Approach -->


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
                                    <h6 class="m-0 font-weight-bold text-primary">Status</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class=" pt-4 pb-2">
                                        <div>

                                            <?php
                                            $sugg = "Going Good";
                                            $col = "bg-success";

                                            if ($goal == 'Fat Loss' && $tdc_s > $tdee_s) {

                                                $sugg = "Need To Change Diet Chart";
                                                $col = "bg-danger";
                                            }
                                            else if($goal == 'Weight Gain' && $tdc_s < $tdee_s){
                                                $sugg = "Need To Change Diet Chart";
                                                $col = "bg-danger";


                                            }




                                            ?>
                                            <div class="card <?php echo $col; ?> text-white shadow">
                                                <div class="card-body text-center">
                                                    <?php echo $sugg; ?>

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                    <div>

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Diet Chart</h1>

                        </div>

                        <div class="row">

                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">TDC</h6>
                                    </div>
                                    <div class="card-body">

                                        <form>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Total Diet Calories</label>
                                                <input type="text" class="form-control" id="tdc">


                                            </div>

                                            <button type="button" id="tdc_button" data-clid="<?php echo $_GET['client'] ?>" class="btn btn-primary">Enter</button>
                                        </form>


                                    </div>
                                </div>
                            </div>

                        </div>


                        <?php


                        $diet_query = "SELECT * from diet_chart WHERE client_id=" . $_GET['client'];
                        $diet_result = mysqli_query($conn, $diet_query);
                        ?>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Breakfast</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Food</th>
                                                        <th scope="col">Quantity</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="food" class="form-control food"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="quantity" class="form-control quantity"></th>

                                                        <th scope="col">
                                                            <button type="button" value="1" class="btn btn-primary add_diet">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody class="first">

                                                    <?php
                                                    while ($diet = mysqli_fetch_assoc($diet_result)) {
                                                        if ($diet["meal"] == '1') {

                                                    ?>




                                                            <tr>

                                                                <td><?php echo  $diet["item"]; ?></td>
                                                                <td><?php echo  $diet["quantity"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $diet["id"]; ?>" class="btn btn-danger red">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>
                                                                    </button>
                                                                </td>


                                                            </tr>

                                                    <?php }
                                                    } ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Snack 1</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Food</th>
                                                        <th scope="col">Quantity</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="food" class="form-control food"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="quantity" class="form-control quantity"></th>
                                                        <th scope="col">
                                                            <button type="button" value="2" class="btn btn-primary add_diet">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($diet_result, 0);
                                                    while ($diet = mysqli_fetch_assoc($diet_result)) {
                                                        if ($diet["meal"] == '2') {

                                                    ?>




                                                            <tr>

                                                                <td><?php echo  $diet["item"]; ?></td>
                                                                <td><?php echo  $diet["quantity"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $diet["id"]; ?>" class="btn btn-danger red">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>

                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Lunch</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Food</th>
                                                        <th scope="col">Quantity</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="food" class="form-control food"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="quantity" class="form-control quantity"></th>
                                                        <th scope="col">
                                                            <button type="button" value="3" class="btn btn-primary add_diet">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($diet_result, 0);
                                                    while ($diet = mysqli_fetch_assoc($diet_result)) {
                                                        if ($diet["meal"] == '3') {

                                                    ?>




                                                            <tr>

                                                                <td><?php echo  $diet["item"]; ?></td>
                                                                <td><?php echo  $diet["quantity"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $diet["id"]; ?>" class="btn btn-danger red">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>

                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Sncak 2</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Food</th>
                                                        <th scope="col">Quantity</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="food" class="form-control food"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="quantity" class="form-control quantity"></th>
                                                        <th scope="col">
                                                            <button type="button" value="4" class="btn btn-primary add_diet">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($diet_result, 0);
                                                    while ($diet = mysqli_fetch_assoc($diet_result)) {
                                                        if ($diet["meal"] == '4') {

                                                    ?>




                                                            <tr>

                                                                <td><?php echo  $diet["item"]; ?></td>
                                                                <td><?php echo  $diet["quantity"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $diet["id"]; ?>" class="btn btn-danger red">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>

                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Dinner</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Food</th>
                                                        <th scope="col">Quantity</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="food" class="form-control food"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="quantity" class="form-control quantity"></th>
                                                        <th scope="col">
                                                            <button type="button" value="5" class="btn btn-primary add_diet">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($diet_result, 0);
                                                    while ($diet = mysqli_fetch_assoc($diet_result)) {
                                                        if ($diet["meal"] == '5') {

                                                    ?>




                                                            <tr>

                                                                <td><?php echo  $diet["item"]; ?></td>
                                                                <td><?php echo  $diet["quantity"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $diet["id"]; ?>" class="btn btn-danger red">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>

                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>





                    </div>

                    <!-- Begin Page Content -->
                    <div>

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Workout Chart</h1>

                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <?php


                            $workout_query = "SELECT * from workout_chart WHERE client_id=" . $_GET['client'];
                            $workout_result = mysqli_query($conn, $workout_query);
                            ?>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Monday</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Workout</th>
                                                        <th scope="col">Sets</th>
                                                        <th scope="col">Reps</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="workout" class="form-control workout"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="sets" class="form-control sets"></th>
                                                        <th scope="col"><input type="text" name="reps" class="form-control reps"></th>
                                                        <th scope="col">
                                                            <button type="button" value="1" class="btn btn-primary add_workout">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">


                                                    <?php

                                                    while ($workout = mysqli_fetch_assoc($workout_result)) {
                                                        if ($workout["day"] == '1') {

                                                    ?>

                                                            <tr>

                                                                <td><?php echo  $workout["workout"]; ?></td>
                                                                <td><?php echo  $workout["sets"]; ?></td>
                                                                <td><?php echo  $workout["rep"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $workout["id"]; ?>" class="btn btn-danger red2">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>
                                                    <?php }
                                                    } ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Tuesday</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Workout</th>
                                                        <th scope="col">Sets</th>
                                                        <th scope="col">Reps</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="workout" class="form-control workout"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="sets" class="form-control sets"></th>
                                                        <th scope="col"><input type="text" name="reps" class="form-control reps"></th>
                                                        <th scope="col">
                                                            <button type="button" value="2" class="btn btn-primary add_workout">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($workout_result, 0);
                                                    while ($workout = mysqli_fetch_assoc($workout_result)) {
                                                        if ($workout["day"] == '2') {

                                                    ?>

                                                            <tr>

                                                                <td><?php echo  $workout["workout"]; ?></td>
                                                                <td><?php echo  $workout["sets"]; ?></td>
                                                                <td><?php echo  $workout["rep"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $workout["id"]; ?>" class="btn btn-danger red2">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Wednesday</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Workout</th>
                                                        <th scope="col">Sets</th>
                                                        <th scope="col">Reps</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="workout" class="form-control workout"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="sets" class="form-control sets"></th>
                                                        <th scope="col"><input type="text" name="reps" class="form-control reps"></th>
                                                        <th scope="col">
                                                            <button type="button" value="3" class="btn btn-primary add_workout">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($workout_result, 0);
                                                    while ($workout = mysqli_fetch_assoc($workout_result)) {
                                                        if ($workout["day"] == '3') {

                                                    ?>

                                                            <tr>

                                                                <td><?php echo  $workout["workout"]; ?></td>
                                                                <td><?php echo  $workout["sets"]; ?></td>
                                                                <td><?php echo  $workout["rep"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $workout["id"]; ?>" class="btn btn-danger red2">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Thursday</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Workout</th>
                                                        <th scope="col">Sets</th>
                                                        <th scope="col">Reps</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="workout" class="form-control workout"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="sets" class="form-control sets"></th>
                                                        <th scope="col"><input type="text" name="reps" class="form-control reps"></th>
                                                        <th scope="col">
                                                            <button type="button" value="4" class="btn btn-primary add_workout">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($workout_result, 0);
                                                    while ($workout = mysqli_fetch_assoc($workout_result)) {
                                                        if ($workout["day"] == '4') {

                                                    ?>

                                                            <tr>

                                                                <td><?php echo  $workout["workout"]; ?></td>
                                                                <td><?php echo  $workout["sets"]; ?></td>
                                                                <td><?php echo  $workout["rep"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $workout["id"]; ?>" class="btn btn-danger red2">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Friday</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Workout</th>
                                                        <th scope="col">Sets</th>
                                                        <th scope="col">Reps</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="workout" class="form-control workout"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="sets" class="form-control sets"></th>
                                                        <th scope="col"><input type="text" name="reps" class="form-control reps"></th>
                                                        <th scope="col">
                                                            <button type="button" value="5" class="btn btn-primary add_workout">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($workout_result, 0);
                                                    while ($workout = mysqli_fetch_assoc($workout_result)) {
                                                        if ($workout["day"] == '5') {

                                                    ?>

                                                            <tr>

                                                                <td><?php echo  $workout["workout"]; ?></td>
                                                                <td><?php echo  $workout["sets"]; ?></td>
                                                                <td><?php echo  $workout["rep"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $workout["id"]; ?>" class="btn btn-danger red2">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Saturday</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Workout</th>
                                                        <th scope="col">Sets</th>
                                                        <th scope="col">Reps</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="workout" class="form-control workout"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="sets" class="form-control sets"></th>
                                                        <th scope="col"><input type="text" name="reps" class="form-control reps"></th>
                                                        <th scope="col">
                                                            <button type="button" value="6" class="btn btn-primary add_workout">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($workout_result, 0);
                                                    while ($workout = mysqli_fetch_assoc($workout_result)) {
                                                        if ($workout["day"] == '6') {

                                                    ?>

                                                            <tr>

                                                                <td><?php echo  $workout["workout"]; ?></td>
                                                                <td><?php echo  $workout["sets"]; ?></td>
                                                                <td><?php echo  $workout["rep"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $workout["id"]; ?>" class="btn btn-danger red2">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Sunday</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Workout</th>
                                                        <th scope="col">Sets</th>
                                                        <th scope="col">Reps</th>

                                                    </tr>
                                                    <tr>

                                                        <th scope="col"><input type="text" name="workout" class="form-control workout"></th>
                                                        </th>
                                                        <th scope="col"><input type="text" name="sets" class="form-control sets"></th>
                                                        <th scope="col"><input type="text" name="reps" class="form-control reps"></th>
                                                        <th scope="col">
                                                            <button type="button" value="7" class="btn btn-primary add_workout">
                                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                <span><i class="fa-sharp fa-solid fa-plus" style="font-size: 0.73em;"></i></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="first">
                                                    <?php
                                                    mysqli_data_seek($workout_result, 0);
                                                    while ($workout = mysqli_fetch_assoc($workout_result)) {
                                                        if ($workout["day"] == '7') {

                                                    ?>

                                                            <tr>

                                                                <td><?php echo  $workout["workout"]; ?></td>
                                                                <td><?php echo  $workout["sets"]; ?></td>
                                                                <td><?php echo  $workout["rep"]; ?></td>
                                                                <td><button type="button" name="remove" value="<?php echo  $workout["id"]; ?>" class="btn btn-danger red2">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                                                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>

                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Previous Checkin's</h1>

                        </div>

                        <?php


                        $checkin_query = "SELECT `weight`,`waist`,`hip`,`neck`,`cheat_meal`,`fat`,`muscle`,DATE_FORMAT(entry_date,'%D %b %y') as d FROM `checkin` WHERE client_id=" . $_GET['client'];
                        $checkin_result = mysqli_query($conn, $checkin_query);
                        ?>


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Checkin's</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Weight</th>
                                                <th>Waist</th>
                                                <th>Hip</th>
                                                <th>Neck</th>
                                                <th>Cheat Meal</th>
                                                <th>Fat %</th>
                                                <th>Muscle</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Weight</th>
                                                <th>Waist</th>
                                                <th>Hip</th>
                                                <th>Neck</th>
                                                <th>Cheat Meal</th>
                                                <th>Fat %</th>
                                                <th>Muscle</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($checkin_result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo  $row["d"]; ?></td>
                                                    <td><?php echo  $row["weight"]; ?></td>
                                                    <td><?php echo  $row["waist"]; ?></td>
                                                    <td><?php echo  $row["hip"]; ?></td>
                                                    <td><?php echo  $row["neck"]; ?></td>
                                                    <td><?php echo  $row["cheat_meal"]; ?></td>
                                                    <td><?php echo  $row["fat"]; ?></td>
                                                    <td><?php echo  $row["muscle"]; ?></td>
                                                </tr>


                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>





                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            <!-- End of Footer -->

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


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <!-- <script src="js/demo/chart-pie-demo.js"></script> -->
    <script src="./js/main.js"></script>
</body>

</html>