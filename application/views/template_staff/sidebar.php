<?php 
$pengaturan = $this->db->select('*')->from('pengaturan')->get()->row();
?>

<div class="iq-sidebar  sidebar-default ">
  <div class="iq-sidebar-logo d-flex align-items-center">
    <a href="<?= base_url('Dashboard_staff'); ?>" class="header-logo">
      <h5 class="logo-title light-logo"><?= $pengaturan->nama_sekolah ?></h5>
    </a>
    <div class="iq-menu-bt-sidebar ml-0">
      <i class="las la-bars wrapper-menu"></i>
    </div>
  </div>
  <div class="data-scrollbar" data-scroll="1">
    <nav class="iq-sidebar-menu">
      <ul id="iq-sidebar-toggle" class="iq-menu">

        <li class="<?php if($this->uri->segment(1)=="Dashboard_staff"){echo "active";}?>">
          <a href="<?= base_url('Dashboard_staff'); ?>">                        
            <i class="fa-solid fa-gauge"></i>
            <span class="ml-1">Dashboard</span>
          </a>
        </li>

        <!-- Admin -->
        <?php if(staffdata('role') == '1') { ?>

          <hr>

          <li class="active">
            <menu>Admin Menu</menu>
          </li>

          <li class="<?php if($this->uri->segment(1)=="Pengaturan_kelas"){echo "active";}?>">
            <a href="<?= base_url('Pengaturan_kelas'); ?>">                        
              <i class="fa-solid fa-users-rectangle"></i>
              <span class="ml-1">Pengaturan Kelas</span>
            </a>
          </li>

          <li class="<?php if($this->uri->segment(1)=="Data_mapel"){echo "active";}?>">
            <a href="<?= base_url('Data_mapel'); ?>">                        
              <i class="fa-solid fa-book"></i>
              <span class="ml-1">Data Mata Pelajaran</span>
            </a>
          </li>

          <li class="<?php if($this->uri->segment(1)=="Data_jadpel"){echo "active";}?>">
            <a href="<?= base_url('Data_jadpel'); ?>">                        
              <i class="fa-solid fa-swatchbook"></i>
              <span class="ml-1">Data Jadwal Pelajaran</span>
            </a>
          </li>

          <li class="<?php if($this->uri->segment(1)=="Data_staff"){echo "active";}?>">
            <a href="<?= base_url('Data_staff'); ?>">                        
              <i class="fa-solid fa-user-tie"></i>
              <span class="ml-1">Data Staff</span>
            </a>
          </li>

          <!-- Staff -->
        <?php } else if(staffdata('role') == '2') { ?>

          <hr>

          <li class="active">
            <menu>Staff Menu</menu>
          </li>

          <li class="<?php if($this->uri->segment(1)=="Data_mapel"){echo "active";}?>">
            <a href="<?= base_url('Data_mapel'); ?>">                        
              <i class="fa-solid fa-book"></i>
              <span class="ml-1">Data Mata Pelajaran</span>
            </a>
          </li>

          <li class="<?php if($this->uri->segment(1)=="Data_jadpel"){echo "active";}?>">
            <a href="<?= base_url('Data_jadpel'); ?>">                        
              <i class="fa-solid fa-swatchbook"></i>
              <span class="ml-1">Data Jadwal Pelajaran</span>
            </a>
          </li>

          <li class="<?php if($this->uri->segment(1)=="Data_siswa"){echo "active";}?>">
            <a href="<?= base_url('Data_siswa'); ?>">                        
              <i class="fa-solid fa-user"></i>
              <span class="ml-1">Data Siswa</span>
            </a>
          </li>

          <!-- Guru -->
        <?php } else if(staffdata('role') == '3') { ?>

          <hr>

          <li class="active">
            <menu>Guru Menu</menu>
          </li>

          <li class="<?php if($this->uri->segment(1)=="Jadwal_mengajar"){echo "active";}?>">
            <a href="<?= base_url('Jadwal_mengajar'); ?>">                        
              <i class="fa-solid fa-swatchbook"></i>
              <span class="ml-1">Jadwal Mengajar</span>
            </a>
          </li>

          <!-- <li class="<?php if($this->uri->segment(1)=="data_siswa"){echo "active";}?>">
            <a href="<?= base_url('data_siswa'); ?>">                        
              <i class="fa-solid fa-user"></i>
              <span class="ml-1">Data Siswa</span>
            </a>
          </li> -->

        <?php } else { ?>
        <?php } ?>

      </ul>
    </nav>
  </div>
</div>