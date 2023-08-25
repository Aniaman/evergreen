<?php
$this->load->library('session');
$Agid = $this->session->agent_id;
?>
<?php include 'header.php';
include 'topHeader.php';
include 'navigation.php'; ?>
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
        <h2 class="card-title">Generate Quotation</h2>
      </strong>
      <form class="form-inline float-right">
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
      <table id="example2" class="table table-bordered table-hover">
        <thead class="text-center">
          <tr>
            <th>SL No</th>
            <th>Name</th>
            <th>Enquiry Id</th>
            <th>Phone</th>
            <th>Billing Address</th>
            <th>Shipping Address</th>
            <th>Quantity</th>
            <th>Grid</th>
            <th>KW</th>
            <th>Unit</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php
          $s = 1;
          if (isset($details)) {
            foreach ($details as $value) { ?>
              <tr>
                <td><?php echo $s; ?></td>
                <td><?php echo $value['cName'] != "" ? $value['cName'] : ""; ?></td>
                <td><?php echo $value['EnqId'] != "" ? $value['EnqId'] : ""; ?></td>
                <td><?php echo $value['phone'] != "" ? $value['phone'] : ""; ?></td>
                <td><?php echo $value['billAddress1']  . "," . $value['billAddress2']  . "," . $value['billstate']  . "," . $value['billPin']; ?></td>
                <td><?php echo $value['shipAddress1']  . "," . $value['shipAddress2']  . "," . $value['shipState']  . "," . $value['shipPin']; ?></td>
                <td><?php echo $value['quantity'] != "" ? $value['quantity'] : ""; ?></td>
                <td><?php echo $value['Grid'] != "" ? $value['Grid'] : ""; ?></td>
                <td><?php echo $value['KW'] != "" ? $value['KW'] : ""; ?></td>
                <td><?php echo $value['unit'] != "" ? $value['unit'] : ""; ?></td>
                <td style=" white-space: nowrap;"><a href="<?= base_url("Quotation-Process/{$value['EnqId']}") ?>" class="btn btn-success">Make Quotation</a>
                </td>
              </tr>
          <?php $s++;
            }
          }

          ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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