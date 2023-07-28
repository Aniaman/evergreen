<?php include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php include 'navigation.php'; ?>
<style type="text/css" media="screen">
  .abc {
    padding-left: 100px;
    padding-top: 50px;
  }
</style>
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
<!-- general form elements -->
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php if ($error = $this->session->flashdata('update')) { ?>
          <div class="row">
            <div class="alert alert-success">
              <?php echo $error; ?>
            </div>
          </div>
        <?php } ?>
        <!-- left column -->
        <div class="col-md-10 abc">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Bills Of Materials</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php echo form_open('Admin/crtProduct'); ?>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Material Name</label>
                    <?php echo form_input(['class' => 'form-control', 'name' => 'name', 'placeholder' => 'Enter Material Name']); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <select name="category" id="" class="form-control">
                      <option value="">------- Select Category ------</option>
                      <?php
                      if (!empty($category)) {
                        foreach ($category as  $value) { ?>
                          <option value="<?= $value['categoryName'] ?>"><?= $value['categoryName'] ?></option>
                      <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">MAKE/SUPPLIER</label>
                <?php echo form_input(['class' => 'form-control', 'name' => 'supplier', 'placeholder' => 'Enter Supplier Name']); ?>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Specification</label>
                <div class="input-group">
                  <?php echo form_input(['class' => 'form-control', 'name' => 'spec', 'placeholder' => 'Enter Specification']); ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>UOM</label>
                    <?php echo form_input(['class' => 'form-control', 'name' => 'uom', 'placeholder' => 'Enter UOM']); ?>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Quantity</label>
                    <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'name' => 'qty', 'placeholder' => 'Enter Quantity', 'value' => '1']); ?>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Price</label>
                    <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'price', 'placeholder' => 'Enter Material Price']); ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="row" style="padding-left: 150px;">
                <div class=" col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <?php echo form_submit(['class' => 'btn btn-block btn-primary', 'type' => 'submit', 'value' => 'Submit']); ?>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <?php echo form_reset(['class' => 'btn btn-block btn-primary ', 'type' => 'reset', 'value' => 'Reset']); ?>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<div class="content-wrapper">
  <!-- Main content -->
  <div class="card">
    <div class="card-header">
      <strong>
        <h3 class="card-title">Product List</h3>
      </strong>
      <form class="form-inline" style="padding-left: 70%;">
        <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
      </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <?php if ($error = $this->session->flashdata('delete')) { ?>
        <div class="row">
          <div class="alert alert-success">
            <?php echo $error; ?>
          </div>
        </div>
      <?php } ?>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl No</th>
            <th>Category</th>
            <th>Material Name</th>
            <th>Maker/Supplier</th>
            <th>Specification</th>
            <th>UOM</th>
            <th>Quantity</th>
            <th>Price</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            foreach ($details as $value) { ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $value['category'] != "" ? $value['category'] : ""; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['supplier']; ?></td>
            <td><?php echo $value['spec']; ?></td>
            <td><?php echo $value['uom']; ?></td>
            <td><?php echo $value['qty']; ?></td>
            <td><?php echo $value['price']; ?></td>
            <td>
              <?php
              echo form_open('Admin/getProduct');
              echo form_hidden('id', $value['id']);
              echo form_submit(['name' => 'update', 'value' => 'Edit', 'class' => 'btn btn-success']);
              echo form_close();
              ?>
            </td>
            <td>
              <?php
              echo form_open('Admin/deleteProduct');
              echo form_hidden('id', $value['id']);
              echo form_submit(['name' => 'delete', 'value' => 'Delete', 'class' => 'btn btn-danger']);
              echo form_close();
              ?>
            </td>
          </tr>
        <?php $s++;
            }


        ?>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
</div>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<?php include 'footer.php'; ?>