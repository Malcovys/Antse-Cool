<?php ob_start(); ?>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require('templates/pages/partials/_navbar.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php require('templates/pages/partials/_setting-panel.php');?>
      <!-- partial -->
      <!-- partial:partials/_sidebar.php -->
      <?php require('templates/pages/teacher/partials/_sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <?php $title = "Professors list";
              $contexte = "prof";
              require('templates/pages/partials/_list.php');
        ?>             
        <?php require('templates/pages/partials/_footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<?php  $content = ob_get_clean(); ?>
<?php require('templates/pages/layout.php');

