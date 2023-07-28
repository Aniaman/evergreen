<?php include 'header.php';
include 'navigation.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- /.modal -->
<div class="modal fade" id="modal-reminder">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reminder</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Update-Warranty'); ?>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Warranty</label>
            <input type="text" name="warranty" class="form-control">
          </div>
        </div>
        <input type="hidden" name="quoId" id="quoId">
        <input type="hidden" name="enqId" id="enqId">

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
  <div class="row">
    <div class="col-md-11 ml-5 mt-4">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Create Project</h3>
        </div>
        <div class="card-body p-0">
          <div class="bs-stepper">
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <?= form_open('Create-Project-Action', 'enctype="multipart/form-data"') ?>
              <div class="card-body">
                <dl class="row">
                  <?php
                  if (!empty($quotation)) { ?>
                    <dt class="col-sm-4">Quotation No</dt>
                    <dd class="col-sm-8"><?= $quotation['EnquiryData']['quoid']; ?></dd>
                    <dt class="col-sm-4">Customer Name</dt>
                    <dd class="col-sm-8"><?= $quotation['EnquiryData']['cName']; ?></dd>
                    <dt class="col-sm-4">Customer Phone</dt>
                    <dd class="col-sm-8"><?= $quotation['EnquiryData']['phone']; ?></dd>
                    <dt class="col-sm-4">Customer Email</dt>
                    <dd class="col-sm-8"><?= $quotation['EnquiryData']['email']; ?></dd>
                    <dt class="col-sm-4">Billing Address</dt>
                    <dd class="col-sm-8"><?= $quotation['EnquiryData']['billAddress1'] . "," . $quotation['EnquiryData']['billAddress2'] . "," . $quotation['EnquiryData']['billstate'] . "," . $quotation['EnquiryData']['billPin']; ?></dd>
                    <dt class="col-sm-4">Shipping Address</dt>
                    <dd class="col-sm-8"><?= $quotation['EnquiryData']['shipAddress1'] . "," . $quotation['EnquiryData']['shipAddress2'] . "," . $quotation['EnquiryData']['shipState'] . "," . $quotation['EnquiryData']['shipPin']; ?></dd>
                    <dt class="col-sm-4">Requirement</dt>
                    <dd class="col-sm-8"><?= $quotation['EnquiryData']['KW'] . " " . $quotation['EnquiryData']['unit'] . " " . $quotation['EnquiryData']['Grid'] . " System"; ?></dd>
                    <dt class="col-sm-4">Quantity</dt>
                    <dd class="col-sm-8"><?= $quotation['EnquiryData']['quantity'] ?></dd>
                    <dt class="col-sm-4">Payment term</dt>
                    <dd class="col-sm-8">
                      <table class="table table-bordered table-responsive">
                        <tbody>
                          <tr><?php
                              foreach ($quotation['paymentTermData'] as  $value) { ?>
                              <td><?= $value['percent'] . '% ' . $value['description']  ?> = <?php echo $value['Amount']; ?></td>
                            <?php } ?>
                          </tr>
                        </tbody>
                      </table>
                    </dd>
                    <dt class="col-sm-4">Project Id</dt>
                    <dd class="col-sm-4"><input type="text" placeholder="--/--/--" name="projectId" class="form-control" required></dd>
                    <dd class="col-sm-4"><input type="text" name="projectNo" value="<?= strtotime(date("Y-m-d H:i:s")); ?>" class="form-control" readonly></dd>
                    <dt class="col-sm-4">Project Level Warranty</dt>
                    <dd class="col-sm-8"><input type="text" placeholder="Enter warranty in month" name="projectLevel" class="form-control" required></dd>
                    <input type="hidden" name="quotationId" value="<?= $quotation['EnquiryData']['quoid']; ?>" id="">
                  <?php  }
                  ?>


                </dl>
              </div>

              <table class="table table-bordered">
                <thead>
                  <th>Sl No</th>
                  <th>Material Name</th>
                  <th>Supplier</th>
                  <th>Qty</th>
                  <th>Specification</th>
                  <th>Price</th>
                  <th>Warranty</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                  $s = 1;

                  foreach ($quotation['productData'] as  $value) {
                  ?>
                    <tr>
                      <td><?php echo $s; ?></td>
                      <td><?php echo $value['name']; ?></td>
                      <td><?php echo $value['supplier']; ?></td>
                      <td><?php echo $value['quantity']; ?></td>
                      <td><?php echo $value['spec']; ?> </td>
                      <td><?php echo $value['quantity'] * $value['price'] ?></td>
                      <td><?php echo $value['warranty']; ?> </td>
                      <td><a class="btn btn-info view_detail" enqId="<?php echo $quotation['EnquiryData']['EnqId']; ?>" relid="<?php echo $value['id']; ?>">Add Warranty</a></td>
                    </tr>
                  <?php
                    $s++;
                  } ?>
                </tbody>

              </table>
              <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-4">Terms & Condition</dt>
                  <dd class="col-sm-8"><?= $quotation['termAndCondition']; ?></dd>
                  <dt class="col-sm-4">Project DeadLine</dt>
                  <dd class="col-sm-8"><input type="date" name="projectDeadLine" class="form-control" required></dd>
                </dl>
                <div class="form-group">
                  <label for="exampleInputFile">Purchase Order (Only PDF)</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="purchaseOrder" class="form-control" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
          <?= form_close(); ?>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.view_detail').click(function() {
      var id = $(this).attr('relid'); //get the attribute value
      var enqId = $(this).attr('enqId'); //get the attribute value
      let quoId = document.getElementById('quoId')
      let quotationId = document.getElementById('quotationId')
      quoId.setAttribute(`value`, `${id}`);
      document.getElementById('enqId').setAttribute(`value`, `${enqId}`)
      $('#modal-reminder').modal({
        backdrop: 'static',
        keyboard: true,
        show: true
      });
    });
  });
</script>

<?php include('footer.php'); ?>