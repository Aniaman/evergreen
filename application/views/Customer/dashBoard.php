<?php
include 'common/header.php';
include 'navigation.php';
?>
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="row">
        <div class="col">
          <h3 class="page-title">Project List</h3>
          <ol class="breadcrumb mt-2">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Project List</a></li>
          </ol>
        </div><!--end col-->

      </div><!--end row-->
    </div><!--end page-title-box-->
  </div><!--end col-->
</div><!--end row-->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <div style="display: flex; ">
          <h3 class=" card-title">Project List</h3>
          <form style="margin-left:83%"">
            <input type=" search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
          </form>
        </div><!--end card-header-->
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Project No</th>
                <th scope="col">Quotation No</th>
                <th scope="col">Quotation For</th>
                <th scope="col">Quantity</th>
                <th scope="col">Project DeadLine</th>
                <th scope="col">Project cost</th>
                <th scope="col">Amount Paid</th>
                <th scope="col">Amount Due</th>
                <th scope="col">Status</th>
                <th scope="col" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody id="myTable">

              <?php
              if (!empty($projectData)) {
                $tableClass = "";
                $rowNo = 1;
                foreach ($projectData as $value) {
                  if ($value['Status'] == 'Process') {
                    $tableClass = 'table-primary';
                  } else if ($value['Status'] == 'Complete') {
                    $tableClass = 'table-success';
                  }
                  $id = str_replace("/", ":", $value['projectId']);
              ?>
                  <tr class="<?= $tableClass; ?>">
                    <th scope="row"><?= $rowNo++; ?></th>
                    <td class=""><?= $value['projectId'] != "" ? $value['projectId'] : "";  ?></td>
                    <td class=""><?= $value['quotationId'] != "" ? $value['quotationId'] : "" ?></td>
                    <td class=""><?= $value['EnquiryData']['KW'] . " " . $value['EnquiryData']['unit'] . " " . $value['EnquiryData']['Grid'] . " System";  ?></td>
                    <td class=""><?= $value['EnquiryData']['quantity'] != "" ? $value['EnquiryData']['quantity'] : ""  ?></td>
                    <td class=""> <?= $value['projectDeadLine'] != "" ? $value['projectDeadLine'] : ""  ?></td>
                    <td class=""><?= number_format($value['quotationData']['NetAmount'], 2)  ?></td>
                    <td class=""> <?= $value['amountPaid']['paidAmount'] != "" ? $value['amountPaid']['paidAmount'] : 0  ?></td>
                    <td class=""><?= $value['amountPaid']['paidAmount'] != "" ? number_format($value['quotationData']['NetAmount']  - $value['amountPaid']['paidAmount'], 2) : number_format($value['quotationData']['NetAmount'] - $value['amountPaid']['paidAmount'], 2)  ?></td>
                    <td class=""><?= $value['Status']  ?></td>
                    <td><a href="<?= base_url('Project-Detail-View?id=') . base64_encode($id);  ?>"><i class="fas fa-eye"></i></a></td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table><!--end /table-->
        </div><!--end /tableresponsive-->
      </div><!--end card-body-->
    </div><!--end card-->
  </div><!--end col-->
</div>
<?php
include 'common/footer.php'; ?>