<?php
include 'common/header.php';
include 'navigation.php';
?>

<div class="modal fade bd-example-modal-xl" id="bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Enquiry Form</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <?= form_open('Add-Enquiry-Action') ?>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="username">Full Name</label>
                  <input type="text" placeholder="Full Name" class="form-control" id="username" name="fullName" required="" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="phone">Phone No</label>
                  <input type="text" placeholder="Phone Number" class="form-control" id="phone" required="" name="phone" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="email">Email address</label>
                  <input type="email" placeholder="Email Id" class="form-control" id="email" required="" name="email" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mb-2">
                <h4 class="card-title">Billing Address</h4>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">Road Name / Area / Colony</label>
                  <input type="text" class="form-control" placeholder="Road Name / Area / Colony" id="Blocation" name="area" required="" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="phone">LandMark</label>
                  <input type="text" class="form-control" placeholder="LandMark" id="Blocation2" name="landMark" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">State</label>
                  <input type="text" class="form-control" id="Bstate" placeholder="State" required="" name="state" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">Pin Code</label>
                  <input type="text" class="form-control" id="Bpin" placeholder="Pin Code" required="" name="pinCode" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mb-2">
                <h4 class="card-title"><?php echo form_input(['type' => 'checkbox', 'id' => 'same', 'name' => 'same', 'onchange' => 'addressFunction()']); ?> Shipping Address (Click if Billing and Shipping address is same)</h4>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">Road Name / Area / Colony</label>
                  <input type="text" class="form-control" placeholder="Your Road Name / Area / Colony" id="slocation" name="shipArea" required="" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="phone">LandMark</label>
                  <input type="text" class="form-control" id="slocation2" placeholder="Shipping Landmark" name="shipLandMark" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">State</label>
                  <input type="text" class="form-control" id="sstate" required="" placeholder="Shipping State" name="shipState" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">Pin Code</label>
                  <input type="text" class="form-control" placeholder="Shipping Pin Code" id="spin" required="" name="shipPinCode" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">GST No</label>
                  <input type="text" class="form-control" placeholder="Your GST Number" name="gstNo" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="phone">Category</label>
                  <?php
                  $options = array(
                    ''     => '------Select Grid-------------',
                    'OFF GRID'          => 'OFF GRID',
                    'ON GRID'          => 'ON  GRID',
                    'HYBRID'          => 'HYBRID',
                    'PUMP'          => 'PUMP',
                    'STREET LIGHT'          => 'STREET LIGHT',
                    'SOLAR WATER HEATER'          => 'SOLAR WATER HEATER'
                  );
                  $css = array('class' => 'form-control', 'id' => 'grid');
                  echo form_dropdown('grid', $options, 'SelectGrid', $css);

                  ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">HP/KW/WP/NOS</label>
                  <input type="text" class="form-control" placeholder="HP/KW/WP/NOS" required="" name="kw" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">Unit</label>
                  <?php
                  $options = array(
                    ''     => '-------Select Unit---------',
                    'HP'          => 'HP',
                    'KW'          => 'KW',
                    'W'          => 'W',
                    'NOS'         => 'NOS',
                    'LPD'         => 'LPD'
                  );
                  $css = array('class' => 'form-control', 'id' => 'unit');
                  echo form_dropdown('unit', $options, 'Selectunit', $css);

                  ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="username">Quantity</label>
                  <input type="text" class="form-control" name="quantity" required="" autocomplete="off" placeholder="Quantity Required">
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="phone">Remark</label>
                  <input type="text" class="form-control" name="remark" autocomplete="off" placeholder="Extra Informations">
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="email">Commission Rate</label>
                  <input type="text" class="form-control" required="" name="commission" autocomplete="off" placeholder="Your Commission Rate">
                </div>
              </div>
            </div>
          </div><!--end card-body-->
        </div>
        <input type="hidden" name="agentId" value="<?= $this->session->sales_cod_id; ?>">
      </div><!--end modal-body-->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-md">Save</button>
        <button type="button" class="btn btn-soft-secondary btn-md" data-bs-dismiss="modal">Close</button>
      </div><!--end modal-footer-->
      <?= form_close(); ?>
    </div><!--end modal-content-->
  </div><!--end modal-dialog-->
</div>

<div class="modal fade bd-example-modal-xl" id="view-modal" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="myExtraLargeModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Enquiry Form</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="modal-close" aria-label="Close"></button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <?= form_open('Edit-Enquiry-Action') ?>
            <div class="row">
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">Reference Id</label>
                  <input type="text" placeholder="Reference Id" class="form-control" id="refId" name="p_enquiryId" required="" autocomplete="off" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">Full Name</label>
                  <input type="text" placeholder="Full Name" class="form-control" id="fullName" name="fullName" required="" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="phone">Phone No</label>
                  <input type="text" placeholder="Phone Number" class="form-control" id="phoneNo" required="" name="phone" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">Email address</label>
                  <input type="email" placeholder="Email Id" class="form-control" id="emailId" required="" name="email" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mb-2">
                <h4 class="card-title">Billing Address</h4>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">Road Name / Area / Colony</label>
                  <input type="text" class="form-control" placeholder="Road Name / Area / Colony" id="billLocation" name="area" required="" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="phone">LandMark</label>
                  <input type="text" class="form-control" placeholder="LandMark" id="billLandMark" name="landMark" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">State</label>
                  <input type="text" class="form-control" id="billState" placeholder="State" required="" name="state" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">Pin Code</label>
                  <input type="text" class="form-control" id="billPin" placeholder="Pin Code" required="" name="pinCode" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mb-2">
                <h4 class="card-title"><?php echo form_input(['type' => 'checkbox', 'id' => 'same', 'name' => 'same', 'onchange' => 'addressFunction()']); ?> Shipping Address (Click if Billing and Shipping address is same)</h4>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">Road Name / Area / Colony</label>
                  <input type="text" class="form-control" placeholder="Your Road Name / Area / Colony" id="shipLocation" name="shipArea" required="" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="phone">LandMark</label>
                  <input type="text" class="form-control" id="shipLandMark" placeholder="Shipping Landmark" name="shipLandMark" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">State</label>
                  <input type="text" class="form-control" id="shipState" required="" placeholder="Shipping State" name="shipState" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">Pin Code</label>
                  <input type="text" class="form-control" placeholder="Shipping Pin Code" id="shipPin" required="" name="shipPinCode" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">GST No</label>
                  <input type="text" class="form-control" id="gstNo" placeholder="Your GST Number" name="gstNo" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="phone">Category</label>
                  <select name="grid" id="gridData" class="form-control">

                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="email">HP/KW/WP/NOS</label>
                  <input type="text" class="form-control" id="kw" placeholder="HP/KW/WP/NOS" required="" name="kw" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-label" for="username">Unit</label>
                  <input type="text" class="form-control" id="unitData" placeholder="HP/KW/WP/NOS" required="" name="unit" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="username">Quantity</label>
                  <input type="text" class="form-control" name="quantity" id="quantity" required="" autocomplete="off" placeholder="Quantity Required">
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="phone">Remark</label>
                  <input type="text" class="form-control" required="" id="remark" name="remark" autocomplete="off" placeholder="Extra Informations">
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="email">Commission Rate</label>
                  <input type="text" class="form-control" required="" id="commission" name="commission" autocomplete="off" placeholder="Your Commission Rate">
                </div>
              </div>
            </div>
          </div><!--end card-body-->
        </div>
        <input type="hidden" name="agentId" value="<?= $this->session->agent_id; ?>">
      </div><!--end modal-body-->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-md">Save</button>
        <button type="button" class="btn btn-soft-secondary btn-md" id="modal-closes" data-bs-dismiss="modal">Close</button>
      </div><!--end modal-footer-->
      <?= form_close(); ?>
    </div><!--end modal-content-->
  </div><!--end modal-dialog-->
</div>


<!-- Page-Title -->
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <div class="row">
        <div class="col">
          <h3 class="page-title">Enquiry List</h3>
          <ol class="breadcrumb mt-2">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Enquiry List</a></li>
          </ol>
        </div><!--end col-->
        <div class="col-auto">
          <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bd-example-modal-xl"><i class="fas fa-plus me-2"></i>Add Enquiry</a>
        </div><!--end col-->
      </div><!--end row-->
    </div><!--end page-title-box-->
  </div><!--end col-->
</div><!--end row-->
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
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <div style="display: flex; ">
          <h3 class=" card-title">All Enquiry</h3>
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
                <th scope="col">Reference Id</th>
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
                <th scope="col">Commission Request</th>
                <th scope="col">Commission Approve</th>
                <th scope="col">Status</th>
                <th scope="col">Created Date</th>
                <th scope="col" colspan="4">Action</th>
              </tr>
            </thead>
            <tbody id="myTable">

              <?php

              if (sizeof($enquiryData) > 0) {
                $tableClass = "";
                $rowNo = 1;
                foreach ($enquiryData as $value) {
                  if ($value['status'] == 'In Process') {
                    $tableClass = 'table-primary';
                  } else if ($value['status'] == 'Approve') {
                    $tableClass = 'table-success';
                  } else if ($value['status'] == 'Reject') {
                    $tableClass = 'table-danger';
                  }
                  $id = $value['re_id'];
                  if ($value['status'] != 'Approve') {
              ?>
                    <tr class="<?= $tableClass; ?>">
                      <th scope="row"><?= $rowNo++; ?></th>
                      <td class=""><?= $value['p_enquiryId'];  ?></td>
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
                      <td class=""> <?= $value['commission']  ?></td>
                      <td class=""><?= $value['counterCommission'] != "" ? $value['counterCommission'] : 0  ?></td>
                      <td class=""> <?= $value['status']  ?></td>
                      <td class=""> <?= date_format(date_create($value['added_date']), 'd-m-Y')  ?></td>
                      <td><a href="<?= base_url("Accept-Offer/{$value['p_enquiryId']}") ?>"><i class="fas fa-check"></i></a></td>
                      <td><a class="view_detail" reId="<?= $id; ?>"><i class="fa fa-edit"></i></a></td>
                      <td><a href="<?= base_url("Delete-Enquiry/{$id}") ?>"><i class="fa fa-trash"></i></a></td>
                      <td><a class="counter" reId="<?= $id; ?>><i class=" fas fa-exchange-alt"></i></a></td>
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
    </div><!--end card-->
  </div><!--end col-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('.view_detail').click(function() {
      var enquiryId = $(this).attr('reId');
      var grid = "";
      $.ajax({
        url: "<?php echo base_url(); ?>SalesCoordination/getEnquiryDataById",
        data: {
          're_id': enquiryId
        },
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          var billingAddress = response.billingAddress.split(',');
          var shippingAddress = response.shippingAddress.split(',');
          document.getElementById('refId').setAttribute(`value`, `${response.p_enquiryId}`);
          document.getElementById('fullName').setAttribute(`value`, `${response.fullName}`);
          document.getElementById('phoneNo').setAttribute(`value`, `${response.phone}`);
          document.getElementById('emailId').setAttribute(`value`, `${response.email}`);
          document.getElementById('billLocation').setAttribute(`value`, `${billingAddress[0]}`);
          document.getElementById('billLandMark').setAttribute(`value`, `${billingAddress[1]}`);
          document.getElementById('billState').setAttribute(`value`, `${billingAddress[2]}`);
          document.getElementById('billPin').setAttribute(`value`, `${billingAddress[3]}`);
          document.getElementById('shipLocation').setAttribute(`value`, `${shippingAddress[0]}`);
          document.getElementById('shipLandMark').setAttribute(`value`, `${shippingAddress[1]}`);
          document.getElementById('shipState').setAttribute(`value`, `${shippingAddress[2]}`);
          document.getElementById('shipPin').setAttribute(`value`, `${shippingAddress[3]}`);
          document.getElementById('gstNo').setAttribute(`value`, `${response.gstNo}`);
          document.getElementById('kw').setAttribute(`value`, `${response.kw}`);
          document.getElementById('quantity').setAttribute(`value`, `${response.quantity}`);
          document.getElementById('remark').setAttribute(`value`, `${response.remark}`);
          document.getElementById('commission').setAttribute(`value`, `${response.commission}`);
          document.getElementById('unitData').setAttribute(`value`, `${response.unit}`);
          grid = `<option value="${response.grid}">${response.grid}</option>
          <option value="OFF GRID">OFF GRID</option>
          <option value="ON GRID">ON GRID</option>
          <option value="HYBRID">HYBRID</option>
          <option value="PUMP">PUMP</option>
          <option value="STREET LIGHT">STREET LIGHT</option>
          <option value="SOLAR WATER HEATER">SOLAR WATER HEATER</option>
          `;
          $('#gridData').html(grid);
          console.log(response);
        }
      });
      document.getElementById('view-modal').setAttribute(`style`, `display:block`);
      document.getElementById('view-modal').classList.add('show')
    });
  });
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

  function addressFunction() {
    if (document.getElementById(
        "same").checked) {
      document.getElementById(
          "slocation").value =
        document.getElementById(
          "Blocation").value;

      document.getElementById(
          "slocation2").value =
        document.getElementById(
          "Blocation2").value;

      document.getElementById(
          "sstate").value =
        document.getElementById(
          "Bstate").value;

      document.getElementById(
          "spin").value =
        document.getElementById(
          "Bpin").value;
    } else {
      document.getElementById(
        "slocation").value = "";
      document.getElementById(
        "slocation2").value = "";
      document.getElementById(
        "sstate").value = "";
    }
  }
  $(document).ready(function() {
    $("#grid").change(function() {
      var grid = this.value;

      if (grid == 'OFF GRID' || grid == 'ON GRID' || grid == 'HYBRID') {
        $("#unit").val("KW");
      } else if (grid == 'PUMP') {
        $("#unit").val("HP");
      } else if (grid == 'STREET LIGHT') {
        $("#unit").val("W");
      } else if (grid == 'SOLAR WATER HEATER') {
        $("#unit").val("LPD");
      }
    });

  })
  $(document).ready(function() {
    $("#gridData").change(function() {
      var grid = this.value;

      if (grid == 'OFF GRID' || grid == 'ON GRID' || grid == 'HYBRID') {
        $("#unitData").val("KW");
      } else if (grid == 'PUMP') {
        $("#unitData").val("HP");
      } else if (grid == 'STREET LIGHT') {
        $("#unitData").val("W");
      } else if (grid == 'SOLAR WATER HEATER') {
        $("#unitData").val("LPD");
      }
    });

  })

  $(document).ready(function() {
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<?php include 'common/footer.php'; ?>