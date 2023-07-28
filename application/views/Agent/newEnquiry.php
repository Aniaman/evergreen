<?php
$this->load->library('session');
$Agid = $this->session->agent_id;
?>
<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Self Enquiry</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Self-Enquiry'); ?>

        <div class="row">
          <div class="col-sm-4">
            <!-- text input -->
            <div class="form-group">
              <label>Full Name</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'cname', 'placeholder' => 'Enter Your Full Name', 'required' => 'required']); ?>
            </div>
            <?php echo form_error('cname', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Phone Number</label>
              <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'name' => 'phone', 'placeholder' => 'Enter Your Contact Number', 'required' => 'required']); ?>
            </div>
            <?php echo form_error('phone', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Email</label>
              <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'email', 'placeholder' => 'Enter Your Email Id', 'required' => 'required']); ?>
            </div>
            <?php echo form_error('email', "<div class='text-danger'>", "</div>"); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <!-- textarea -->
            <div class="form-group">
              <strong><label>Billing Address</label></strong>
              <div class="form-group">
                <label>Location 1</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'Blocation', 'name' => 'location', 'placeholder' => 'Enter Your Location', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('location', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>Location 2</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'Blocation2', 'name' => 'location1', 'placeholder' => 'Enter Your Location']); ?>
              </div>
              <?php echo form_error('location1', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>State</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'Bstate', 'name' => 'state', 'placeholder' => 'Enter Your State', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('state', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>Pin</label>
                <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'id' => 'Bpin', 'name' => 'pin', 'placeholder' => 'Enter Your Pin Code', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('pin', "<div class='text-danger'>", "</div>"); ?>
            </div>
          </div>
          <div class="col-sm-6">
            <?php echo form_input(['type' => 'checkbox', 'id' => 'same', 'name' => 'same', 'onchange' => 'addressFunction()']); ?>
            <strong><label for="same">
                If same as Billing Address select this box.
              </label></strong>
            <!-- textarea -->
            <div class="form-group">
              <strong><label>Shipping Address</label></strong>
              <div class="form-group">
                <label>Location 1</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'slocation', 'name' => 'shiplocation', 'placeholder' => 'Enter Your Location', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('shiplocation', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>Location 2</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'slocation2', 'name' => 'shiplocation1', 'placeholder' => 'Enter Your Location']); ?>
              </div>
              <?php echo form_error('shiplocation1', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>State</label>
                <?php echo form_input(['class' => 'form-control', 'id' => 'sstate', 'name' => 'shipstate', 'placeholder' => 'Enter Your State', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('shipstate', "<div class='text-danger'>", "</div>"); ?>
              <div class="form-group">
                <label>Pin</label>
                <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'id' => 'spin', 'name' => 'shippin', 'placeholder' => 'Enter Your Pin Code', 'required' => 'required']); ?>
              </div>
              <?php echo form_error('shippin', "<div class='text-danger'>", "</div>"); ?>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
              <label>GST NO</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'gst', 'placeholder' => 'Enter Your GST Number']); ?>
            </div>
            <?php echo form_error('gst', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Category</label>
              <?php
              $options = array(
                'SelectGrid'     => 'Select Grid',
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
            <?php echo form_error('grid', "<div class='text-danger'>", "</div>"); ?>
          </div>

          <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
              <label>HP/KW/WP/NOS</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'kw', 'placeholder' => 'Enter The HP/KW/WP/NOS', 'id' => 'kw']); ?>
            </div>
          </div>
          <?php echo form_error('kw', "<div class='text-danger'>", "</div>"); ?>

          <div class="col-sm-3">
            <div class="form-group">
              <label>Unit</label>
              <?php
              $options = array(
                'Selectunit'     => 'Select Unit',
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
            <?php echo form_error('grid', "<div class='text-danger'>", "</div>"); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label>Quantity</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'qty', 'value' => '1']); ?>
            </div>
            <?php echo form_error('qty', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Remark</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'remark', 'placeholder' => 'Enter Extra Information']); ?>

            </div>
            <?php echo form_error('grid', "<div class='text-danger'>", "</div>"); ?>
          </div>
          <input type="hidden" name="AgentId" value="<?= $Agid ?>">
        </div>
        <div class="row">
          <div class=" col-sm-4">
            <!-- text input -->
            <div class="form-group">
              <?php echo form_submit(['class' => 'btn btn-block btn-primary', 'type' => 'submit', 'value' => 'Send']); ?>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">

              <?php echo form_reset(['class' => 'btn btn-block btn-primary ', 'type' => 'reset', 'value' => 'Reset']); ?>
            </div>
          </div>

          <?php echo form_close(); ?>


        </div>


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


<div class="content-wrapper">
  <!-- Main content -->
  <div class="card">
    <div class="card-header">
      <strong>
        <h3 class="card-title">Enquiry List</h3>
      </strong>
      <div class="flex-container float-right">
        <div class="row">
          <form>
            <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
          </form>
          <button type="button" class="btn btn-info ml-3" data-toggle="modal" data-target="#modal-default">
            Add Self Enquiry
          </button>
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
    <?php if ($error = $this->session->flashdata('Message')) { ?>
      <div class="row">
        <div class="alert alert-success">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <?php if ($error = $this->session->flashdata('Success')) { ?>
      <div class="row">
        <div class="alert alert-success">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <?php if ($error = $this->session->flashdata('fail')) { ?>
      <div class="row">
        <div class="alert alert-success">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead class="text-center">
          <tr>
            <th>SL No</th>
            <th>Enquiry Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Billing Address</th>
            <th>Shipping Address</th>
            <th>Quantity</th>
            <th>Grid</th>
            <th>KW</th>
            <th>Unit</th>
            <th>Remark</th>
            <th>Created Date</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            foreach ($details as $value) { ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $value['EnqId']; ?></td>
            <td><?php echo $value['cName']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['billAddress1'] . "," . $value['billAddress2'] . "," . $value['billstate'] . "," . $value['billPin']; ?></td>
            <td><?php echo $value['shipAddress1'] . "," . $value['shipAddress2'] . "," . $value['shipState'] . "," . $value['shipPin']; ?></td>
            <td><?php echo $value['quantity']; ?></td>
            <td><?php echo $value['Grid']; ?></td>
            <td><?php echo $value['KW']; ?></td>
            <td><?php echo $value['unit']; ?></td>
            <td><?php echo $value['remark']; ?></td>
            <td><?php echo $value['created_at'] != "" ? date_format(date_create($value['created_at']), 'd-m-Y')  : ""; ?></td>
            <td>
              <?php
              if ($value['AgentId'] == "") {
                echo form_open('Agent/AcceptEnq');
                echo form_hidden('id', $value['id']);
                echo form_hidden('Agid', $Agid);
                echo form_submit(['name' => 'update', 'value' => 'Accept', 'class' => 'btn btn-success']);
                echo form_close();
              } else {
                $this->session->set_flashdata('Message', 'Enquiry Already accepted by another Agent.');
                return redirect('Agent/newenquiry');
              }
              ?>
            </td>
          </tr>
        <?php $s++;
            }


        ?>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
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
        $("#unit").val("WP");
      } else if (grid == 'SOLAR WATER HEATER') {
        $("#unit").val("LPD");
      }
    });

  })

  $(document).ready(function() {
    $('.view_data').click(function() {
      var kw = document.getElementById("kw").value;
      var grid = document.getElementById("grid").value;
      $.ajax({

        url: '<?php echo site_url("/login/approx"); ?>',
        method: 'post',
        data: {
          kw: kw,
          grid: grid
        },
        dataType: 'json',
        success: function(data) {
          $('#employee_detail').html(data);
          $('#exampleModal').modal("show");


        }
      });
    });
  });
</script>
<?php include 'footer.php'; ?>