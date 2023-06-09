<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>An'tse-cool</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="templates/assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="templates/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="templates/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="templates/assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="templates/assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-4 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="templates/assets/images/Untitled.svg" alt="logo">
              </div>
              <h4>Hello!</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form method="post" action="index.php?action=auth">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>  
                <div class="form-check ml-1">
                  <label class="form-check-label text-muted mt-5">
                      <input type="checkbox" class="form-check-input" name="student">
                      I'm a student
                  </label>
                </div>
                <div class="mt-4">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Connect as <a href="index.php?action=admin" class="text-primary">Admin</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="templates/assets/vendors/js/vendor.bundle.base.js"></script>
  <!--  endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="templates/assets/js/off-canvas.js"></script>
  <script src="templates/assets/js/hoverable-collapse.js"></script>
  <script src="templates/assets/js/template.js"></script>
  <script src="templates/assets/js/settings.js"></script>
  <script src="templates/assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
