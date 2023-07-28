<?php include 'common/header.php';
include 'navigation.php'; ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-11 ml-5 mt-4">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title"><strong>Project Details</strong></h3>
        </div>
        <div class="card-body p-0">
          <div class="bs-stepper">
            <div class="bs-stepper-content">
              <div class="card-body">

                <?php
                if (!empty($quotationData)) { ?>
                  <dl class="row">
                    <dt class="col-sm-4">Quotation No</dt>
                    <dd class="col-sm-8"><?= $quotationData['quotationId']; ?></dd>

                    <dt class="col-sm-4">Enquiry No</dt>
                    <dd class="col-sm-8"><?= $quotationData['enqId']; ?></dd>

                    <dt class="col-sm-4">Customer Name</dt>
                    <dd class="col-sm-8"><?= $quotationData['EnquiryData']['cName']; ?></dd>

                    <dt class="col-sm-4">Customer Email Id</dt>
                    <dd class="col-sm-8"><?= $quotationData['EnquiryData']['email']; ?></dd>

                    <dt class="col-sm-4">Customer Phone No</dt>
                    <dd class="col-sm-8"><?= $quotationData['EnquiryData']['phone']; ?></dd>

                    <dt class="col-sm-4">Billing Address</dt>
                    <dd class="col-sm-8"><?= $quotationData['EnquiryData']['billAddress1'] . "," . $quotationData['EnquiryData']['billAddress2'] . "," . $quotationData['EnquiryData']['billstate'] . "," . $quotationData['EnquiryData']['billPin']; ?></dd>

                    <dt class="col-sm-4">Shipping Address</dt>
                    <dd class="col-sm-8"><?= $quotationData['EnquiryData']['shipAddress1'] . "," . $quotationData['EnquiryData']['shipAddress2'] . "," . $quotationData['EnquiryData']['shipState'] . "," . $quotationData['EnquiryData']['shipPin']; ?></dd>

                    <dt class="col-sm-4">Requirement</dt>
                    <dd class="col-sm-8"><?= $quotationData['EnquiryData']['KW'] . " " . $quotationData['EnquiryData']['unit'] . " " . $quotationData['EnquiryData']['Grid'] . " System"; ?></dd>

                    <dt class="col-sm-4">Quantity</dt>
                    <dd class="col-sm-8"><?= number_format($quotationData['quantity']); ?></dd>
                    <?php
                    if ($quotationData['EnquiryData']['Grid'] == 'PUMP' || $quotationData['EnquiryData']['Grid'] == 'SOLAR WATER HEATER' || $quotationData['EnquiryData']['Grid'] == 'DEFAULT' || $quotationData['EnquiryData']['Grid'] == 'STREET LIGHT') { ?>
                      <dt class="col-sm-4">GST 12 %</dt>
                      <dd class="col-sm-8"><?= number_format($quotationData['gstTwelve'], 2); ?></dd>
                    <?php  } else {
                    ?>
                      <dt class="col-sm-4">GST 12 %</dt>
                      <dd class="col-sm-8"><?= number_format($quotationData['gstTwelve'], 2); ?></dd>
                      <dt class="col-sm-4">Amount with 12% GST</dt>
                      <dd class="col-sm-8"><?= number_format($quotationData['amountWithTwelve'], 2); ?></dd>
                      <dt class="col-sm-4">GST 18 %</dt>
                      <dd class="col-sm-8"><?= number_format($quotationData['gstEighteen'], 2); ?></dd>
                      <dt class="col-sm-4">Amount with 18% GST</dt>
                      <dd class="col-sm-8"><?= number_format($quotationData['amountWithEighteen'], 2); ?></dd>
                    <?php } ?>
                    <dt class="col-sm-4">Project Cost</dt>
                    <dd class="col-sm-8"><?= number_format($quotationData['NetAmount'], 2); ?></dd>

                    <dt class="col-sm-4">Terms & Condition</dt>
                    <dd class="col-sm-8"><?= $quotationData['termAndCondition']; ?></dd>

                  </dl>
                  <h5 class="mt-5 mb-3"><strong>Payment Term</strong></h5>
                  <?php
                  $paymentTerm = explode(';', $quotationData['paymentTerm']);
                  foreach ($paymentTerm as  $value) {
                    $paymentValue[] = explode(":", $value);
                  }
                  ?>
                  <table id="example1" class="table table-bordered table-striped">
                    <tbody id="myTable">
                      <tr>
                        <?php
                        foreach ($paymentValue as $key => $value) { ?>
                          <td><?= $value[0] . "%" . " " . $value[1] . " = " . $value[2];  ?></td>
                        <?php  }
                        ?>
                      </tr>
                    </tbody>
                  </table>

                  <h5 class="mt-5 mb-3"><strong>Bills of Materials</strong></h5>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Specification</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Warranty</th>
                        <th scope="col">Price</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php
                      $rowNo = 1;
                      foreach ($quotationData['bom'] as  $value) { ?>
                        <tr>
                          <td><?= $rowNo++; ?></td>
                          <td><?= $value['name'] ?></td>
                          <td><?= $value['spec'] ?></td>
                          <td><?= $value['quantity'] ?></td>
                          <td><?= $value['warranty'] ?></td>
                          <td><?= $value['quantity'] * $value['cost'] ?></td>
                        </tr>
                      <?php  }
                      ?>
                    </tbody>
                  </table>
                <?php
                }
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'common/footer.php'; ?>