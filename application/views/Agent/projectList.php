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
      <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Project No</th>
            <th scope="col">Quotation No</th>
            <th scope="col">Quotation For</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone No</th>
            <th scope="col">Quantity</th>
            <th scope="col">Project DeadLine</th>
            <th scope="col">Project cost</th>
            <th scope="col">Amount Paid</th>
            <th scope="col">Amount Due</th>
            <th scope="col">Status</th>
            <th colspan="2">Action</th>
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
                <th scope="row"><?= $rowNo++; ?></th>
                <td class=""><?= $value['projectId'];  ?></td>
                <td class=""><?= $value['quotationId']  ?></td>
                <td class=""><?= $value['EnquiryData']['KW'] . " " . $value['EnquiryData']['unit'] . " " . $value['EnquiryData']['Grid'] . " System";  ?></td>
                <td class=""><?= $value['EnquiryData']['cName']  ?></td>
                <td class=""><?= $value['EnquiryData']['email']  ?></td>
                <td class=""><?= $value['EnquiryData']['phone']  ?></td>
                <td class=""><?= $value['EnquiryData']['quantity']  ?></td>
                <td class=""> <?= $value['projectDeadLine']  ?></td>
                <td class=""><?= number_format($value['quotationData']['NetAmount'], 2)  ?></td>
                <td class=""> <?= $value['amountPaid']['paidAmount'] != "" ? $value['amountPaid']['paidAmount'] : 0  ?></td>
                <td class=""><?= $value['amountPaid']['paidAmount'] != "" ? number_format($value['quotationData']['NetAmount']  - $value['amountPaid']['paidAmount'], 2) : 0  ?></td>
                <td class=""><?= $value['Status']  ?></td>
                <td><a href="<?= base_url('View-Project-Details?id=') . base64_encode($id);  ?>"><i class="fas fa-eye"></i></a></td>
                <td><a href="<?php echo site_url("Download-PDF/{$value['quoitemData']['id']}"); ?>" class="btn btn-primary"><i class="fa fa-download"></i></a> </td>
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

<?php include 'footer.php'; ?>