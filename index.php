<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPK - MOORA - LOGIN</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="src/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="src/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="src/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="src/assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="src/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="src/assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <h1>SPK-MOORA</h1>
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" action="act.php" method="POST">
                                <input type="hidden" name="action" value="login">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Masukkan Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Masukkan Password">
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="src/index.html">SIGN IN</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.php" class="text-primary">Create</a>
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
    <script src="src/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="src/assets/js/off-canvas.js"></script>
    <script src="src/assets/js/misc.js"></script>
    <script src="src/assets/js/settings.js"></script>
    <script src="src/assets/js/todolist.js"></script>
    <script src="src/assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
</body>

</html>