<?php
$this->load->library('session');
$Agid = $this->session->agent_id;
include 'header.php';
include 'navigation.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.ckeditor.com/4.10.0/full-all/ckeditor.js"></script>

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
        <?php echo form_open('Reminder'); ?>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Date:</label>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
              <input type="text" name="reminderDate" class="form-control datetimepicker-input" data-target="#reservationdate" />
              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="quoId" id="quoId">

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
        <?php echo form_open('follow-Up'); ?>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Quotation No</label>
            <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'quoId', 'id' => 'quotationId', 'readonly' => 'readonly']); ?>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Message</label>
            <?php echo form_textarea(['type' => 'text', 'class' => 'form-control', 'name' => 'message']); ?>
          </div>
        </div>
        <input type="hidden" name="enquiryId" id="enquiryId">

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
<!-- /.modal -->
<div class="content-wrapper">
  <!-- Main content -->
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          <strong>
            <h3 class="card-title">Quotation List</h3>
          </strong>
        </div>
        <div class="col-md-6">
          <div class="flex-container float-right">
            <div class="row">
              <form>
                <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
              </form>
            </div>
          </div>
        </div>
      </div>
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
      <table id="example1" class=" table mb-0 table-bordered table-striped filter-table-data dtHorizontalExample">
        <thead>
          <tr id="statusVal">
            <th>SL No</th>
            <th>Enquiry Id</th>
            <th>Quotation ID</th>
            <th>Customer Name</th>
            <th>Phone No</th>
            <th>Email</th>
            <th>Grid</th>
            <th>Quantity</th>
            <th>KW</th>
            <th>unit</th>
            <th>Date</th>
            <th>Reminder</th>
            <th>Followup</th>
            <th>
              <select class="form-control filter-handle">
                <option value="">All</option>
                <?php
                foreach ($status as $statusValue) { ?>
                  <option value="<?= $statusValue['quotationId'] ?>"><?php echo $statusValue['status']; ?></option>
                <?php   }
                ?>

              </select>QuotationStatus
            </th>
            <th>Total (Without GST and Commission)</th>
            <th>Commission Rate</th>
            <th>Commission Amount</th>
            <th>Net Total (Without GST)</th>
            <th colspan="7">Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php
          $s = 1;
          foreach ($details as $value) {
            $commiAmount = $value['commi'] - $value['total'];
            $id = $value['id'];
            $enqId = $value['enqId'];

          ?>
            <tr data-type="<?php echo $value['quotationStatus']; ?>">
              <td><?php echo $s; ?></td>
              <td><?php echo $value['enqId']; ?></td>
              <td><?php echo $value['quoId']; ?></td>
              <td><?php echo $value['cName']; ?></td>
              <td><?php echo $value['phone']; ?></td>
              <td><?php echo $value['email']; ?></td>
              <td><?php echo $value['Grid']; ?></td>
              <td><?php echo $value['quantity']; ?></td>
              <td><?php echo $value['KW']; ?></td>
              <td><?php echo $value['unit']; ?></td>
              <td><?php echo $value['created']; ?></td>
              <td><?php echo $value['reminderDate'] != "" ? $value['reminderDate'] : ""; ?></td>
              <td><a href=" <?php echo site_url("Follow-Up-Data/{$value['quoId']}"); ?>">Follow-up report</a></td>
              <td>
                <select class="form-control" name="quotation_status" id="quotation_status" onchange="updateOrderStatus(this,<?php echo $value['enqId']; ?>)">
                  <option id="defaultValue" value="<?= $value['quotationStatus'] ?>"><?php echo $value['status']; ?></option>
                  <?php
                  foreach ($status as $statusValue) { ?>
                    <option value="<?= $statusValue['quotationId'] ?>"><?php echo $statusValue['status']; ?></option>
                  <?php   }
                  ?>
                </select>
              </td>
              <td><?php echo number_format(($value['commi'] * $value['quantity']) - $commiAmount, 2); ?></td>
              <td><?php echo number_format($value['rate'], 2); ?></td>
              <td><?php echo number_format($commiAmount, 2); ?></td>
              <td><?php echo number_format(($value['commi'] * $value['quantity']), 2); ?></td>
              <td><button class="btn btn-info view_detail" relid="<?php echo $value['enqId']; ?>">Reminder</button></td>
              <td colspan="2"><button class="btn btn-info follow_up" relid="<?php echo $value['enqId']; ?>" quoId="<?php echo $value['quoId']; ?>">FollowUp</button></td>
              <td><a href=" <?php echo site_url("Agent/viewpdf/{$value['enqId']}"); ?>" class="btn btn-success">View</a> </td>
              <td><a href="<?php echo site_url("Agent/editquotation?id={$id}"); ?>" class="btn btn-warning">Edit</a> </td>
              <td><a href="<?php echo site_url("Download-PDF/{$id}"); ?>" class="btn btn-primary">Download</a> </td>
              <td><a href="<?php echo site_url("Create-Project/{$enqId}"); ?>" class="btn btn-primary">Create Project</a> </td>
            </tr>
          <?php $s++;
          }
          ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>
<!-- /.col -->
<script type="text/javascript">
  $('.filter-handle').on('change', function(e) {
    // retrieve the dropdown selected value
    var location = e.target.value;
    console.log(location);
    document.getElementById('statusVal').setAttribute(`data-type`, `${location}`);
    var table = $('.filter-table-data');
    // if a location is selected
    if (location.length) {
      // hide all not matching
      table.find('tr[data-type!=' + location + ']').hide();
      // display all matching
      table.find('tr[data-type=' + location + ']').show();
    } else {
      // location is not selected,
      // display all
      table.find('tr').show();
    }
  });

  function updateOrderStatus(obj, quoId) {
    $.get("<?php echo base_url('Agent/updateQuotationStatus/'); ?>", {
        rowid: quoId,
        status: obj.value
      },
      function(resp) {
        if (resp == 'ok') {
          location.reload();
        } else {
          alert('Status update failed,Please try again.');
        }
      });
  }

  $(document).ready(function() {
    $('.view_detail').click(function() {
      var id = $(this).attr('relid'); //get the attribute value
      let quoId = document.getElementById('quoId')
      let quotationId = document.getElementById('quotationId')
      quoId.setAttribute(`value`, `${id}`);
      quotationId.setAttribute(`value`, `${id}`);
      $('#modal-reminder').modal({
        backdrop: 'static',
        keyboard: true,
        show: true
      });
    });
  });

  $(document).ready(function() {
    $('.follow_up').click(function() {
      var enquiryId = $(this).attr('relid');
      var quoNo = $(this).attr('quoId');
      console.log(quoNo);

      let quotationId = document.getElementById('quotationId')
      quotationId.setAttribute(`value`, `${quoNo}`);

      let enquiry = document.getElementById('enquiryId')
      enquiry.setAttribute(`value`, `${enquiryId}`);
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

  CKEDITOR.replace('message', {
    allowedContent: true,
    extraPlugins: 'wysiwygarea'

  });
</script>
<?php include 'footer.php'; ?>