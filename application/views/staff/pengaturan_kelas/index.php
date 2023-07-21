<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-6">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Data Kejuruan</h4>
                        </div>
                     </div>
                     <div class="card-body">

                        <div class="row mb-2">

                           <div class="btn-group col-10">
                              <button class="btn btn-success" onclick="modal_tambah_data_kejuruan()">
                                 Tambah Data Kejuruan
                              </button>
                              <button class="btn btn-dark" onclick="reload_table_data_kejuruan()">
                               Refresh 
                            </button>
                         </div>

                      </div>

                      <div class="table-responsive">
                        <table id="table_data_kejuruan" class="table table-sm table-hover">
                           <thead>
                              <tr>
                                 <th width="10%">Aksi</th>
                                 <th>Nama Kejuruan</th>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-lg-6">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Data Kelas</h4>
                     </div>
                  </div>
                  <div class="card-body">

                     <div class="row mb-2">

                        <div class="btn-group col-10">
                           <button class="btn btn-success" onclick="modal_tambah_data_kelas()">
                              Tambah Data Kelas
                           </button>
                           <button class="btn btn-dark" onclick="reload_table_data_kelas()">
                            Refresh 
                         </button>
                      </div>

                   </div>

                   <div class="table-responsive">
                     <table id="table_data_kelas" class="table table-sm table-hover">
                        <thead>
                           <tr>
                              <th width="10%">Aksi</th>
                              <th>Nama Kelas</th>
                              <th>Nama Kejuruan</th>
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
/*Table Data Kejuruan*/
 function table_data_kejuruan() {

  $(document).ready(function() {

   var table_data_kejuruan = $('#table_data_kejuruan').DataTable({ 
    destroy: true,
    ordering: false,
    processing: true,
    serverSide: true,
    pageLength: 5,
    "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]], 
    ajax: {
      url: "<?= site_url('pengaturan_kelas/table_data_kejuruan')?>",
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
}table_data_kejuruan();

/*Reload Table*/
function reload_table_data_kejuruan()
{
  table_data_kejuruan();
}

 /*Table Data Kelas*/
function table_data_kelas() {

  $(document).ready(function() {

   var table_data_kelas = $('#table_data_kelas').DataTable({ 
    destroy: true,
    ordering: false,
    processing: true,
    serverSide: true,
    pageLength: 5,
    "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]], 
    ajax: {
      url: "<?= site_url('pengaturan_kelas/table_data_kelas')?>",
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
}table_data_kelas();

/*Reload Table*/
function reload_table_data_kelas()
{
  table_data_kelas();
}
</script>