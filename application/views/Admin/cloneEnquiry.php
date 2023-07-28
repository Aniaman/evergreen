<?php include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php include 'navigation.php'; ?>

<div class=" col-md-8  mx-auto mt-5">
  <!-- general form elements disabled -->
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title"><?= $buttonAction == 0 ? "Clone Enquiry" : "Edit Enquiry" ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php echo form_open("Clone"); ?>
      <div class="row">
        <?php
        if ($buttonAction != 0) { ?>
          <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
              <label>Enquiry Id</label>
              <?php echo form_input(['class' => 'form-control', 'name' => 'enqId', 'value' => $enquiryData['EnqId']]); ?>
            </div>
            <?php echo form_error('enqId', "<div class='text-danger'>", "</div>"); ?>
          </div>
        <?php   }        ?>
        <div class="col-sm-3">
          <!-- text input -->
          <div class="form-group">
            <label>Full Name</label>
            <?php echo form_input(['class' => 'form-control', 'name' => 'cname', 'value' => $enquiryData['cName']]); ?>
          </div>
          <?php echo form_error('cname', "<div class='text-danger'>", "</div>"); ?>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Phone Number</label>
            <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'name' => 'phone', 'value' => $enquiryData['phone']]); ?>
          </div>
          <?php echo form_error('phone', "<div class='text-danger'>", "</div>"); ?>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Email</label>
            <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'email', 'value' => $enquiryData['email']]); ?>
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
              <?php echo form_input(['class' => 'form-control', 'id' => 'Blocation', 'name' => 'location', 'value' => $enquiryData['billAddress1']]); ?>
            </div>
            <?php echo form_error('location', "<div class='text-danger'>", "</div>"); ?>
            <div class="form-group">
              <label>Location 2</label>
              <?php echo form_input(['class' => 'form-control', 'id' => 'Blocation2', 'name' => 'location1', 'value' => $enquiryData['billAddress2']]); ?>
            </div>
            <?php echo form_error('location1', "<div class='text-danger'>", "</div>"); ?>
            <div class="form-group">
              <label>State</label>
              <?php echo form_input(['class' => 'form-control', 'id' => 'Bstate', 'name' => 'state', 'value' => $enquiryData['billstate']]); ?>
            </div>
            <?php echo form_error('state', "<div class='text-danger'>", "</div>"); ?>
            <div class="form-group">
              <label>Pin</label>
              <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'id' => 'Bpin', 'name' => 'pin', 'value' => $enquiryData['billPin']]); ?>
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
              <?php echo form_input(['class' => 'form-control', 'id' => 'slocation', 'name' => 'shiplocation', 'value' => $enquiryData['shipAddress1']]); ?>
            </div>
            <?php echo form_error('shiplocation', "<div class='text-danger'>", "</div>"); ?>
            <div class="form-group">
              <label>Location 2</label>
              <?php echo form_input(['class' => 'form-control', 'id' => 'slocation2', 'name' => 'shiplocation1', 'value' => $enquiryData['shipAddress2']]); ?>
            </div>
            <?php echo form_error('shiplocation1', "<div class='text-danger'>", "</div>"); ?>
            <div class="form-group">
              <label>State</label>
              <?php echo form_input(['class' => 'form-control', 'id' => 'sstate', 'name' => 'shipstate', 'value' => $enquiryData['shipState']]); ?>
            </div>
            <?php echo form_error('shipstate', "<div class='text-danger'>", "</div>"); ?>
            <div class="form-group">
              <label>Pin</label>
              <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'id' => 'spin', 'name' => 'shippin', 'value' => $enquiryData['shipPin']]); ?>
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
            <?php echo form_input(['class' => 'form-control', 'name' => 'gst', 'value' => $enquiryData['Gst']]); ?>
          </div>
          <?php echo form_error('gst', "<div class='text-danger'>", "</div>"); ?>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Category</label>
            <?php
            $options = array(
              $enquiryData['Grid']     => $enquiryData['Grid'],
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
            <?php echo form_input(['class' => 'form-control', 'name' => 'kw',  'value' => $enquiryData['KW'], 'id' => 'kw']); ?>
          </div>
        </div>
        <?php echo form_error('kw', "<div class='text-danger'>", "</div>"); ?>

        <div class="col-sm-3">
          <div class="form-group">
            <label>Unit</label>
            <?php
            $options = array(
              $enquiryData['unit']     => $enquiryData['unit'],
              'HP'          => 'HP',
              'KW'          => 'KW',
              'WP'          => 'WP',
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
        <div class="col-sm-4">
          <!-- text input -->
          <div class="form-group">
            <label>Quantity</label>
            <?php echo form_input(['class' => 'form-control', 'name' => 'qty',  'value' => $enquiryData['quantity']]); ?>
          </div>
          <?php echo form_error('qty', "<div class='text-danger'>", "</div>"); ?>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Remark</label>
            <?php echo form_input(['class' => 'form-control', 'name' => 'remark',  'value' => $enquiryData['remark']]); ?>

          </div>
          <?php echo form_error('grid', "<div class='text-danger'>", "</div>"); ?>
        </div>
        <?php if ($buttonAction == 0) { ?>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Agent</label>
              <select class="form-control" name="AgentId">
                <option value="">------Select Agent-----</option>
                <?php
                foreach ($agentData as $value) { ?>
                  <option value="<?= $value['id'] ?> "><?php echo $value['name'] ?></option>
                <?php  }
                ?>
              </select>

            </div>
            <?php echo form_error('grid', "<div class='text-danger'>", "</div>"); ?>
          </div>
        <?php } ?>


      </div>
      <div class="row">
        <div class=" col-sm-4">
          <!-- text input -->
          <div class="form-group">
            <input type="hidden" name="clone" , value="<?= $buttonAction ?>">
            <?php echo form_submit(['class' => 'btn btn-block btn-primary', 'type' => 'submit', 'value' => 'Save']); ?>
          </div>
        </div>
        <?php echo form_close(); ?>

      </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
</div>

<?php include 'footer.php'; ?>