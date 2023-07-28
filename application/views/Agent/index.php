<?php include 'header.php';

?>

<?php include 'navigation.php'; ?>
<title>EverGreen Solar</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style type="text/css" media="screen">
  .x {
    margin-top: 20px;
    margin-left: 15%;
  }

  .y {
    margin-top: 20px;
  }
</style>

<body>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('Dashboard'); ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $no = count($remind); ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <?php foreach ($remind as $key) {
          ?>
            <a href="<?php echo site_url("Agent/notification/{$key['id']}"); ?>" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?php echo $key['cname']; ?>
                    <span class="float-right text-sm text-muted"></i></span>
                  </h3>
                  <p class="text-sm"><?php echo $key['quoid']; ?></p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Quotation Was send before 7 days please make a call for follow up</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
          <?php } ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo site_url("Agent/notifi/$id"); ?>" class="dropdown-item dropdown-footer">See All Notification</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


  <div class="content-wrapper y">
    <!-- right column --> <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $project ?></h3>

                <p>Project</p>
              </div>
              <div class="icon">
              </div>
              <a href="<?php echo base_url("Project-Lists"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $quotation ?></h3>

                <p>Quotation</p>
              </div>
              <div class="icon">
              </div>
              <a href="<?php echo base_url("Generate-Quotation"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 style="color: #fff;"><?= $enquiry ?></h3>

                <p style="color: #fff;">Enquiry</p>
              </div>
              <div class="icon">
              </div>
              <a href="<?php echo base_url('New-Enquiry'); ?>" class="small-box-footer"><span style="color: #fff;"> More info <i class="fas fa-arrow-circle-right"></i></span></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <?php if ($error = $this->session->flashdata('update')) { ?>
      <div class="container">
        <div class="row">
          <div class="alert alert-success">
            <?php echo $error; ?>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- <div class="col-md-10"> -->
    <div class=" col-md-8 x">
      <!-- general form elements disabled -->

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Your Details</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <?php echo form_open("Agent/updateAgent/{$Agent->id}"); ?>



          <div class="row">

            <div class="col-sm-6">
              <div class="form-group">
                <label>Agent Id</label>
                <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'Agentid', 'value' => set_value('AgentId', $Agent->AgentId), 'required' => 'required', 'readonly' => 'readonly']); ?>
              </div>
            </div>
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Full Name</label>
                <?php echo form_input(['class' => 'form-control', 'name' => 'name', 'placeholder' => 'Enter Your Full Name', 'value' => set_value('name', $Agent->name), 'required' => 'required', 'readonly' => 'readonly']); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Phone Number</label>
                <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'name' => 'phone', 'placeholder' => 'Enter Your Contact Number', 'value' => set_value('phone', $Agent->phone), 'required' => 'required', 'readonly' => 'readonly']); ?>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Email Id</label>
                <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'email', 'placeholder' => 'Enter Your Email Id', 'value' => set_value('email', $Agent->email), 'required' => 'required', 'readonly' => 'readonly']); ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Address</label>
                <?php echo form_textarea(['class' => 'form-control', 'rows' => '3', 'name' => 'address', 'placeholder' => 'Enter Your Full Address', 'value' => set_value('address', $Agent->address), 'required' => 'required', 'readonly' => 'readonly']); ?>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="id_password" value="<?= $Agent->password ?>" class="form-control" />
                <i class="far fa-eye" id="togglePassword" style="float:right; margin-top: -30px; margin-right:10px; cursor: pointer;"></i>
              </div>
            </div>
          </div>



          <div class="row">
          </div>
          <div class="row" style="padding-left: 150px;">
            <div class=" col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <?php echo form_submit(['class' => 'btn btn-block btn-primary', 'type' => 'submit', 'value' => 'Update']); ?>
              </div>
            </div>
          </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  </div>
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>
  <?php include 'footer.php'; ?>