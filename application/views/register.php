<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="<?= base_url('dist/img/evergreen-solar-2.png'); ?>">
  <title>EverGreen Solar - Login</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<style type="text/css" media="screen">
  body {
    background: url("<?php echo base_url('dist/img/back.jpg'); ?>");
  }

  .down {
    padding-top: 80px;

  }

  .form-signin {
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
  }

  .form-signin .form-signin-heading,
  .form-signin .checkbox {
    margin-bottom: 10px;
  }

  .form-signin .checkbox {
    font-weight: normal;
  }

  .form-signin .form-control {
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }

  .form-signin .form-control:focus {
    z-index: 2;
  }

  .form-signin input[type="text"] {
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }

  .account-wall {
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  }

  .login-title {
    color: 000;
    font-size: 18px;
    font-weight: 800;
    display: block;
  }

  .profile-img {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
  }

  .need-help {
    margin-top: 10px;
  }
</style>

<body>
  <div class="container down">
    <div class="row">
      <div class="col-sm-4 col-md-6 col-md-offset-3">
        <h1 class="text-center login-title">Sign-up with EverGreen Solar</h1>
        <div class="account-wall">
          <img class="profile-img" src="<?php echo base_url('dist/img/evergreen-solar-2.png'); ?>" alt="evergreen-solar">
          <?php if ($error = $this->session->flashdata('Loginfailed')) { ?>
            <div class="col-md-6 col-md-offset-3">
              <div class="alert alert-danger">
                <?php echo $error; ?>
              </div>
            </div>
          <?php } ?>
          <div class="form-signin">
            <?php echo form_open('Register-Action'); ?>
            <div class="form-group">
              <?php echo form_input(['class' => 'form-control', 'name' => 'fullname', 'placeholder' => 'Enter full Name', 'required' => 'required']); ?>
            </div>
            <div class="form-group">
              <?php echo form_input(['class' => 'form-control', 'name' => 'phone', 'placeholder' => 'Enter Phone Number', 'required' => 'required']); ?>
            </div>


            <div class="form-group">
              <?php echo form_input(['class' => 'form-control', 'name' => 'email', 'placeholder' => 'Enter email', 'required' => 'required']); ?>
            </div>
            <?php echo form_error('username', "<div class='text-danger'>", "</div>"); ?>


            <div class="form-group">
              <?php echo form_password(['class' => 'form-control', 'name' => 'password', 'placeholder' => 'Password', 'required' => 'required']); ?>
            </div>
            <?php echo form_error('password', "<div class='text-danger'>", "</div>"); ?>
            <div class="form-group">
              <?php echo form_input(['class' => 'form-control', 'name' => 'address', 'placeholder' => 'Enter Address', 'required' => 'required']); ?>
            </div>

            <div class="form-group">
              <input type="hidden" name="role" value="Sales Coordinator">
            </div>
            <?php echo form_submit(['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'value' => 'Sign up']); ?>
            </form>
            <div class="mt-5 ml-4">
              <h4>Already have an account ! <a href="<?= base_url('Login'); ?>">Sign-in</a></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>