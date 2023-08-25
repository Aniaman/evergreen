<?php include 'header.php';
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
<style>
  table th,
  td {
    white-space: nowrap;
  }
</style>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Payment Terms</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('PaymentTerm-Action'); ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Payment Percent (%)</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'paymentPercent', 'placeholder' => 'Add Payments percent ( % )', 'required' => 'required']); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Payment Term Sequence</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'sequence', 'placeholder' => 'Add Sequence for payments term i.e., 1,2,3', 'required' => 'required']); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Payment Term Description</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'paymentTermDescription', 'placeholder' => 'Add Statement which show with payment %', 'required' => 'required']); ?>
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
        <h3 class="card-title">Project List</h3>
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
            <th>#</th>
            <th>Project No</th>
            <th>Quotation No</th>
            <th>Status</th>
            <th>Quotation For</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Quantity</th>
            <th>Project DeadLine</th>
            <th>Project cost</th>
            <th>Amount Paid</th>
            <th>Amount Due</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php
          if (!empty($projectData)) {
            $tableClass = "";
            $rowNo = 1;
            foreach ($projectData as $value) {
              $id = str_replace("/", ":", $value['projectId']);
          ?>
              <tr>
                <th><?= $rowNo++; ?></th>
                <td><?= $value['projectId'];  ?></td>
                <td><?= $value['quotationId']  ?></td>
                <td class=""><?php if ($value['Status'] == "Process") { ?>
                    <span class="badge badge-danger"><?= $value['Status'] ?></span>
                  <?php } else { ?>
                    <span class="badge badge-success"><?= $value['Status'] ?></span>

                  <?php }  ?>
                </td>
                <td><?= $value['EnquiryData']['KW'] . " " . $value['EnquiryData']['unit'] . " " . $value['EnquiryData']['Grid'] . " System";  ?></td>
                <td><?= $value['EnquiryData']['cName']  ?></td>
                <td><?= $value['EnquiryData']['email']  ?></td>
                <td><?= $value['EnquiryData']['phone']  ?></td>
                <td><?= $value['EnquiryData']['quantity']  ?></td>
                <td> <?= $value['projectDeadLine']  ?></td>
                <td><?= number_format($value['quotationData']['NetAmount'], 2)  ?></td>
                <td> <?= $value['amountPaid']['paidAmount'] != "" ? $value['amountPaid']['paidAmount'] : 0  ?></td>
                <td><?= $value['amountPaid']['paidAmount'] != "" ? number_format($value['quotationData']['NetAmount']  - $value['amountPaid']['paidAmount'], 2) : 0  ?></td>

                <td class="d-flex justify-content-around"><a href="<?= base_url('View-Project-Details?id=') . base64_encode($id);  ?>"><i class="fas fa-eye"></i></a>
                  <a href="<?php echo site_url("Download-PDF/{$value['quoitemData']['id']}"); ?>" class="btn btn-primary"><i class="fas fa-download"></i></a>
                </td>
              </tr>
          <?php
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