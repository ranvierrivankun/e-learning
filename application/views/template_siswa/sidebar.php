<?php 
$pengaturan = $this->db->select('*')->from('pengaturan')->get()->row();
?>

  <div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center">
      <a href="<?= base_url('dashboard'); ?>" class="header-logo">
        <h5 class="logo-title light-logo"><?= $pengaturan->nama_sekolah ?></h5>
      </a>
      <div class="iq-menu-bt-sidebar ml-0">
        <i class="las la-bars wrapper-menu"></i>
      </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
      <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
          <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>">
            <a href="<?= base_url('dashboard'); ?>">                        
              <i class="fa-solid fa-gauge"></i>
              <span class="ml-1">Dashboard</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>