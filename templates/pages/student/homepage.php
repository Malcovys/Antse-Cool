<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="templates/assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="templates/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="templates/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="templates/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="templates/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="templates/assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="templates/assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="templates/assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php require_once('templates/pages/student/partials/_navbar.php'); ?>
    <!-- partial:partials/_settings-panel.php -->
    <?php require_once('templates/pages/student/partials/_setting-panel.php');?>
    <!-- partial:partials/_sidebar.html -->
    <?php require_once('templates/pages/student/partials/_sidebar.php'); ?>
      <div class="main-panel">
        <!-- partial:partials/_dashboard.php -->
        <?php include_once('templates/pages/student/partials/_dashboard.php'); ?>
        <!-- partial:partials/_footer.php -->
        <?php include_once('templates/pages/student/partials/_footer.php'); ?> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="templates/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="templates/assets/vendors/chart.js/Chart.min.js"></script>
  <script src="templates/assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="templates/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="templates/assets/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="templates/assets/js/off-canvas.js"></script>
  <script src="templates/assets/js/hoverable-collapse.js"></script>
  <script src="templates/assets/js/template.js"></script>
  <script src="templates/assets/js/settings.js"></script>
  <script src="templates/assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="templates/assets/js/dashboard.js"></script>
  <script src="templates/assets/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

