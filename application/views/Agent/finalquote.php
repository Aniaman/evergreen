<?php include 'header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
  function updateitem(obj, rowid) {
    $.get("<?php echo site_url('Agent/updateitem/'); ?>", {
      rowid: rowid,
      qty: obj.value
    }, function(resp) {
      if (resp == 'ok') {
        location.reload();
      } else {
        alert('Item update failed,Please try again.');
      }
    });
  }
  $(document).ready(function() {
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

<div class="modal fade" id="modal-term">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Payment Terms</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('PaymentTerm-Add-Action'); ?>
        <div class="card-body table-responsive ">
          <table class="table table-bordered">
            <!-- <table class="table table-head-fixed text-nowrap"> -->
            <thead class="text-center">
              <tr>
                <th></th>
                <th>Sl No</th>
                <th>Payment Percent</th>
                <th>Payment Term Description</th>
                <th>Payment Term Sequence</th>
              </tr>
            </thead>
            <tbody id="paymentTerm">

            </tbody>
          </table>
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
</div>
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
    </li>
    <li class="nav-item d-none d-sm-inline-block ">
      <a href="<?php echo site_url('Agent/dashboard'); ?>" class="btn btn-success">Dashboard</a>
    </li>
  </ul>
</nav>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-info mt-3">
          <div class="card-header">
            <?php if ($error = $this->session->flashdata('add')) { ?>
              <div class="row">
                <div class="alert alert-success">
                  <?php echo $error; ?>
                </div>
              </div>
            <?php } ?>
            <?php if ($error = $this->session->flashdata('payment')) { ?>
              <div class="row">
                <div class="alert alert-success">
                  <?php echo $error; ?>
                </div>
              </div>
            <?php } ?>
            <?php if ($error = $this->session->flashdata('error')) { ?>
              <div class="row">
                <div class="alert alert-success">
                  <?php echo $error; ?>
                </div>
              </div>
            <?php } ?>
            <h3 class="card-title">Quotation Details</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 300px;">
                <input type="text" name="table_search" id="myInput" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <!-- <table class="table table-head-fixed text-nowrap"> -->
              <thead class="text-center">
                <tr>
                  <th>Sl No</th>
                  <th>Category</th>
                  <th>Material Name</th>
                  <th>Maker/Supplier</th>
                  <th>Specification</th>
                  <th>UOM</th>
                  <th width="10%">Quantity</th>
                  <th>Rate</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="myTable">
                <tr>
                  <?php
                  $s = 1;
                  $this->load->library('cart');
                  //$data=$this->cart->contents();
                  if ($this->cart->total_items() > 0) {
                    foreach ($this->cart->contents() as $value) { ?>
                <tr>
                  <td><?php echo $s; ?></td>
                  <td><?php echo $value['category']; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['supplier']; ?></td>
                  <td><?php echo $value['spec']; ?></td>
                  <td><?php echo $value['uom']; ?></td>
                  <td><input type="number" value="<?php echo $value['qty']; ?>" class="form-control text-center" onchange="updateitem(this,'<?php echo $value['rowid']; ?>')"> </td>
                  <td><?php echo $value['price']; ?></td>
                  <td><?php echo $value['subtotal']; ?></td>
                  <td><a href="<?php echo site_url('Agent/removeitem/' . $value["rowid"]); ?>" class="btn btn-danger" onclick="return confirm('Are you Sure')">Cancel</a></td>
                  <!-- <td><a href="<?php //echo base_url('Agent/updateitem/'.$value["rowid"]);
                                    ?>" class="btn btn-danger" onclick="return confirm('Are you Sure')"><i class="glyphicon glyphicon-trash"></i></a></td>  -->
                </tr>
              <?php $s++;
                    }
                  } else {
              ?>
              <td colspan="3" rowspan="" headers="">No Data Available....</td>
            <?php
                  }

            ?>
            </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td style=" white-space: nowrap;"><a href="<?php echo site_url('Agent/geneQuote'); ?>" class="btn btn-warning"><strong> Add Product</strong></a></td>
                  <?php echo form_open("Agent/quotation"); ?>
                  <td colspan="3">Extra Commission :<?php echo form_input(['type' => 'text', 'id' => 'commission', 'name' => 'comm', 'value' => '0']); ?><?php echo form_submit(['class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'Update']); ?></td>
                  </form>
                  <?php
                  $commi = $this->session->Commission;
                  $rateAmt = $this->session->rateAmt;
                  if (!empty($commi)) {
                  ?>

                    <td colspan="1" class=""><strong>Commission : <?php echo 'Rs ' . number_format($rateAmt, 2) . '\-'; ?></strong></td>
                    <td colspan="2" class=""><strong>Grand Total : <?php echo 'Rs ' . number_format($commi, 2) . '\-'; ?></strong></td>
                  <?php
                  } else {
                  ?>
                    <td colspan="2"><strong>Grand Total : <?php echo 'Rs ' . $this->cart->total() . '\-'; ?></strong></td>
                  <?php
                  }
                  ?>
                  <td style=" white-space: nowrap;"><button class="btn btn-primary view_detail">Add Payment Term</button></td>
                  <td style=" white-space: nowrap;"><a href="<?php echo site_url('Agent/quotation'); ?>" class="btn btn-success float-right"><strong> Continue To Quotation</strong></a></td>
                </tr>
              </tfoot>
            </table>

            <div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12" style="padding-top: 20px;">



                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>


      </div>


    </div>
</section>


<script>
  $(document).ready(function() {
    $('.view_detail').click(function() {
      $.ajax({
        url: "<?php echo base_url(); ?>Agent/paymentTermList",
        data: {},
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          var i = 1;
          let paymentTermData = ""
          response.data.map((e) => {
            paymentTermData = paymentTermData + `<tr> <td><input type="checkbox" name="paymentTermId[]" value ="${e.id}"></td>
                      <td>${i++}</td>
                      <td>${e.paymentPercent}</td>
                      <td>${e.paymentTermDescription}</td>
                      <td>${e.sequence}</td></tr>`;
            console.log(paymentTermData);

          });
          $('#paymentTerm').html(paymentTermData);
        }
      });
      $('#modal-term').modal({
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
</script>
<?php include 'footer.php' ?>