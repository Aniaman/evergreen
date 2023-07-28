<?php
include 'header.php';
include 'navigation.php'; ?>
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
      <div class="row">
        <div class="col-md-6">
          <strong>
            <h3 class="card-title">Quotation List</h3>
          </strong>
        </div>
        <div class="col-md-6">
          <div class="flex-container float-right">
            <div class="row">
              <div class="col-md-6">
                <form>
                  <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
                </form>
              </div>
              <div class="col-md-6">
                <select class="form-control filter-handle">
                  <option value="">All</option>
                  <?php
                  foreach ($status as $statusValue) { ?>
                    <option value="<?= $statusValue['quotationId'] ?>"><?php echo $statusValue['status']; ?></option>
                  <?php   }
                  ?>

                </select>
              </div>
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
      <table id="example1" class="table table-bordered table-striped filter-table-data">
        <thead class="text-center">
          <tr id="statusVal">
            <th>SL No</th>
            <th>Agent Name</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Customer Phone</th>
            <th>Enquiry Id</th>
            <th>Quotation ID</th>
            <th>Quotation Status</th>
            <th>Total</th>
            <th>Commission Rate</th>
            <th>Commission Amount</th>
            <th>Net Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php
          $s = 1;
          foreach ($details as $value) { ?>
            <tr data-type="<?php echo $value['quotationStatus']; ?>">
              <td><?php echo $s; ?></td>
              <?php
              if (sizeof($value['agent']) > 0) {
                foreach ($value['agent'] as  $agent) { ?>
                  <td><?= $agent['name'] ?></td>
                <?php }
              } else {
                echo "<td>------------NA-----------</td>";
              }
              if (sizeof($value['enquiry']) > 0) {
                foreach ($value['enquiry'] as  $customer) { ?>
                  <td><?= $customer['cName'] ?></td>
                  <td><?= $customer['email'] ?></td>
                  <td><?= $customer['phone'] ?></td>
              <?php  }
              }
              ?>
              <td><?= $value['enqId'] ?></td>
              <td><?= $value['quoId'] ?></td>
              <td><?= $value['status']['status'] ?></td>
              <td><?php echo $value['total']; ?></td>
              <td><?php echo $value['rate']; ?></td>
              <?php
              $commissionAmount = $value['commi'] - $value['total'];
              ?>
              <td><?= $commissionAmount; ?></td>
              <td><?php echo $value['commi']; ?></td>
              <td><a href="<?php echo site_url("Admin/pdfview/{$value['id']}"); ?>" class="btn btn-success">View Pdf</a> </td>
              <?php $s++; ?>
            </tr>
          <?php  }
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
</script>
<?php include 'footer.php'; ?>