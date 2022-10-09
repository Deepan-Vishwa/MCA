<?php include 'config.php';
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION["clientid"])) {
    header('Location: index.html');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Workout Chart</title>

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
      <li class="nav-item ">
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
            <li class="nav-item active">
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





            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-right-from-bracket"></i>
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
            <h1 class="h3 mb-0 text-gray-800">Workout Chart</h1>

          </div>

          <!-- Content Row -->
          <div class="row">

            <?php


            $workout_query = "SELECT * from workout_chart WHERE client_id=" . $_SESSION["clientid"];
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
                      </thead>
                      <tbody>
                        <?php

                        while ($workout = mysqli_fetch_assoc($workout_result)) {
                          if ($workout["day"] == '1') {

                        ?>

                            <tr>

                              <td><?php echo  $workout["workout"]; ?></td>
                              <td><?php echo  $workout["sets"]; ?></td>
                              <td><?php echo  $workout["rep"]; ?></td>


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
                      </thead>
                      <tbody>
                        <?php
                        mysqli_data_seek($workout_result, 0);
                        while ($workout = mysqli_fetch_assoc($workout_result)) {
                          if ($workout["day"] == '2') {

                        ?>

                            <tr>

                              <td><?php echo  $workout["workout"]; ?></td>
                              <td><?php echo  $workout["sets"]; ?></td>
                              <td><?php echo  $workout["rep"]; ?></td>


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
                      </thead>
                      <tbody>
                      <?php
                        mysqli_data_seek($workout_result, 0);
                        while ($workout = mysqli_fetch_assoc($workout_result)) {
                          if ($workout["day"] == '3') {

                        ?>

                            <tr>

                              <td><?php echo  $workout["workout"]; ?></td>
                              <td><?php echo  $workout["sets"]; ?></td>
                              <td><?php echo  $workout["rep"]; ?></td>


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
                      </thead>
                      <tbody>
                      <?php
                        mysqli_data_seek($workout_result, 0);
                        while ($workout = mysqli_fetch_assoc($workout_result)) {
                          if ($workout["day"] == '4') {

                        ?>

                            <tr>

                              <td><?php echo  $workout["workout"]; ?></td>
                              <td><?php echo  $workout["sets"]; ?></td>
                              <td><?php echo  $workout["rep"]; ?></td>


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
                      </thead>
                      <tbody>
                      <?php
                        mysqli_data_seek($workout_result, 0);
                        while ($workout = mysqli_fetch_assoc($workout_result)) {
                          if ($workout["day"] == '5') {

                        ?>

                            <tr>

                              <td><?php echo  $workout["workout"]; ?></td>
                              <td><?php echo  $workout["sets"]; ?></td>
                              <td><?php echo  $workout["rep"]; ?></td>


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
                      </thead>
                      <tbody>
                      <?php
                        mysqli_data_seek($workout_result, 0);
                        while ($workout = mysqli_fetch_assoc($workout_result)) {
                          if ($workout["day"] == '6') {

                        ?>

                            <tr>

                              <td><?php echo  $workout["workout"]; ?></td>
                              <td><?php echo  $workout["sets"]; ?></td>
                              <td><?php echo  $workout["rep"]; ?></td>


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
                      </thead>
                      <tbody>
                      <?php
                        mysqli_data_seek($workout_result, 0);
                        while ($workout = mysqli_fetch_assoc($workout_result)) {
                          if ($workout["day"] == '7') {

                        ?>

                            <tr>

                              <td><?php echo  $workout["workout"]; ?></td>
                              <td><?php echo  $workout["sets"]; ?></td>
                              <td><?php echo  $workout["rep"]; ?></td>


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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
          </div>
        </div>
      </footer>
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
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  <!-- Core plugin JavaScript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>




  <!-- Page level custom scripts -->
  <script src="./js/chart-area-demo.js"></script>
  <!-- <script src="js/demo/chart-pie-demo.js"></script> -->

</body>

</html>