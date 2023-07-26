<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title mb-1">Absensi Pertemuan <?= $where->judul_absen ?> - <?= $where->nama_mapel ?></h4>
                           <h5 class="font-italic"><?= $where->nama_kelas ?> - <?= $where->nama_kejuruan ?></h5>
                           <span class="badge badge-pill badge-light"><?= $where->nama_hari ?></span>
                           <span class="badge badge-pill badge-primary"><?= $where->waktu_mulai ?> - <?= $where->waktu_selesai ?></span>
                        </div>
                     </div>
                     <div class="card-body">

                        <input type="hidden" id="id_absen" value="<?= $where->id_absen; ?>"></input>

                        <div class="row">

                           <div class="col-lg-10">
                           </div>                                          

                           <div class="btn-group col-lg-2 mb-2">
                             <button class="btn btn-dark" onclick="reload_table_data_absensi()">
                               Refresh 
                            </button>
                         </div>

                      </div>

                      <div class="table-responsive">
                        <table id="table_data_absensi" class="table table-sm table-hover">
                           <thead>
                              <tr>
                                 <th>NISN</th>
                                 <th>Nama</th>
                                 <th>Jenis Kelamin</th>
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
 function table_data_absensi() {

   var id_absen = $('#id_absen').val();

   $(document).ready(function() {

      var table_data_absensi = $('#table_data_absensi').DataTable({ 
       destroy: true,
       ordering: false,
       processing: true,
       serverSide: true,
       pageLength: 10,
       "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]], 
       ajax: {
         url: "<?= site_url('Jadwal_mengajar/table_data_absensi')?>",
         method: "POST",
         data: {
            id_absen: id_absen,
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
}table_data_absensi();

/*Reload Table*/
function reload_table_data_absensi()
{
  table_data_absensi();
}
</script>