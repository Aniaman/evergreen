<?php
include 'common/header.php';
include 'navigation.php';
?>
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="row">
        <div class="col">
          <h3 class="page-title">Confirm Enquiry List</h3>
          <ol class="breadcrumb mt-2">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Confirm Enquiry List</a></li>
          </ol>
        </div><!--end col-->
      </div><!--end row-->
    </div><!--end page-title-box-->
  </div><!--end col-->
</div><!--end row-->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">All Enquiry</h3>
    <form style="padding-left: 85%;">
      <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
    </form>
  </div><!--end card-header-->
  <div class="card-body ">
    <div class="table-responsive-xxl">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Reference Id</th>
            <th scope="col">Quotation Id</th>
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
            <th scope="col">Commission Rate</th>
            <th scope="col">Commission Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Created Date</th>
            <th scope="col">Action</th>

          </tr>
        </thead>
        <tbody id="myTable">

          <?php

          if (sizeof($enquiryData) > 0) {
            $tableClass = "";
            $rowNo = 1;
            foreach ($enquiryData as $value) {
              if ($value['status'] == 'Approve') {
          ?>
                <tr class="table-success">
                  <th scope="row"><?= $rowNo++; ?></th>
                  <td class=""><?= $value['p_enquiryId'];  ?></td>
                  <td class=""><?= $value['quotationId'] != "" ? $value['quotationId'] : "NA";  ?></td>
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
                  <td class=""><?= $value['counterCommission'] != 0 ? $value['counterCommission'] : 0  ?></td>
                  <td class=""><?= $value['commissionAmount'] != 0 ? $value['commissionAmount'] : "Quotation Not Created Yet"  ?></td>
                  <td class=""> <?= $value['status']  ?></td>
                  <td class=""> <?= date_format(date_create($value['added_date']), 'd-m-Y')  ?></td>
                  <?php if ($value['quotationId'] != "") { ?>
                    <td class=""> <a href="<?= base_url('Download-Quotation?id=') . base64_encode($value['quotationId']) ?>"><i class="fas fa-download"></i></a></td>
                  <?php } else { ?>
                    <td></td>
                  <?php } ?>
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
</div>
<?php include 'common/footer.php'; ?>