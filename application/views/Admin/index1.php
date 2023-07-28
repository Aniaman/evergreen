<?php
include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php include 'navigation.php';
$this->load->library('session');
$fname = $this->session->admin_data['FirstName'];
$id = $this->session->admin_data['id'];
$lname = $this->session->admin_data['LastName'];
$email = $this->session->admin_data['Email'];
$pass = $this->session->admin_data['Password']; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo count($articles); ?></h3>

              <p>Agent</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('Admin/AgentList'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53</h3>

              <p>Quotation</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo count($enq); ?></h3>

              <p>Enquiry</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url('Admin/customer'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $quotation; ?></h3>

              <p>Quotation Not Created</p>
            </div>
            <a href="<?php echo base_url('Quotation-Not-Generate'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><i class="fas fa-rupee-sign"></i>
                <?php echo $payment->paymentAmount; ?></h3>

              <p>Payment Received</p>
            </div>
            <a href="<?php echo base_url('Payment-Report'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <style type="">.x{padding-left: 250px;}</style>
  <!-- <div class="col-md-10"> -->
  <div class=" col-md-8 x">
    <!-- general form elements disabled -->

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Agent Details</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?php echo form_open("Admin/updateAdmin/$id"); ?>



        <div class="row">

          <div class="col-sm-6">
            <div class="form-group">
              <label>First Name</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'FirstName', 'value' => set_value('FirstName', $fname), 'required' => 'required', 'readonly' => 'readonly']); ?>
            </div>
          </div>
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label>Last Name</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'LastName', 'placeholder' => 'Enter Your Lastname Name', 'value' => set_value('LastName', $lname), 'required' => 'required', 'readonly' => 'readonly']); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Email Id</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'Email', 'placeholder' => 'Enter Your Email Id', 'value' => set_value('Email', $email), 'required' => 'required', 'readonly' => 'readonly']); ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" id="id_password" value="<?= $pass ?>" class="form-control" />
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
              <?php echo form_hidden(['name' => 'id', 'value' => '$id']); ?>
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