<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title mb-1">Data Upload Tugas <?= $where->nama_mapel ?></h4>
                           <h5 class="font-italic"><?= $where->nama_kelas ?> - <?= $where->nama_kejuruan ?></h5>
                        </div>
                     </div>
                     <div class="card-body">

                        <input type="hidden" id="id_tugas" value="<?= $where->id_tugas; ?>"></input>

                        <div class="row">

                           <div class="col-lg-10">
                              <h6><?= $where->judul_tugas ?> (<?= $where->tgl_mulai_tugas ?> - <?= $where->tgl_selesai_tugas ?>)</h6>
                           </div>

                           <div class="btn-group col-lg-2 mb-2">
                             <button class="btn btn-dark" onclick="reload_table_data_upload()">
                               Refresh 
                            </button>
                         </div>

                      </div>

                      <div class="row">

                      </div>

                      <div class="table-responsive">
                        <table id="table_data_upload" class="table table-sm table-hover">
                           <thead>
                              <tr>
                                 <th width="5%">Aksi</th>
                                 <th>Nama Siswa/Siswi</th>
                                 <th>Link</th>
                                 <th>Upload</th>
                                 <th>Nilai</th>
                                 <th>Catatan</th>
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
/*Table Data Upload*/
 function table_data_upload() {

  $(document).ready(function() {
   var id_tugas = $('#id_tugas').val();
   var table_data_upload = $('#table_data_upload').DataTable({ 
    destroy: true,
    ordering: false,
    processing: true,
    serverSide: true,
    pageLength: 10,
    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]], 
    ajax: {
      url: "<?= site_url('Jadwal_mengajar/table_data_upload')?>",
      method: "POST",
      data: {
         id_tugas: id_tugas,
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
}table_data_upload();

/*Reload Table*/
function reload_table_data_upload()
{
  table_data_upload();
}
</script>