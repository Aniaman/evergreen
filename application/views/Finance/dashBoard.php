<?php
include 'common/header.php';
include 'navigation.php';
?>
<div class="modal fade bd-example-modal-xl" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Payment Received</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="modal-closes" aria-label="Close"></button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <?= form_open('Payment-Received') ?>
            <div class="mb-3">
              <label class="form-label" for="username">Project No</label>
              <input type="text" class="form-control" id="projectNo" name="projectId" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label" for="username">Project Name</label>
              <input type="text" class="form-control" id="projectName" name="projectName" readonly>
              <input type="hidden" class="form-control" id="email" name="email" readonly>
              <input type="hidden" class="form-control" id="cName" name="cName" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label" for="username">Date Of Payment</label>
              <input type="date" class="form-control" name="paymentDate">
            </div>
            <div class="mb-3">
              <label class="form-label" for="username">Amount Received</label>
              <input type="text" class="form-control" name="paymentAmount" required autocomplete="off">
            </div>
          </div><!--end card-body-->
        </div>
      </div><!--end modal-body-->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-md">Save</button>
        <button type="button" class="btn btn-soft-secondary btn-md" id="modal-close" data-bs-dismiss="modal">Close</button>
      </div><!--end modal-footer-->
      <?= form_close(); ?>
    </div><!--end modal-content-->
  </div><!--end modal-dialog-->
</div>

<div class="modal fade bd-example-modal-xl" id="view-payment-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Payment Received</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="modal-payment-closes" aria-label="Close"></button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive-sm">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th scope="col">Project No</th>
                    <th scope="col">Paid Amount</th>
                    <th scope="col">Payment Date</th>
                  </tr>
                </thead>
                <tbody id="paymentTerm">
                </tbody>
              </table>
            </div>

          </div><!--end card-body-->
        </div>
      </div><!--end modal-body-->
      <div class="modal-footer">
        <button type="button" class="btn btn-soft-secondary btn-md" id="modal-payment-close" data-bs-dismiss="modal">Close</button>
      </div><!--end modal-footer-->
      <?= form_close(); ?>
    </div><!--end modal-content-->
  </div><!--end modal-dialog-->
</div>

<div class="modal fade bd-example-modal-lg" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Upload Customer Document</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="upload-modal-closes" aria-label="Close"></button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <?= form_open('Document-Received', 'enctype="multipart/form-data"') ?>
            <div class="mb-3">
              <label class="form-label" for="username">Project No</label>
              <input type="text" class="form-control" id="projectId" name="projectId" readonly>
            </div>

            <div class="mb-3">
              <label class="form-label" for="username">Document Type</label>
              <select name="documentType" class="form-control" id="documentType">

              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="username">Select Document (PDF only) </label>
              <input type="file" class="form-control" name="document" required>
            </div>
          </div><!--end card-body-->
        </div>
      </div><!--end modal-body-->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-md">Save</button>
        <button type="button" class="btn btn-soft-secondary btn-md" id="upload-modal-close" data-bs-dismiss="modal">Close</button>
      </div><!--end modal-footer-->
      <?= form_close(); ?>
    </div><!--end modal-content-->
  </div><!--end modal-dialog-->
</div>


<div class="modal fade bd-example-modal-xl" id="document-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Customer Document</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="document-closes" aria-label="Close"></button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive-sm">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project No</th>
                    <th scope="col">Document Name</th>
                    <th scope="col">Action</button></th>
                  </tr>
                </thead>
                <tbody id="customerDocument">
                </tbody>
              </table>
            </div>

          </div><!--end card-body-->
        </div>
      </div><!--end modal-body-->
      <div class="modal-footer">
        <button type="button" class="btn btn-soft-secondary btn-md" id="document-close" data-bs-dismiss="modal">Close</button>
      </div><!--end modal-footer-->
      <?= form_close(); ?>
    </div><!--end modal-content-->
  </div><!--end modal-dialog-->
</div>

<?php if ($error = $this->session->flashdata('success')) { ?>
  <div class="alert alert-success border-0" role="alert">
    <?php echo $error; ?>
  </div>
<?php }
if ($error = $this->session->flashdata('fail')) { ?>
  <div class="alert alert-danger border-0" role="alert">
    <?php echo $error; ?>
  </div>
<?php } ?>
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
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Customer Phone</th>
                <th scope="col">Project Name</th>
                <th scope="col">Project DeadLine</th>
                <th scope="col">Project cost</th>
                <th scope="col">Amount Paid</th>
                <th scope="col">Amount Due</th>
                <th scope="col">Status</th>
                <th scope="col" colspan="4">Action</th>
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
                  $id = $value['projectId'];
                  $projectId = str_replace("/", " ", $value['projectId']);
                  if (!empty($value['EnquiryData'])) {
                    $projectName = $value['EnquiryData']['KW'] . " " . $value['EnquiryData']['unit'] . " " . $value['EnquiryData']['Grid'];
                  }
              ?>
                  <tr class="<?= $tableClass; ?>">
                    <th scope="row"><?= $rowNo++; ?></th>
                    <td class=""><?= $value['projectId'];  ?></td>
                    <td class=""><a href="<?= base_url('Quotation-Details?id=') . base64_encode($value['quotationId']);  ?>"> <?= $value['quotationId']  ?></a></td>
                    <td class=""><?= $value['EnquiryData'] != "" ? $value['EnquiryData']['cName'] : "" ?></td>
                    <td class=""><?= $value['EnquiryData'] != "" ? $value['EnquiryData']['email'] : "" ?></td>
                    <td class=""><?= $value['EnquiryData'] != "" ? $value['EnquiryData']['phone'] : ""  ?></td>
                    <td class=""><?= $projectName;  ?></td>
                    <td class=""> <?= date_format(date_create($value['projectDeadLine']), 'd-m-Y')  ?></td>


                    <td class=""><?= number_format($value['quotationData']['NetAmount'], 2); ?></td>


                    <td class=""> <?= $value['amountPaid']['paidAmount'] != "" ? $value['amountPaid']['paidAmount'] : 0; ?></td>


                    <td class=""><?= $value['amountPaid']['paidAmount'] != "" ? number_format(($value['quotationData']['NetAmount']) - $value['amountPaid']['paidAmount'], 2) : number_format($value['quotationData']['NetAmount'], 2); ?></td>

                    <td class=""><?= $value['Status']  ?></td>
                    <td><a class="view_payment_details" payId="<?= $id; ?>"><i class="fas fa-long-arrow-alt-right"></i></a></td>
                    <?php if (!empty($value['EnquiryData'])) { ?>
                      <td><a class="view_details" cName="<?= $value['EnquiryData'] != "" ? $value['EnquiryData']['cName'] : ""  ?>" email="<?= $value['EnquiryData'] != "" ? $value['EnquiryData']['email'] : ""  ?>" projectName="<?= $projectName; ?>" reId="<?= $id; ?>"><i class="fas fa-pencil-alt"></i></a></td>
                    <?php } else { ?> <td disabled><i class="fas fa-pencil-alt"></i></td> <?php } ?>
                    <td><a class="upload_document" reId="<?= $id; ?>"><i class="fas fa-upload"></i></a></td>
                    <td><a class="document_view" projectId="<?= $id; ?>"><i class="fa fa-eye"></i></a></td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('.view_details').click(function() {
      var projectId = $(this).attr('reId');
      var projectName = $(this).attr('projectName');
      var email = $(this).attr('email');
      var cName = $(this).attr('cName');
      document.getElementById('projectNo').setAttribute(`value`, `${projectId}`);
      document.getElementById('projectName').setAttribute(`value`, `${projectName}`);
      document.getElementById('email').setAttribute(`value`, `${email}`);
      document.getElementById('cName').setAttribute(`value`, `${cName}`);
      document.getElementById('view-modal').setAttribute(`style`, `display:block`);
      document.getElementById('view-modal').classList.add('show')
    })
  })
  $(document).ready(function() {
    $('#modal-close').click(function() {
      document.getElementById('view-modal').setAttribute(`style`, `display:none`);
    })
  })
  $(document).ready(function() {
    $('#modal-closes').click(function() {
      document.getElementById('view-modal').setAttribute(`style`, `display:none`);
    })
  })

  $(document).ready(function() {
    $('.view_payment_details').click(function() {
      var projectId = $(this).attr('payId');
      $.ajax({
        url: "<?php echo base_url(); ?>Finance/getPaymentDataByProject",
        data: {
          're_id': projectId
        },
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          let paymentTermData = '';
          response.data.map((e) => {
            paymentTermData = paymentTermData + `<tr class="table-success">
                      <td>${e.projectId}</td>
                      <td>${e.paymentAmount}</td>
                      <td>${new Date(e.paymentDate).toLocaleDateString('en-GB')}</td></tr>`;
            console.log(paymentTermData);

          });
          $('#paymentTerm').html(paymentTermData);
        }
      });
      document.getElementById('view-payment-modal').setAttribute(`style`, `display:block`);
      document.getElementById('view-payment-modal').classList.add('show')
    });
  });

  $(document).ready(function() {
    $('#modal-payment-close').click(function() {
      document.getElementById('view-payment-modal').setAttribute(`style`, `display:none`);
      $('#paymentTerm').html("");
    })
  });

  $(document).ready(function() {
    $('#modal-payment-closes').click(function() {
      document.getElementById('view-payment-modal').setAttribute(`style`, `display:none`);
      $('#paymentTerm').html("");
    })
  })



  $(document).ready(function() {
    $('.upload_document').click(function() {
      var projectId = $(this).attr('reId');
      document.getElementById('projectId').setAttribute(`value`, `${projectId}`);
      $.ajax({
        url: "<?php echo base_url(); ?>Finance/getDocumentType",
        data: {},
        method: 'GET',
        dataType: 'json',
        error: function(request, error) {
          alert(" Can't do because: " + error);
        },
        success: function(response) {
          let paymentTermData = '<option value="">------- Select Document ---------</option>';
          response.data.map((e) => {
            paymentTermData = paymentTermData + ` 
            
            <option value="${e.document_id}">${e.documentName}</option>`
          });
          $('#documentType').html(paymentTermData);
        }

      });
      document.getElementById('upload-modal').setAttribute(`style`, `display:block`);
      document.getElementById('upload-modal').classList.add('show')
      $('#paymentTerm').html("");
    });
  });
  $(document).ready(function() {
    $('#upload-modal-close').click(function() {
      document.getElementById('upload-modal').setAttribute(`style`, `display:none`);
    })
  });
  $(document).ready(function() {
    $('#upload-modal-closes').click(function() {
      document.getElementById('upload-modal').setAttribute(`style`, `display:none`);
    })
  })



  $(document).ready(function() {
    $('.document_view').click(function() {
      var projectId = $(this).attr('projectId');
      let i = 1;
      document.getElementById('projectId').setAttribute(`value`, `${projectId}`);
      $.ajax({
        url: "<?php echo base_url(); ?>Finance/getDocumentData",
        data: {
          'id': projectId
        },
        method: 'GET',
        dataType: 'json',
        error: function(request, error) {
          console.log(request);

          alert(" Can't do because: " + error);
        },
        success: function(response) {
          console.log(response.data);
          if (response.data != "") {
            let paymentTermData = '';
            response.data.map((e) => {
              paymentTermData = paymentTermData + `<tr class="table-success">
                      <td>${i++}</td>
                      <td>${e.projectId}</td>
                      <td>${e.documentName}</td>
                      <td><a href="<?= base_url('assets/images/customerDocument/'); ?>${e.document}" target ="_blank"><i class="fa fa-eye"></a></td>
                      </tr>`;
              console.log(paymentTermData);
            });
            $('#customerDocument').html(paymentTermData);
          }
        }

      });
      document.getElementById('document-modal').setAttribute(`style`, `display:block`);
      document.getElementById('document-modal').classList.add('show')

    });
  });



  $(document).ready(function() {
    $('#document-close').click(function() {
      document.getElementById('document-modal').setAttribute(`style`, `display:none`);
      $('#customerDocument').html("");
    })
  });




  $(document).ready(function() {
    $('#document-closes').click(function() {
      document.getElementById('document-modal').setAttribute(`style`, `display:none`);
      $('#customerDocument').html("");
    })
  })
</script>
<?php
include 'common/footer.php'; ?>