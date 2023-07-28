<?php include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php include 'navigation.php'; ?>
<style type="text/css" media="screen">
	.abc{
		padding-left: 100px;
		padding-top: 50px;
	}
</style>
<!-- general form elements -->
<div class="content-wrapper">
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php if($error=$this->session->flashdata('update')){ ?>
                        <div class="row">                           
                            <div class="alert alert-success">
                            <?php echo $error; ?>
                        </div>
                    </div>
                    <?php } ?>
          <!-- left column -->
          <div class="col-md-10 abc">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Approximate Price Of KW</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open("Admin/updatekw//{$kw->id}") ;?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">KW</label>
                         <?php echo form_input(['class' =>'form-control','value'=>set_value('kw',$kw->kw),'name'=>'kw','placeholder'=>'Enter The KW']);?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                         <?php echo form_input(['class' =>'form-control','value'=>set_value('price',$kw->price),'name'=>'price','placeholder'=>'Enter The KW Price']);?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Grid</label>
                        <?php 
                            $options = array(
                                                'grid'     => $kw->grid,
                                                'On Grid'          => 'On Grid',
                                                'off Grid'          => 'Off Grid'
                                            );
                            $css=array('class'=>'form-control');
                            echo form_dropdown('grid', $options,'grid', $css);

                         ?>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" >
                	<div class="row"style="padding-left: 150px;">
                	<div class=" col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                      	<?php echo form_submit(['class' =>'btn btn-block btn-primary','type'=>'submit','value'=>'Submit']);?>
                      </div>
                    </div>
                    <div class="col-sm-4">         
                     <div class="form-group">
                      <?php echo form_reset(['class' =>'btn btn-block btn-primary ','type'=>'reset','value'=>'Reset']);?>
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