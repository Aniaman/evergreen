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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Follow Up</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Agent-Transfer'); ?>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enquiry No</label>
            <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'EnqId', 'id' => 'enquiryId', 'readonly' => 'readonly']); ?>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Select Agent</label>
            <select class="form-control" name="AgentId" id="agent">
            </select>
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
      <?php if ($error = $this->session->flashdata('fail')) { ?>
        <div class="col-md-6 col-md-offset-3">
          <div class="alert alert-danger">
            <?php echo $error; ?>
          </div>
        </div>
      <?php } ?>
      <?php if ($error = $this->session->flashdata('Success')) { ?>
        <div class="col-md-6 col-md-offset-3">
          <div class="alert alert-success">
            <?php echo $error; ?>
          </div>
        </div>
      <?php } ?>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL No</th>
            <th>Enquiry Id</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Billing Address</th>
            <th>Shipping Address</th>
            <th>Quantity</th>
            <th>Grid</th>
            <th>KW</th>
            <th>Unit</th>
            <th>Remark</th>
            <th colspan="4">Action </th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            foreach ($enquiry as $value) { ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $value['EnqId']; ?></td>
            <td><?php echo $value['cName']; ?></td>
            <td><?php echo $value['phone']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['billAddress1'] . "," . $value['billAddress2'] . "," . $value['billstate'] . "," . $value['billPin']; ?></td>
            <td><?php echo $value['shipAddress1'] . "," . $value['shipAddress2'] . "," . $value['shipState'] . "," . $value['shipPin']; ?></td>
            <td><?php echo $value['quantity']; ?></td>
            <td><?php echo $value['Grid']; ?></td>
            <td><?php echo $value['KW']; ?></td>
            <td><?php echo $value['unit']; ?></td>
            <td><?php echo $value['remark']; ?></td>


            <td>
              <a href="<?= base_url('Clone-Enquiry?action=0&id=') . base64_encode($value['id']);  ?>"><i class="fas fa-clone"></i></a>
            </td>


            <td><a href="<?= base_url('Clone-Enquiry?action=1&id=') . base64_encode($value['id']);  ?>"><i class="fas fa-edit"></i></a></td>


            <td><a href="<?= base_url('Clone-Enquiry?action=2&id=') . base64_encode($value['id']);  ?>"><i class="fas fa-trash"></i></a>
            </td>

            <td><button class="btn btn-primary follow_up" relid="<?php echo $value['EnqId']; ?>"><i class="fas fa-share"></i></button>
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
<script>
  $(document).ready(function() {
    $('.follow_up').click(function() {
      var enquiryId = $(this).attr('relid');
      console.log(enquiryId);

      let enquiry = document.getElementById('enquiryId')
      enquiry.setAttribute(`value`, `${enquiryId}`);

      $.ajax({
        url: "<?php echo base_url(); ?>Admin/agentListData",
        data: {},
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          var i = 1;
          let paymentTermData = `<option value="">------Select Agent-----</option>`
          response.data.map((e) => {
            paymentTermData = paymentTermData + `<option value="${e.id}">${e.agentName}</option>`;
          });

          console.log(paymentTermData);
          $('#agent').html(paymentTermData);
        }
      });


      $('#modal-follow').modal({
        backdrop: 'static',
        keyboard: true,
        show: true
      });
    });
  });
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example1').DataTable({
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