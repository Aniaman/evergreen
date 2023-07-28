<?php include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php include 'navigation.php'; ?>
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
<div class="content-wrapper">
  <!-- Main content -->
  <div class="card">
    <div class="card-header">
      <strong>
        <h3 class="card-title">Agent List</h3>
      </strong>
      <form class="form-inline" style="padding-left: 70%;">
        <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
      </form>
    </div>
    <?php if ($error = $this->session->flashdata('delete')) { ?>
      <div class="row">
        <div class="alert alert-success">
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
            <td><?php echo $value['AgentId'] != "" ? $value['AgentId'] : ""; ?></td>
            <td><?php echo $value['name'] != "" ? $value['name'] : ""; ?></td>
            <td><?php echo $value['phone'] != "" ? $value['phone'] : ""; ?></td>
            <td><?php echo $value['address'] != "" ? $value['address'] : ""; ?></td>
            <td><?php echo $value['email'] != "" ? $value['email'] : ""; ?></td>
            <td><?php echo $value['password'] != "" ? $value['password'] : ""; ?></td>
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