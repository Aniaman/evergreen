<?php include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php
$this->load->library('session');
$Agid = $this->session->agent_id;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

<body>
  <nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo site_url('Agent/dashboard'); ?>" class="nav-link btn btn-success">Dashboard</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <?php if ($error = $this->session->flashdata('add')) { ?>
                <div class="row">
                  <div class="alert alert-success">
                    <?php echo $error; ?>
                  </div>
                </div>
              <?php } ?>
              <?php if ($error = $this->session->flashdata('error')) { ?>
                <div class="row">
                  <div class="alert alert-success">
                    <?php echo $error; ?>
                  </div>
                </div>
              <?php } ?>
              <h3 class="card-title">Product Details</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 300px;">
                  <input type="text" name="table_search" id="myInput" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive ">
              <table class="table table-bordered">
                <!-- <table class="table table-head-fixed text-nowrap"> -->
                <thead class="text-center">
                  <tr>
                    <th></th>
                    <th>Sl No</th>
                    <th>Category</th>
                    <th>Material Name</th>
                    <th>Maker/Supplier</th>
                    <th>Specification</th>
                    <th>UOM</th>
                    <th>Quantity</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                  <tr>
                    <?php
                    $s = 1;
                    echo form_open('Agent/editAddProduct');
                    foreach ($details as $value) {
                      $id = $value['id']; ?>
                  <tr>
                    <?php $data = array(
                        'name'          => 'pid[]',
                        'value'         => $id
                      ); ?>
                    <td><?php echo form_checkbox($data); ?></td>
                    <td><?php echo $s; ?></td>
                    <td><?php echo $value['category'] != "" ? $value['category'] : ""; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['supplier']; ?></td>
                    <td><?php echo $value['spec']; ?></td>
                    <td><?php echo $value['uom']; ?></td>
                    <td><?php echo $value['qty']; ?></td>
                    <td><?php echo $value['price']; ?></td>

                  </tr>
                <?php $s++;
                    }


                ?>
                </tr>

                </tbody>
              </table>
              <div class="col-md-2 float-right" style="padding-top: 5px;">
                <?php
                echo form_submit(['name' => 'update', 'value' => 'Add', 'class' => 'btn btn-success form-control ']);
                echo form_close();
                ?>
              </div>
            </div>
            <!-- /.card-body -->
          </div>


        </div>


      </div>
  </section>
</body>

</html>