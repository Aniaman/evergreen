<?php
$this->load->library('session');
$Agid = $this->session->agent_id;
?>
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
<style>
  table th,
  td {
    white-space: nowrap;
  }
</style>
<div class="content-wrapper">
  <!-- Main content -->
  <div class="card">
    <div class="card-header">
      <strong>
        <h3 class="card-title">Enquiry List</h3>
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
        <thead class="text-center">
          <tr>
            <th>SL No</th>
            <th>Enquiry Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Billing Address</th>
            <th>Shipping Address</th>
            <th>Quantity</th>
            <th>Grid</th>
            <th>KW</th>
            <th>Unit</th>
            <th>Remark</th>
            <th>Created Date</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            foreach ($details as $value) { ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $value['EnqId']; ?></td>
            <td><?php echo $value['cName']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['billAddress1'] . "," . $value['billAddress2'] . "," . $value['billstate'] . "," . $value['billPin']; ?></td>
            <td><?php echo $value['shipAddress1'] . "," . $value['shipAddress2'] . "," . $value['shipState'] . "," . $value['shipPin']; ?></td>
            <td><?php echo $value['quantity']; ?></td>
            <td><?php echo $value['Grid']; ?></td>
            <td><?php echo $value['KW']; ?></td>
            <td><?php echo $value['unit']; ?></td>
            <td><?php echo $value['remark']; ?></td>
            <td><?php echo $value['created_at'] != "" ? date_format(date_create($value['created_at']), 'd-m-Y')  : ""; ?></td>
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