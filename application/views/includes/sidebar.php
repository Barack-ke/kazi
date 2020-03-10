<!-- Sidebar -->
<div id="sidebar">
  <header>
    <a href="#">Manager</a>
  </header>
  <ul class="nav">
    <li>
        <a href="<?php echo base_url('dashboard'); ?>">
          <i class="zmdi zmdi-view-dashboard"></i> Dashboard
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('project'); ?>">
          <i class="zmdi zmdi-link"></i> Projects
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('developer'); ?>">
          <i class="zmdi zmdi-info-outline"></i> Developers
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('client');?>">
          <i class="zmdi zmdi-widgets"></i> Clients
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('user/getuser');?>">
          <i class="zmdi zmdi-accounts"></i> Users
        </a>
      </li>
    <?php
    if($this->session->userdata('loginprivileg') == 1){
      ?>
      <li>
        <a href="<?php echo base_url('dashboard'); ?>">
          <i class="zmdi zmdi-view-dashboard"></i> Dashboard
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('project'); ?>">
          <i class="zmdi zmdi-link"></i> Projects
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('developer'); ?>">
          <i class="zmdi zmdi-info-outline"></i> Developers
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('client');?>">
          <i class="zmdi zmdi-widgets"></i> Clients
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('user/getuser');?>">
          <i class="zmdi zmdi-accounts"></i> Users
        </a>
      </li>
      <?php
    }elseif($this->session->userdata('loginprivileg') == 2){
      ?>
      <li>
        <a href="<?php echo base_url('project'); ?>">
          <i class="zmdi zmdi-link"></i> Projects
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('developer'); ?>">
          <i class="zmdi zmdi-info-outline"></i> Developers
        </a>
      </li>
      <?php
    }elseif($this->session->userdata('loginprivileg') == 3){
      ?>
      <li>
        <a href="<?php echo base_url('project'); ?>">
          <i class="zmdi zmdi-link"></i> Projects
        </a>
      </li>
      <?php
    }
    ?>
  </ul>
</div>