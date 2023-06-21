<!DOCTYPE html>
<html lang="en">

<head>
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
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left py-3 px-2 px-sm-5">
              <div class="brand-logo mt-3">
                <img src="templates/assets/images/Untitled.svg" alt="logo">
              </div>
              <h4>Hello!</h4>
              <h6 class="font-weight-light">New here ? Sing up to continue.</h6>
              <form class="pt-0" action="index.php?action=singup" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="First name" name="first_name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="Last name" name="last_name">
                </div> 
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="Matricule" name="id">
                </div> 
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" placeholder="E-mail" name="email">
                </div>
                <div class="form-group">
                  <select class="form-control form-control-lg" name="group">
                    <option>L1G1</option>
                    <option>L1G2</option>
                    <option>RSI L2</option>
                    <option>RSI L3</option>
                    <option>IDEV L2</option>
                    <option>IDEV L3</option>
                    <option>I am a professor</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="Promotion(year)" name="promotion">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN UP</button>
                </div>
                <div class="text-center mt-2 font-weight-light">
                  Already have an account? <a href="index.php" class="text-primary">Login</a>
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
  <!-- endinject -->
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
