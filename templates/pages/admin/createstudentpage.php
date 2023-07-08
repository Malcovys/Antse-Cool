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
      <?php require('templates/pages/admin/partials/_sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <?php 
        $contexte = 'student';
        require('templates/pages/admin/partials/_create.php');
        ?>        
        <?php require('templates/pages/partials/_footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
</div>
<?php $content = ob_get_clean();?>
<?php require('templates/pages/layout.php');?>