<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title mb-1">Data Tugas <?= $where->nama_mapel ?></h4>
                           <h5 class="font-italic"><?= $where->nama_kelas ?> - <?= $where->nama_kejuruan ?></h5>
                        </div>
                     </div>
                     <div class="card-body">

                        <input type="hidden" id="id_jadpel" value="<?= $where->id_jadpel; ?>"></input>

                        <div class="row">

                           <div class="btn-group col-lg-2">
                              <button class="btn btn-success mb-2" onclick="modal_tambah_data_tugas()">
                                 Tambah Data Tugas
                              </button>
                           </div>

                           <div class="col-lg-8">
                           </div>

                           <div class="btn-group col-lg-2 mb-2">
                            <button class="btn btn-dark" onclick="reload_table_data_tugas()">
                             Refresh 
                          </button>
                       </div>

                    </div>

                    <div class="table-responsive">
                     <table id="table_data_tugas" class="table table-sm table-hover">
                        <thead>
                           <tr>
                              <th width="5%">Aksi</th>
                              <th>Judul</th>
                              <th>Deskripsi</th>
                              <th>File</th>
                              <th>Mulai</th>
                              <th>Selesai</th>
                              <th>Dibuat</th>
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
  function table_data_tugas() {

    $(document).ready(function() {

      var table_data_tugas = $('#table_data_tugas').DataTable({ 
        destroy: true,
        ordering: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]], 
        ajax: {
         url: "<?= site_url('Jadwal_mengajar/table_data_tugas')?>",
         method: "POST",
         data: {}
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
 }table_data_tugas();

/*Reload Table*/
 function reload_table_data_tugas()
 {
    table_data_tugas();
 }
</script>