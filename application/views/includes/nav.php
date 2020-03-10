<!-- Content -->
<div id="content">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <ul class="nav navbar-nav navbar-right">
        <?php
if($this->session->userdata('uname') != null){
?>
<li>Welcome <?php echo $this->session->userdata('uname');?> </li> &nbsp;
<a href="<?php echo base_url('user/killall'); ?>">logout</a>
<?php
}else{
?>
<li>
          <a href="<?php echo base_url('user/login'); ?>">Login
          </a>
        </li>
        <li><a href="<?php echo base_url('user/create'); ?>">Register</a></li>
<?php
}
        ?>        
      </ul>
    </div>
  </nav>
  