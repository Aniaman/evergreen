<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
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
        $fname = $this->session->admin_data['FirstName'];
        $lname = $this->session->admin_data['LastName'];
        $role = $this->session->admin_data['adminType'];
        ?>
        <a href="#" class="d-block"><?php echo $fname . " " . $lname; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview ">
          <a href="<?php echo site_url('Admin/dashboard'); ?>" class="nav-link active">
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?php echo site_url('Admin/ProductDetails'); ?>" class="nav-link">

            <p>
              Create Product Details
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('Product-Category') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('Admin/ProductDetails'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Product</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?php echo base_url('#'); ?>" class="nav-link">
            <p>
              Sales Coordinator
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('Reference-Enquiry'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Enquiry</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('Reference-Enquiry-List'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Enquiry List</p>
              </a>
            </li>
          </ul>
        </li>

        <?php
        if ($role != 0) {
        ?>
          <li class="nav-item">
            <a href="<?php echo site_url('Project-List'); ?>" class="nav-link">
              <p>
                Project Details
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('#'); ?>" class="nav-link">
              <p>
                Quotation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('Admin/quotation'); ?>" class="nav-link">
                  <p>
                    Quotation Details
                  </p>
                </a>
              </li>
              <?php
              if ($role != 0) {

              ?>
                <li class="nav-item">
                  <a href="<?php echo base_url('Quotation-Not-Generate'); ?>" class="nav-link">
                    <p>
                      Quotation Not Created
                    </p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('Admin/enquiry'); ?>" class="nav-link">
              <p>
                Enquiry Details
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('Admin/kw'); ?>" class="nav-link">
              <p>
                KW Price
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('Admin/customer'); ?>" class="nav-link">
              <p>
                Customer Details
              </p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item has-treeview">
          <a href="<?php echo base_url('#'); ?>" class="nav-link">
            <p>
              Setting
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php
            if ($role != 0) {
            ?>
              <li class="nav-item">
                <a href="<?php echo site_url('Admin/CreateAgent'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Team</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Quotation-Status'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quotation Status</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="<?php echo site_url('Payment-Term'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment Term</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('Admin/AgentList'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Work Check List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('Term-And-Condition'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Term and Condition</p>
              </a>
            </li>
            <?php
            if ($role != 0) {
            ?>
              <li class="nav-item">
                <a href="<?php echo site_url('Customer-Document'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Documents</p>
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
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