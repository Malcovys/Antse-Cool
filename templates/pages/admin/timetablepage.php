<?php ob_start(); ?>
<div class="container-scroller">
  <!-- partial:partials/_navbar.php -->
  <?php require_once('templates/pages/partials/_navbar.php'); ?>
  <!-- partial:partials/_settings-panel.php -->
  <div class="container-fluid page-body-wrapper">
    <?php require_once('templates/pages/partials/_setting-panel.php');?>
    <!-- partial:partials/_sidebar.html -->
    <?php require_once('templates/pages/admin/partials/_sidebar.php'); ?>
      <div class="main-panel">
        <!-- partial:partials/_dashboard.php -->
        <?php include_once('templates/pages/partials/_timetable.php'); ?>
        <!-- partial:partials/_footer.php -->
        <?php include_once('templates/pages/partials/_footer.php'); ?> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
  </div>   
  <!-- page-body-wrapper ends -->
</div>
<?php  $content = ob_get_clean(); ?>
<?php require('templates/pages/layout.php');