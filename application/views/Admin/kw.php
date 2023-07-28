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
              <?php echo form_open('Admin/crtkw') ;?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">KW</label>
                         <?php echo form_input(['class' =>'form-control','name'=>'kw','placeholder'=>'Enter The KW']);?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                         <?php echo form_input(['class' =>'form-control','name'=>'price','placeholder'=>'Enter The KW Price']);?>
                  </div>
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
                            $css=array('class'=>'form-control');
                            echo form_dropdown('grid', $options,'SelectGrid', $css);

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
<div class="content-wrapper">
    <!-- Main content -->
     <div class="card">
              <div class="card-header">
                <strong><h3 class="card-title">KW List</h3></strong>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

<?php if($error=$this->session->flashdata('delete')){ ?>
                        <div class="row">                           
                            <div class="alert alert-success">
                            <?php echo $error; ?>
                        </div>
                    </div>
                    <?php } ?>
               
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">Sl No</th>
                    <th class="text-center">KW</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Grid</th>
                    <th colspan="2" class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  	<?php 
                  	$s=1;
				foreach ($details as $value) { ?>
					<tr>
						<td><?php echo $s; ?></td>
					<td><?php echo $value['kw']; ?></td>
					<td><?php echo $value['price']; ?></td>
          <td><?php echo $value['grid']; ?></td>
					<td>
         <?php 
            echo form_open('Admin/getkw');
           echo form_hidden('id',$value['id']);
            echo form_submit(['name'=>'update','value'=>'Edit','class'=>'btn btn-success']);
            echo form_close();
           ?>
         </td> 
          <td>
          <?php 
            echo form_open('Admin/deletekw');
            echo form_hidden('id',$value['id']);
            echo form_submit(['name'=>'delete','value'=>'Delete','class'=>'btn btn-danger ']);
            echo form_close();
           ?>
         </td>
					</tr>
				<?php $s++;}


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
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    </div>
    <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
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
<?php include 'footer.php'; ?>