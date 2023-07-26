<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title mb-1">Data Materi <?= $where->nama_mapel ?></h4>
                           <h5 class="font-italic"><?= $where->nama_kelas ?> - <?= $where->nama_kejuruan ?></h5>
                           <span class="badge badge-pill badge-light"><?= $where->nama_hari ?></span>
                           <span class="badge badge-pill badge-primary"><?= $where->waktu_mulai ?> - <?= $where->waktu_selesai ?></span>
                        </div>
                     </div>
                     <div class="card-body">

                        <input type="hidden" id="id_jadpel" value="<?= $where->id_jadpel; ?>"></input>
                        <input type="hidden" id="id_mapel" value="<?= $where->jadpel_mapel; ?>"></input>
                        <input type="hidden" id="id_kelas" value="<?= $where->jadpel_kelas; ?>"></input>

                        <div class="row">

                           <div class="btn-group col-lg-2">
                              <button class="btn btn-success mb-2" onclick="modal_tambah_data_materi()">
                                 Tambah Data Materi
                              </button>
                           </div>

                           <div class="col-lg-8">
                           </div>

                           <div class="btn-group col-lg-2 mb-2">
                             <button class="btn btn-dark" onclick="reload_table_data_materi()">
                               Refresh 
                            </button>
                         </div>

                      </div>

                      <div class="table-responsive">
                        <table id="table_data_materi" class="table table-sm table-hover">
                           <thead>
                              <tr>
                                 <th width="5%">Aksi</th>
                                 <th>Judul</th>
                                 <th>Deskripsi</th>
                                 <th>File</th>
                                 <th>Update</th>
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
 function table_data_materi() {

  $(document).ready(function() {

   var id_mapel = $('#id_mapel').val();
   var id_kelas = $('#id_kelas').val();

   var table_data_materi = $('#table_data_materi').DataTable({ 
    destroy: true,
    ordering: false,
    processing: true,
    serverSide: true,
    pageLength: 10,
    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]], 
    ajax: {
      url: "<?= site_url('Jadwal_mengajar/table_data_materi')?>",
      method: "POST",
      data: {
         id_mapel: id_mapel,
         id_kelas: id_kelas,
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
}table_data_materi();

/*Reload Table*/
function reload_table_data_materi()
{
  table_data_materi();
}
</script>