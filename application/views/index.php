<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EverGreen Solar</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

  <link rel="shortcut icon" type="image/png" href="<?= base_url('dist/img/evergreen-solar-2.png'); ?>">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3X0Y1L0RN9"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'G-3X0Y1L0RN9');
</script>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-md navbar-dark bg-success">
    <div class="container">
      <a class="navbar-brand text-white" href="<?= $this->uri->segment(1); ?>"><img src="<?= base_url() ?>dist/img/evergreen-solar-2.png" alt="" height="50px"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"> <a class="nav-link text-white" href="<?php echo base_url("Customer"); ?>">Customer Login</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="<?php echo base_url("Login"); ?>">Employee Login</a></li>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo base_url("Register"); ?>">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <style type="text/css" media="screen">
    .x {
      margin-top: 20px;
    }

    body {
      background: url("<?php base_url('dist/img/back.jpg'); ?> ");
    }
  </style>
  <!-- right column -->
  <!-- <div class="col-md-10"> -->
  <div class=" col-md-8 x mx-auto">
    <!-- general form elements disabled -->
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Request For a Quote</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?php if ($error = $this->session->flashdata('success')) { ?>
          <div class="col-md-12 col-md-offset-3">
            <div class="alert alert-success">
              <?php echo $error; ?>
            </div>
          </div>
        <?php } ?>
        <?php if ($error = $this->session->flashdata('failed')) { ?>
          <div class="col-md-12 col-md-offset-3">
            <div class="alert alert-success">
              <?php echo $error; ?>
            </div>
          </div>
        <?php } ?>
        <?php echo form_open("Enquiry"); ?>
        <div class="row">
          <div class="col-sm-4">
            <!-- text input -->
            <div class="form-group">
              <label>Full Name</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'cname', 'placeholder' => 'Enter Your Full Name', 'required' => 'required']); ?>
            </div>
            <?php echo form_error('cname', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Phone Number</label>
              <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'name' => 'phone', 'placeholder' => 'Enter Your Contact Number', 'required' => 'required']); ?>
            </div>
            <?php echo form_error('phone', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Email</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'email', 'placeholder' => 'Enter Your Email Id', 'required' => 'required']); ?>
            </div>
            <?php echo form_error('email', "<div class='text-danger'>", "</div>"); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <!-- textarea -->
            <div class="form-group">
              <strong><label>Billing Address</label></strong>
              <div class="form-group">
                <label>Location 1</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'Blocation', 'name' => 'location', 'placeholder' => 'Enter Your Location', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('location', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>Location 2</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'Blocation2', 'name' => 'location1', 'placeholder' => 'Enter Your Location']); ?>
              </div>
              <?php echo form_error('location1', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>State</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'Bstate', 'name' => 'state', 'placeholder' => 'Enter Your State', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('state', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>Pin</label>
                <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'id' => 'Bpin', 'name' => 'pin', 'placeholder' => 'Enter Your Pin Code', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('pin', "<div class='text-danger'>", "</div>"); ?>
            </div>
          </div>
          <div class="col-sm-6">
            <?php echo form_input(['type' => 'checkbox', 'id' => 'same', 'name' => 'same', 'onchange' => 'addressFunction()']); ?>
            <strong><label for="same">
                If same as Billing Address select this box.
              </label></strong>
            <!-- textarea -->
            <div class="form-group">
              <strong><label>Shipping Address</label></strong>
              <div class="form-group">
                <label>Location 1</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'slocation', 'name' => 'shiplocation', 'placeholder' => 'Enter Your Location', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('shiplocation', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>Location 2</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'slocation2', 'name' => 'shiplocation1', 'placeholder' => 'Enter Your Location']); ?>
              </div>
              <?php echo form_error('shiplocation1', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>State</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'sstate', 'name' => 'shipstate', 'placeholder' => 'Enter Your State', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('shipstate', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>Pin</label>
                <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'id' => 'spin', 'name' => 'shippin', 'placeholder' => 'Enter Your Pin Code', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('shippin', "<div class='text-danger'>", "</div>"); ?>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
              <label>GST NO</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'gst', 'placeholder' => 'Enter Your GST Number']); ?>
            </div>
            <?php echo form_error('gst', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Category</label>
              <?php
              $options = array(
                'SelectGrid'     => 'Select Grid',
                'OFF GRID'          => 'OFF GRID',
                'ON GRID'          => 'ON  GRID',
                'HYBRID'          => 'HYBRID',
                'PUMP'          => 'PUMP',
                'STREET LIGHT'          => 'STREET LIGHT',
                'SOLAR WATER HEATER'          => 'SOLAR WATER HEATER'
              );
              $css = array('class' => 'form-control', 'id' => 'grid');
              echo form_dropdown('grid', $options, 'SelectGrid', $css);

              ?>

            </div>
            <?php echo form_error('grid', "<div class='text-danger'>", "</div>"); ?>
          </div>

          <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
              <label>HP/KW/WP/NOS</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'kw', 'placeholder' => 'Enter The HP/KW/WP/NOS', 'id' => 'kw']); ?>
            </div>
          </div>
          <?php echo form_error('kw', "<div class='text-danger'>", "</div>"); ?>

          <div class="col-sm-3">
            <div class="form-group">
              <label>Unit</label>
              <?php
              $options = array(
                'Selectunit'     => 'Select Unit',
                'HP'          => 'HP',
                'KW'          => 'KW',
                'W'          => 'W',
                'NOS'         => 'NOS',
                'LPD'         => 'LPD'
              );
              $css = array('class' => 'form-control', 'id' => 'unit');
              echo form_dropdown('unit', $options, 'Selectunit', $css);

              ?>

            </div>
            <?php echo form_error('grid', "<div class='text-danger'>", "</div>"); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label>Quantity</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'qty', 'value' => '1']); ?>
            </div>
            <?php echo form_error('qty', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Remark</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'remark', 'placeholder' => 'Enter Extra Information']); ?>

            </div>
            <?php echo form_error('grid', "<div class='text-danger'>", "</div>"); ?>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4">
            <!-- text input -->
            <div class="form-group">
              <?php echo form_submit(['class' => 'btn btn-block btn-primary', 'type' => 'submit', 'value' => 'Send']); ?>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">

              <?php echo form_reset(['class' => 'btn btn-block btn-primary ', 'type' => 'reset', 'value' => 'Reset']); ?>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <a href="#" name="modal" class="btn btn-block btn-primary view_data">Get Approx Price</a>
              <!-- <input type="submit" name="" class="btn btn-block btn-primary view_data" data-toggle="modal" data-target="#exampleModal"value="Get Approx Price" > -->
              <?php echo form_close(); ?>
            </div>
          </div>


        </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>

    <div id="exampleModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approximate Price</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="employee_detail">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <hr>
    <footer>
      <strong>Copyright &copy; 2020 <a href="http://evergreensolar.co.in">EverGreen Solar</a>.</strong>
      All rights reserved.
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
      function addressFunction() {
        if (document.getElementById(
            "same").checked) {
          document.getElementById(
              "slocation").value =
            document.getElementById(
              "Blocation").value;

          document.getElementById(
              "slocation2").value =
            document.getElementById(
              "Blocation2").value;

          document.getElementById(
              "sstate").value =
            document.getElementById(
              "Bstate").value;

          document.getElementById(
              "spin").value =
            document.getElementById(
              "Bpin").value;
        } else {
          document.getElementById(
            "slocation").value = "";
          document.getElementById(
            "slocation2").value = "";
          document.getElementById(
            "sstate").value = "";
        }
      }
      $(document).ready(function() {
        $("#grid").change(function() {
          var grid = this.value;

          if (grid == 'OFF GRID' || grid == 'ON GRID' || grid == 'HYBRID') {
            $("#unit").val("KW");
          } else if (grid == 'PUMP') {
            $("#unit").val("HP");
          } else if (grid == 'STREET LIGHT') {
            $("#unit").val("WP");
          } else if (grid == 'SOLAR WATER HEATER') {
            $("#unit").val("LPD");
          }
        });

      })

      $(document).ready(function() {
        $('.view_data').click(function() {
          var kw = document.getElementById("kw").value;
          var grid = document.getElementById("grid").value;
          $.ajax({

            url: '<?php echo site_url("/login/approx"); ?>',
            method: 'post',
            data: {
              kw: kw,
              grid: grid
            },
            dataType: 'json',
            success: function(data) {
              $('#employee_detail').html(data);
              $('#exampleModal').modal("show");


            }
          });
        });
      });
    </script>
</body>

</html>