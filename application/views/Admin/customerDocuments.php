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
        <h4 class="modal-title">Customer Documents</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Document-Action'); ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Document type</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'documentName', 'placeholder' => 'Add Documents Type', 'required' => 'required']); ?>
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
        <h3 class="card-title">Customer Documents List</h3>
      </strong>
      <div class="flex-container float-right">
        <div class="row">
          <form>
            <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
          </form>
          <button type="button" class="btn btn-info ml-3" data-toggle="modal" data-target="#modal-default">
            Add Customer Documents Type
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
            <th>#</th>
            <th>Documents Type</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php
          if (!empty($documentName)) {
            $i = 1;
            foreach ($documentName as  $value) { ?>
              <tr>

                <td><?= $i++; ?></td>
                <td><?= $value['documentName'] != "" ? $value['documentName'] : ""  ?></td>
                <td><a href="<?= base_url('Delete-Document?id=') . base64_encode($value['document_id']);  ?>"><i class="fas fa-trash"></i></a></td>
              </tr>
          <?php }
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