<?php include 'header.php';
include 'navigation.php';
$this->load->helper('string');
$val = random_string('numeric', 5);
$angId = "EGS" . $val;
?>
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
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create Team</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Create-Team'); ?>
        <div class="row">
          <?php

          ?>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Agent Id</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'id', 'value' => "$angId", 'required' => 'required', 'readonly' => 'readonly']); ?>
            </div>
          </div>
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label>Full Name</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'name', 'placeholder' => 'Enter Your Full Name', 'required' => 'required']); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Phone Number</label>
              <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'name' => 'phone', 'placeholder' => 'Enter Your Contact Number', 'required' => 'required']); ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Email Id</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'email', 'placeholder' => 'Enter Your Email Id', 'required' => 'required']); ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label>Address</label>
              <?php echo form_textarea(['class' => 'form-control', 'rows' => '3', 'name' => 'address', 'placeholder' => 'Enter Your Full Address', 'required' => 'required']); ?>
            </div>
          </div>


          <div class="col-sm-6">
            <div class="form-group">
              <label>Password</label>
              <?php echo form_Password(['class' => 'form-control', 'name' => 'password', 'placeholder' => 'Enter Your Password', 'required' => 'required']); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Role</label>
              <select name="role" id="" class="form-control">
                <option value="Agent">Sales Team</option>
                <option value="finance">Finance</option>
                <option value="Sales Coordinator">Sales Coordinator</option>
              </select>
            </div>
          </div>
        </div>


      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php echo form_close(); ?>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="content-wrapper mt-2">
  <!-- Main content -->
  <div class="card">

    <div class="card-header">
      <strong>
        <h3 class="card-title">Team List</h3>
      </strong>
      <div class="flex-container float-right">
        <div class="row">
          <form>
            <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
          </form>
          <button type="button" class="btn btn-info ml-3" data-toggle="modal" data-target="#modal-default">
            Create Team Member
          </button>
        </div>
      </div>
    </div>
    <?php if ($error = $this->session->flashdata('Success')) { ?>
      <div class="row">
        <div class="alert alert-success">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <?php if ($error = $this->session->flashdata('fail')) { ?>
      <div class="row">
        <div class="alert alert-success">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <?php if ($error = $this->session->flashdata('delete')) { ?>
      <div class="row">
        <div class="alert alert-danger">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <?php if ($error = $this->session->flashdata('update')) { ?>
      <div class="row">
        <div class="alert alert-success">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL No</th>
            <th>Agent Id</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
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
            <td><?php echo $value['AgentId']; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['phone']; ?></td>
            <td><?php echo $value['address']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['password']; ?></td>
            <td><?php if ($value['role'] == 'Agent') {
                  echo "Sales Team";
                } else if ($value['role'] == 'finance') {
                  echo "Finance";
                } else if ($value['role'] == 'Sales Coordinator') {
                  echo 'Sales Coordinator';
                } ?></td>
            <td>
              <?php
              echo form_open('Admin/getAgent');
              echo form_hidden('id', $value['id']);
              echo form_submit(['name' => 'update', 'value' => 'Edit', 'class' => 'btn btn-success']);
              echo form_close();
              ?>
            </td>
            <td>
              <?php
              echo form_open('Admin/deleteAgent');
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

<?php include 'footer.php'; ?>