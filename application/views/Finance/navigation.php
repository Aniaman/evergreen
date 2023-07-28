  <!-- Left Sidenav -->
  <div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
      <a href="index.html" class="logo">
        <span>
          <img src="<?= base_url('dist/img/evergreen-solar-2.png'); ?>" alt="logo-small" class="logo-md">
        </span>
      </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100 mt-5" data-simplebar>
      <ul class="metismenu left-sidenav-menu">
        <li>
          <a href="<?= base_url('Finance-DashBoard') ?>"><i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
        </li>
      </ul>
    </div>
  </div>
  <!-- end left-sidenav-->


  <div class="page-wrapper">
    <!-- Page Content-->
    <div class="topbar">
      <!-- Navbar -->
      <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-end mb-0">


          <li class="dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <span class="ms-1 nav-user-name hidden-sm"><?= $this->session->name != "" ? $this->session->name : "" ?></span>
              <img src="<?= base_url(); ?>assets/images/avatar/avatar.png" alt="profile-user" class="rounded-circle thumb-xs" />
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <div class="dropdown-divider mb-0"></div>
              <a class="dropdown-item" href="<?= base_url('Logout') ?>"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
            </div>
          </li>
        </ul>

        <ul class="list-unstyled topbar-nav mb-0">
          <li>
            <button class="nav-link button-menu-mobile">
              <i data-feather="menu" class="align-self-center topbar-icon"></i>
            </button>
          </li>
        </ul>
      </nav>
      <!-- end navbar-->
    </div>
    <!-- Top Bar End -->
    <div class="page-content">
      <div class="container-fluid">