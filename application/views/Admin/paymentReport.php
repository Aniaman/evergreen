<?php
include 'header.php';
?>
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
<div class="content-wrapper mt-2">
  <!-- Main content -->
  <div class="card">

    <div class="card-header">
      <strong>
        <h3 class="card-title">Quotation List</h3>
      </strong>
      <div class="flex-container float-right">
        <div class="row">
          <form>
            <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
          </form>
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
            <th>Project Id</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Requirement</th>
            <th>Quantity</th>
            <th>Project Cost</th>
            <th>Payment Received</th>
            <th>Payment Due</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            if (sizeof($project) > 0) {
              foreach ($project as $value) { ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $value['projectId']; ?></td>
            <td><?php echo $value['customer']['cName']; ?></td>
            <td><?php echo $value['customer']['phone']; ?></td>
            <td><?php echo $value['customer']['email']; ?></td>
            <td><?php echo $value['customer']['KW'] . " " . $value['customer']['unit'] . " " . $value['customer']['Grid'] . " " . "SYSTEM" ?></td>
            <td><?php echo $value['customer']['quantity']; ?></td>
            <td><?php echo number_format($value['quotation']['NetAmount'], 2); ?></td>
            <td><?php echo number_format($value['paymentReceived']->paymentAmount, 2); ?></td>
            <td><?php echo number_format(($value['quotation']['NetAmount'] - $value['paymentReceived']->paymentAmount), 2); ?></td>
            <td><?php echo date_format(date_create($value['added_date']), 'd-m-Y'); ?></td>

          </tr>
      <?php $s++;
              }
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