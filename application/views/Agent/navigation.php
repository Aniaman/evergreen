<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('Dashboard'); ?>" class="brand-link">
    <img src="<?php echo base_url('dist/img/evergreen-solar-2.png'); ?>" alt="EverGreen Solar" class="brand-image">
    <span class="brand-text font-weight-light">EverGreen Solar</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url('dist/img/evergreen-solar-2.png'); ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <?php
        $this->load->library('session');
        $id = $this->session->agent_id;
        $name = $this->session->firstName;
        //$lname = $this->session->userdata('LastName');
        ?>
        <a href="<?php echo base_url('Dashboard'); ?>" class="d-block"><?php echo $name; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview ">
          <a href="<?php echo base_url('Dashboard'); ?>" class="nav-link active">
            <p>
              Dashboard
            </p>
          </a>
        </li><!-- 
          <li class="nav-item">
            <a href="<?php //echo base_url('ProductDetails.php'); 
                      ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Product Management
              </p>
            </a>
          </li> -->
        <li class="nav-item has-treeview">
          <a href="<?php echo base_url('Agent/newenquiry'); ?>" class="nav-link">

            <p>
              Enquiry
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('New-Enquiry'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>New Enquiry</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url("All-Enquiry"); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Enquiry </p>
              </a>
            </li>
            <!--<li class="nav-item">
                <a href="<?php //echo base_url('Admin/UnitDetails'); 
                          ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approximate Price </p>
                </a>
              </li>--->
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: void(0);" class="nav-link">
            <p>
              Quotation
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url("Generate-Quotation"); ?>" class="nav-link" target="_blank">
                <i class="far fa-circle nav-icon"></i>
                <p>Generate Quotation</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url("Agent/allquotationlist/{$id}"); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quotation List</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="javascript: void(0);" class="nav-link">
            <p>
              Project
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url("Project-Lists"); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project List</p>
              </a>
            </li>

          </ul>
        </li>
        <!-- <li class="nav-item">
            <a href="<?php echo base_url('Admin/quotation'); ?>" class="nav-link">
              <p>
                Quotation Details
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Admin/enquiry'); ?>" class="nav-link">
              <p>
                Enquiry Details
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Admin/kw'); ?>" class="nav-link">
              <p>
                KW Price
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Admin/customer'); ?>" class="nav-link">
              <p>
                Customer Details
              </p>
            </a>
          </li> -->

        <li class="nav-item">
          <a href="<?php echo base_url('Logout'); ?>" class="nav-link">
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>