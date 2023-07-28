<?php
include 'header.php';
include 'navigation.php';
?>
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
<div class="content-wrapper mt-2">
  <!-- Main content -->
  <div class="card">

    <div class="card-header">
      <strong>
        <h3 class="card-title">Reference Enquiry List</h3>
      </strong>
      <div class="flex-container float-right">
        <div class="row">
          <form>
            <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
          </form>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive-sm">
        <table class="table mb-0">
          <thead>
            <tr>
              <th scope="col">SL No</th>
              <th scope="col">Reference Enquiry Id</th>
              <th scope="col">Enquiry Id</th>
              <th scope="col">Quotation Id</th>
              <th scope="col">Name</th>
              <th scope="col">Phone</th>
              <th scope="col">Email</th>
              <th scope="col">Billing Address</th>
              <th scope="col">Shipping Address</th>
              <th scope="col">Quantity</th>
              <th scope="col">Grid</th>
              <th scope="col">KW</th>
              <th scope="col">Unit</th>
              <th scope="col">Commission</th>
              <th scope="col">Commission Amount</th>
              <th scope="col">Remark</th>
              <th scope="col">Create Date</th>
            </tr>
          </thead>
          <tbody id="myTable">

            <?php
            if (!empty($referenceEnquiry)) {
              $i = 0;
              foreach ($referenceEnquiry as  $value) {
            ?>
                <tr>
                  <td><?= ++$i; ?></td>
                  <td><?= $value['p_enquiryId'] ?></td>
                  <td><?= $value['enquiryId'] ?></td>
                  <td><?= $value['quotationId'] != "" ? $value['quotationId'] : "NA" ?></td>
                  <td><?= $value['fullName'] ?></td>
                  <td><?= $value['phone'] ?></td>
                  <td><?= $value['email'] ?></td>
                  <td><?= $value['billingAddress'] ?></td>
                  <td><?= $value['shippingAddress'] ?></td>
                  <td><?= $value['quantity'] ?></td>
                  <td><?= $value['grid'] ?></td>
                  <td><?= $value['kw'] ?></td>
                  <td><?= $value['unit'] ?></td>
                  <td><?= $value['counterCommission'] ?></td>
                  <td><?= number_format($value['commissionAmount'], 2) ?></td>
                  <td><?= $value['remark'] ?></td>
                  <td><?= date("d-m-Y", strtotime($value['added_date'])) ?></td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<?php include 'footer.php'; ?>