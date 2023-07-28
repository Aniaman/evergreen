<?php include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php include 'navigation.php'; ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<div class="content-wrapper">
    <!-- Main content -->
    <?php echo form_open('Admin/action') ;?>
     <div class="card">
              <div class="card-header">
                <strong><h3 class="card-title">Enquiry List</h3></strong>
                 <div class="row">
                  <div  style="padding-left: 75%;">
                    <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
                  </div>
                </div>
                  
                
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  	<th>SL No</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Billing Address</th>
                    <th>Shipping Address</th>
                    <th>GST No</th>
                  </tr>
                  </thead>
                  <tbody id="myTable">
                  <tr>
                  	<?php 
                  	$s=1;
				foreach ($enquiry as $value) { ?>
					<tr>
						<td><?php echo $s; ?></td>
					<td><?php echo $value['cName']; ?></td>
					<td><?php echo $value['phone']; ?></td>
					<td><?php echo $value['email']; ?></td>
					<td><?php echo $value['billAddress1'].",".$value['billAddress2'].",".$value['billstate'].",".$value['billPin'];?></td>
					<td><?php echo $value['shipAddress1'].",".$value['shipAddress2'].",".$value['shipState'].",".$value['shipPin']; ?></td>
					<td><?php echo $value['Gst']; ?></td>
					</tr>
				<?php $s++;}


				 ?>
                  </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div  style="padding-left: 90%;padding-top: 20px;">
                    <?php echo form_submit(['class' =>'btn btn-block btn-primary','type'=>'submit','value'=>'Export']);?>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example1').DataTable({
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