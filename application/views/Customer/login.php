<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>EverGreen Solar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= base_url('dist/img/evergreen-solar-2.png'); ?>">


  <!-- App css -->
  <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="account-body accountbg">

  <!-- Log In page -->
  <div class="container">
    <div class="row vh-100 d-flex justify-content-center">
      <div class="col-12 align-self-center">
        <div class="row">
          <div class="col-lg-5 mx-auto">
            <div class="card">
              <div class="card-body p-0" style="background-color: #28a745;">
                <div class="text-center p-3">
                  <a href="index.html" class="logo logo-admin">
                    <img src=" <?= base_url('dist/img/evergreen-solar-2.png'); ?>" height="50" alt="logo" class="auth-logo">
                  </a>
                  <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Let's Get Started EverGreen Solar</h4>
                </div>
              </div>
              <div class="card-body p-0">
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">

                    <form class="form-horizontal auth-form" method="post" action="<?= base_url('login') ?>">

                      <div class="form-group mb-2">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                        </div>
                      </div><!--end form-group-->

                      <div class="form-group mb-2">
                        <label class="form-label" for="userpassword">Password</label>
                        <div class="input-group">
                          <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                        </div>
                      </div><!--end form-group-->

                      <div class="form-group mb-0 row">
                        <div class="col-12">
                          <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                        </div><!--end col-->
                      </div> <!--end form-group-->
                    </form><!--end form-->
                  </div>
                </div>
              </div><!--end card-body-->
              <div class="card-body bg-light-alt text-center">
                <span class="text-muted d-none d-sm-inline-block">EverGreen Solar © <script>
                    document.write(new Date().getFullYear())
                  </script></span>
              </div>
            </div><!--end card-->
          </div><!--end col-->
        </div><!--end row-->
      </div><!--end col-->
    </div><!--end row-->
  </div><!--end container-->
  <!-- End Log In page -->




  <!-- jQuery  -->
  <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/waves.js"></script>
  <script src="<?= base_url(); ?>assets/js/feather.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/simplebar.min.js"></script>


</body>

</html>