<?php //print_r($reminder);exit; 
?>
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

<div class="content-wrapper">
  <!-- Main content -->
  <div class="card">
    <div class="card-header">
      <strong>
        <h2 class="card-title">Follow Chart</h2>
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
      <table id="example1" class="table table-bordered table-striped">
        <thead class="text-center">
          <tr>
            <th>SL No.</th>
            <th>Enquiry Id</th>
            <th>Quotation Id</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Grid</th>
            <th>KW</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            foreach ($reminder as $value) { ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $value['enqid']; ?></td>
            <td><?php echo $value['quoid']; ?></td>
            <td><?php echo $value['cname']; ?></td>
            <td><?php echo $value['phone']; ?></td>
            <td><?php echo $value['grid']; ?></td>
            <td><?php echo $value['kw']; ?></td>
            <td>
              <?php
              echo form_open('Agent/updatereminderfollow');
              echo form_hidden('id', $value['id']);
              echo form_submit(['name' => 'update', 'value' => 'Done', 'class' => 'btn btn-success']);
              echo form_close();
              ?>
            </td>
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