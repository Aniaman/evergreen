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
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Quotation Status</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Quotation-Status-Action'); ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Status</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'quotationStatus', 'placeholder' => 'Add Quotation Status', 'required' => 'required']); ?>
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

<div class="modal fade" id="modal-statusEdit">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Quotation Status</h4>
        <button type="button" id="modal-statusEdit-close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Status-Action'); ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Status</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'quotationStatus', 'id' => 'quotationStatus', 'placeholder' => 'Add Quotation Status', 'required' => 'required']); ?>
            </div>
          </div>
          <input type="hidden" name="id" id="quotationId">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-statusEdit-closes">Close</button>
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
        <h3 class="card-title">Quotation Status List</h3>
      </strong>
      <div class="flex-container float-right">
        <div class="row">
          <form>
            <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
          </form>
          <button type="button" class="btn btn-info ml-3" data-toggle="modal" data-target="#modal-default">
            Add Status
          </button>
        </div>
      </div>
    </div>
    <?php if ($error = $this->session->flashdata('success')) { ?>
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
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL No</th>
            <th>Quotation Status</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            if (sizeof($status) > 0) {
              foreach ($status as $value) { ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $value['status']; ?></td>
            <td><a class="status_view" projectId="<?= $value['quotationId']; ?>"><i class="fas fa-edit text-info"></i></a></td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('.status_view').click(function() {
      var projectId = $(this).attr('projectId');
      $.ajax({
        url: "<?php echo base_url(); ?>Admin/getEditData",
        data: {
          'id': projectId
        },
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          document.getElementById('quotationStatus').setAttribute(`value`, `${response.status}`);
          document.getElementById('quotationId').setAttribute(`value`, `${response.quotationId}`);
        }
      });

      $('#modal-statusEdit').modal({
        backdrop: 'static',
        keyboard: true,
        show: true
      });
    });
  });
</script>
<?php include 'footer.php'; ?>