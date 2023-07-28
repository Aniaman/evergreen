<?php include 'header.php'; ?>
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
        <h3 class="card-title">Payment Term List</h3>
      </strong>
      <div class="flex-container float-right">
        <div class="row">
          <form>
            <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
          </form>
          <button type="button" class="btn btn-info ml-3" data-toggle="modal" data-target="#modal-default">
            Add Payment Terms
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
            <th>Payment Percent</th>
            <th>Payment Description</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            if (sizeof($paymentTerm) > 0) {
              foreach ($paymentTerm as $value) { ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $value['paymentPercent'] . "%"; ?></td>
            <td><?php echo $value['paymentTermDescription']; ?></td>
            <td>
              <a href="<?= base_url('Delete-PaymentTerm?id=') . base64_encode($value['paymentTermId']);  ?>"><i class="fas fa-trash"></i></a>
            </td>
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