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
                if (!empty($projectData)) { ?>
                  <dl class="row">
                    <dt class="col-sm-4">Project No</dt>
                    <dd class="col-sm-8"><?= $projectData['projectId']; ?></dd>

                    <dt class="col-sm-4">Quotation No</dt>
                    <dd class="col-sm-8"><?= $projectData['quotationId']; ?></dd>

                    <dt class="col-sm-4">Customer Name</dt>
                    <dd class="col-sm-8"><?= $projectData['EnquiryData']['cName']; ?></dd>

                    <dt class="col-sm-4">Customer Email Id</dt>
                    <dd class="col-sm-8"><?= $projectData['EnquiryData']['email']; ?></dd>

                    <dt class="col-sm-4">Customer Phone No</dt>
                    <dd class="col-sm-8"><?= $projectData['EnquiryData']['phone']; ?></dd>

                    <dt class="col-sm-4">Billing Address</dt>
                    <dd class="col-sm-8"><?= $projectData['EnquiryData']['billAddress1'] . "," . $projectData['EnquiryData']['billAddress2'] . "," . $projectData['EnquiryData']['billstate'] . "," . $projectData['EnquiryData']['billPin']; ?></dd>

                    <dt class="col-sm-4">Shipping Address</dt>
                    <dd class="col-sm-8"><?= $projectData['EnquiryData']['shipAddress1'] . "," . $projectData['EnquiryData']['shipAddress2'] . "," . $projectData['EnquiryData']['shipState'] . "," . $projectData['EnquiryData']['shipPin']; ?></dd>

                    <dt class="col-sm-4">Requirement</dt>
                    <dd class="col-sm-8"><?= $projectData['EnquiryData']['KW'] . " " . $projectData['EnquiryData']['unit'] . " " . $projectData['EnquiryData']['Grid'] . " System"; ?></dd>

                    <dt class="col-sm-4">Quantity</dt>
                    <dd class="col-sm-8"><?= $projectData['EnquiryData']['quantity']; ?></dd>

                    <dt class="col-sm-4">Project DeadLine</dt>
                    <dd class="col-sm-8"><?= $projectData['projectDeadLine']; ?></dd>

                    <dt class="col-sm-4">Project Cost</dt>
                    <dd class="col-sm-8"><?= number_format($projectData['quotationData']['NetAmount'], 2); ?></dd>

                    <dt class="col-sm-4">Payment Received</dt>
                    <dd class="col-sm-8">
                      <?php
                      $paidAmount = 0;
                      if (!empty($projectData['amountPaid'])) {
                        foreach ($projectData['amountPaid'] as  $value) {
                          $paidAmount = $paidAmount + $value['paymentAmount'];
                        }
                      }
                      echo $paidAmount;
                      ?>
                    </dd>

                    <dt class="col-sm-4">Project Warranty</dt>
                    <dd class="col-sm-8"><?= $projectData['projectWarranty']; ?></dd>

                    <dt class="col-sm-4">Terms & Condition</dt>
                    <dd class="col-sm-8"><?= $projectData['quotationData']['termAndCondition']; ?></dd>

                  </dl>
                  <h5 class="mt-5 mb-3"><strong>Bills of Materials</strong></h5>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Specification</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Warranty</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php
                      $rowNo = 1;
                      foreach ($projectData['bom'] as  $value) { ?>
                        <tr>
                          <td><?= $rowNo++; ?></td>
                          <td><?= $value['name'] ?></td>
                          <td><?= $value['spec'] ?></td>
                          <td><?= $value['quantity'] ?></td>
                          <td><?= $value['warranty'] ?></td>
                        </tr>
                      <?php  }
                      ?>
                    </tbody>
                  </table>
                  <h5 class="mt-5 mb-3"><strong>Payment Term</strong></h5>
                  <?php
                  $paymentTerm = explode(';', $projectData['quotationData']['paymentTerm']);
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

                  <h5 class="mt-5 mb-3"><strong>Payment Details</strong></h5>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Payment Amount</th>
                        <th scope="col">Payment Date</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php
                      $rowNo = 1;
                      if (!empty($projectData['amountPaid'])) {
                        foreach ($projectData['amountPaid'] as  $value) { ?>
                          <tr>
                            <td><?= $rowNo++; ?></td>
                            <td><?= $value['paymentAmount'] ?></td>
                            <td><?= $value['paymentDate'] ?></td>
                          </tr>
                        <?php  }
                      } else { ?>
                        <tr>
                          <td colspan="3">No Payment Data</td>
                        </tr>
                      <?php }
                      ?>

                    </tbody>
                  </table>
                  <h5 class="mt-5 mb-3"><strong>Documents</strong></h5>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Document name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php
                      $rowNo = 1;
                      if (!empty($projectData['po'])) { ?>
                        <tr>
                          <td><?= $rowNo++; ?></td>
                          <td> Purchase Order </td>
                          <td><a href="<?= base_url() . 'assets/images/purchaseOrder/' . $projectData['po'] ?>" target="_blank"><i class="fa fa-eye"></a></td>
                        </tr>
                        <?php
                      }
                      if (!empty($projectData['document'])) {
                        foreach ($projectData['document'] as $key => $value) { ?>
                          <tr>
                            <td><?= $rowNo++; ?></td>
                            <td> <?= $value['documentName'] ?> </td>
                            <td><a href="<?= base_url() . 'assets/images/customerDocument/' . $value['document'] ?>" target="_blank"><i class="fa fa-eye"></a></td>
                          </tr>
                      <?php }
                      }
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