<?php include 'header.php'; ?>
<?php include 'topHeader.php'; ?>
<?php include 'navigation.php'; ?>
<title>EverGreen Solar</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style type="text/css" media="screen">
  .x{
    margin-top: 50px;
    margin-left: 25%;
  }
  
</style>
<body>

     <!-- right column -->
          <!-- <div class="col-md-10"> -->
          	<div class=" col-md-8 x">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Register As An Agent</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php echo form_open("Admin/updateAgent/{$Agent->id}") ;?>



                  <div class="row">

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Agent Id</label>
                         <?php echo form_input(['type'=>'text','class' =>'form-control','name'=>'id','value'=>set_value('AgentId',$Agent->AgentId),'required'=>'required','readonly'=>'readonly']);?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Full Name</label>
                         <?php echo form_input(['class' =>'form-control','name'=>'name','placeholder'=>'Enter Your Full Name','value'=>set_value('name',$Agent->name),'required'=>'required']);?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone Number</label>
                      <?php echo form_input(['type'=>'number','class' =>'form-control','name'=>'phone','placeholder'=>'Enter Your Contact Number','value'=>set_value('phone',$Agent->phone),'required'=>'required']);?>
                      </div>
                    </div>
                   <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email Id</label>
                        <?php echo form_input(['type'=>'text','class' =>'form-control','name'=>'email','placeholder'=>'Enter Your Email Id' ,'value'=>set_value('email',$Agent->email),'required'=>'required']);?>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Address</label>
                         <?php echo form_textarea(['class' =>'form-control','rows'=>'3' ,'name'=>'address','placeholder'=>'Enter Your Full Address','value'=>set_value('address',$Agent->address),'required'=>'required']);?>
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Password</label>
                         <?php echo form_Password(['class' =>'form-control','name'=>'password','placeholder'=>'Enter Your Password','value'=>set_value('password',$Agent->password),'required'=>'required']);?>
                      </div>
                    </div>
                  </div>



                  <div class="row">
                  </div>
                   <div class="row" style="padding-left: 80px;">
                    <div class=" col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                      	<?php echo form_submit(['class' =>'btn btn-block btn-primary','type'=>'submit','value'=>'Send']);?>
                      </div>
                    </div>
                    <div class="col-sm-4">         
                     <div class="form-group">
                      <?php echo form_reset(['class' =>'btn btn-block btn-primary ','type'=>'reset','value'=>'Reset']);?>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

<?php include 'footer.php'; ?>