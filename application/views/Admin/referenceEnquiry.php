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

<div class="modal fade" id="modal-follow">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Follow Up</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Counter-Commission'); ?>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Quotation No</label>
            <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'p_enquiryId', 'id' => 'referenceId', 'readonly' => 'readonly']); ?>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Commission Rate</label>
            <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'counterCommission']); ?>
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

<div class="content-wrapper">
  <!-- Main content -->
  <?php if ($error = $this->session->flashdata('success')) { ?>
    <div class="alert alert-success border-0" role="alert">
      <?php echo $error; ?>
    </div>
  <?php }
  if ($error = $this->session->flashdata('fail')) { ?>
    <div class="alert alert-danger border-0" role="alert">
      <?php echo $error; ?>
    </div>
  <?php } ?>
  <div class="card">
    <div class="card-header">
      <strong>
        <h3 class="card-title">Enquiry List</h3>
      </strong>
      <form class="form-inline" style="padding-left: 70%;">
        <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
      </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="table-responsive-sm">
        <table class="table table-bordered table-striped table-responsive">
          <thead class="text-center">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Reference Id</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Phone No</th>
              <th scope="col">Email Id</th>
              <th scope="col">Billing Address</th>
              <th scope="col">Shipping Address</th>
              <th scope="col">GST No</th>
              <th scope="col">Grid</th>
              <th scope="col">KW</th>
              <th scope="col">Unit</th>
              <th scope="col">Quantity</th>
              <th scope="col">Remark</th>
              <th scope="col">Commission Request</th>
              <th scope="col">Status</th>
              <th scope="col" colspan="4">Action</th>
            </tr>
          </thead>
          <tbody id="myTable">

            <?php

            if (sizeof($enquiryData) > 0) {
              $tableClass = "";
              $rowNo = 1;
              foreach ($enquiryData as $value) {
                $id = $value['re_id'];
                if ($value['status'] != 'Approve') {
            ?>
                  <tr>
                    <th scope="row"><?= $rowNo++; ?></th>
                    <td class=""><?= $value['p_enquiryId'];  ?></td>
                    <td class=""><?= $value['fullName']  ?></td>
                    <td class=""> <?= $value['phone']  ?></td>
                    <td class=""><?= $value['email']  ?></td>
                    <td class=""> <?= $value['billingAddress']  ?></td>
                    <td class=""><?= $value['shippingAddress']  ?></td>
                    <td class=""> <?= $value['gstNo']  ?></td>
                    <td class=""><?= $value['grid']  ?></td>
                    <td class=""> <?= $value['kw']  ?></td>
                    <td class=""><?= $value['unit']  ?></td>
                    <td class=""> <?= $value['quantity']  ?></td>
                    <td class=""><?= $value['remark']  ?></td>
                    <td class=""> <?= $value['commission']  ?></td>
                    <td class=""> <?= $value['status']  ?></td>
                    <td><a href="<?= base_url("Accept-Offer-Admin/{$value['p_enquiryId']}/{$value['commission']}") ?>" class="btn btn-success">Approve</a></td>
                    <td><button class="btn btn-info follow_up" relid="<?php echo $value['p_enquiryId']; ?>">Counter Commission</button></td>
                    <td><a class="btn btn-danger" href="<?= base_url("Delete-Enquiry/{$id}") ?>">Reject</a></td>
                  </tr>
            <?php
                }
              }
            }
            ?>
          </tbody>
        </table><!--end /table-->
      </div><!--end /tableresponsive-->
    </div><!--end card-body-->
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<script>
  $(document).ready(function() {
    $('.follow_up').click(function() {
      var referenceId = $(this).attr('relid');
      document.getElementById('referenceId').setAttribute(`value`, `${referenceId}`);
      $('#modal-follow').modal({
        backdrop: 'static',
        keyboard: true,
        show: true
      });
    });
  });
</script>
<?php include 'footer.php'; ?>