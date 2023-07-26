<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title mb-1">Absen <?= $where->nama_mapel ?></h4>
                           <span class="badge badge-pill badge-light"><?= $where->nama_hari ?></span>
                           <span class="badge badge-pill badge-primary"><?= $where->waktu_mulai ?> - <?= $where->waktu_selesai ?></span>
                        </div>
                     </div>
                     <div class="card-body">

                        <!-- Query Get Absen & Muncul Tombol Absen -->
                        <?php
                        $id_jadpel     = $where->id_jadpel;
                        $id_mapel      = $where->id_mapel;
                        $id_kelas      = $where->id_kelas;
                        $absen         = $where->absen;
                        $date          = date('Y-m-d');
                        $murid         = userdata('id_siswa');

                        $query = $this->db->select_max('id_absen')->from('data_absen')->where('id_jadpel_absen', $id_jadpel)->get()->row();

                        $query2 = $this->db->select_max('judul_absen')->from('data_absen')->where('id_jadpel_absen', $id_jadpel)->get()->row();

                        $query3 = $this->db->select_max('judul_absen')->from('data_absen')->join('data_jadpel','id_jadpel=id_jadpel_absen')->where('jadpel_mapel', $id_mapel)->where('jadpel_kelas', $id_kelas)->get()->row();

                        $proses = $this->db->select('*')->from('data_absen')->where('id_jadpel_absen', $id_jadpel)->where('tgl_absen', $date)->get()->num_rows();

                        $proses2 = $this->db->select('*')->from('data_absen_murid')->where('mapel_absen_murid', $id_mapel)->where('tgl_absen_murid', $date)->where('user_absen_murid',$murid)->where('status_absen_murid','aktif')->get()->num_rows();

                        $cek_user = $this->db->select('*')->from('data_absen_murid')->where('mapel_absen_murid', $id_mapel)->where('tgl_absen_murid', $date)->where('user_absen_murid',$murid)->get()->num_rows();

                        if($proses > 0){
                           $id_absen = $query->id_absen;
                           $judul_absen2 = $query2->judul_absen;
                           $judul_absen3 = $query3->judul_absen;
                        } else {
                        }
                        
                        ?>

                        <input type="hidden" id="id_jadpel" value="<?= $where->id_jadpel; ?>"></input>
                        <input type="hidden" id="id_mapel" value="<?= $where->id_mapel; ?>"></input>

                        <?php if($proses > 0) { ?>
                          <input type="hidden" id="id_absen" value="<?= $id_absen ?>"></input>
                       <?php } ?>

                       <div class="row">

                        <div class="btn-group col-lg-3">

                           <?php if($proses > 0) { ?>

                              <?php if($proses2 > 0) { ?>
                                 <button class="btn btn-success mb-2" disabled>
                                    Sudah Absen Pertemuan <?= $judul_absen3; ?>
                                 </button>
                              <?php } else { ?>

                                 <?php if($cek_user > 0) { ?>

                                  <?php if($absen == 'aktif' ) { ?>
                                    <button class="btn btn-success mb-2" onclick="absen()">
                                       Absen Pertemuan <?= $judul_absen3; ?>
                                    </button>
                                 <?php } else { ?>
                                    <button class="btn btn-danger mb-2" disabled>
                                       Absen Pertemuan <?= $judul_absen2; ?> Ditutup 
                                    </button>
                                 <?php } ?>
                                 

                              <?php } else { ?>

                              <?php } ?>

                              

                           <?php } ?>

                        <?php } else { ?>

                           <button class="btn btn-danger mb-2" disabled>
                            Belum Mulai 
                         </button>
                      <?php } ?>
                   </div>

                   <div class="col-lg-7">
                   </div>

                   <div class="btn-group col-lg-2 mb-2">
                    <button class="btn btn-dark" onclick="reload_table_data_absen()">
                      Refresh 
                   </button>
                </div>

             </div>

             <div class="table-responsive">
               <table id="table_data_absen" class="table table-sm table-hover">
                  <thead>
                     <tr>
                        <th>Judul Absen</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Waktu</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

</div>
</div>
</div>

<script type="text/javascript">
/*Table Data Mapel*/
 function table_data_absen() {

  $(document).ready(function() {

    var id_mapel = $('#id_mapel').val();

    var table_data_absen = $('#table_data_absen').DataTable({ 
       destroy: true,
       ordering: false,
       processing: true,
       serverSide: true,
       pageLength: 10,
       "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]], 
       ajax: {
         url: "<?= site_url('Jadwal_pelajaran/table_data_absen')?>",
         method: "POST",
         data: {
            id_mapel: id_mapel,
         }
      },
      "language": {
        processing: '<i class="fa-solid fa-spinner"></i> Sedang diproses'
     },
     columnDefs: [
     { 
        visible: false,
        orderable: false,
     },
     ],

  });
 });
}table_data_absen();

/*Reload Table*/
function reload_table_data_absen()
{
  table_data_absen();
}
</script>