<?php include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php include 'navigation.php'; ?>
<style type="text/css" media="screen">
  .abc {
    padding-left: 100px;
    padding-top: 50px;
  }
</style>
<!-- general form elements -->
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10 abc">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Bills Of Materials</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php echo form_open("Admin/updateProduct/{$product->id}"); ?>
            <?php //echo form_hidden('productid',$product->id);
            ?>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Material Name</label>
                    <?php echo form_input(['class' => 'form-control', 'name' => 'name', 'placeholder' => 'Enter Material Name', 'value' => set_value('name', $product->name)]); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <select name="category" id="" class="form-control">
                      <option value="<?= $product->category ?>"><?= $product->category ?></option>
                      <?php
                      if (!empty($category)) {
                        foreach ($category as  $value) { ?>
                          <option value="<?= $value['categoryName'] ?>"><?= $value['categoryName'] ?></option>
                      <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">MAKE/SUPPLIER</label>
                <?php echo form_input(['class' => 'form-control', 'name' => 'supplier', 'placeholder' => 'Enter Supplier Name', 'value' => set_value('supplier', $product->supplier)]); ?>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Specification</label>
                <div class="input-group">
                  <?php echo form_input(['class' => 'form-control', 'name' => 'spec', 'placeholder' => 'Enter Specification', 'value' => set_value('spec', $product->spec)]); ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>UOM</label>
                    <?php echo form_input(['class' => 'form-control', 'name' => 'uom', 'placeholder' => 'Enter UOM', 'value' => set_value('uom', $product->uom)]); ?>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Quantity</label>
                    <?php echo form_input(['type' => 'number', 'class' => 'form-control', 'name' => 'qty', 'placeholder' => 'Enter Quantity', 'value' => '1', 'value' => set_value('qty', $product->qty)]); ?>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Price</label>
                    <?php echo form_input(['type' => 'text', 'class' => 'form-control', 'name' => 'price', 'placeholder' => 'Enter Material Price', 'value' => set_value('price', $product->price)]); ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="row" style="padding-left: 150px;">
                <div class=" col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <?php echo form_submit(['class' => 'btn btn-block btn-primary', 'type' => 'submit', 'value' => 'Submit']); ?>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <?php echo form_reset(['class' => 'btn btn-block btn-primary ', 'type' => 'reset', 'value' => 'Reset']); ?>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>