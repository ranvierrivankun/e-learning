<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Data Mata Pelajaran</h4>
                        </div>
                     </div>
                     <div class="card-body">

                        <div class="row">

                           <div class="btn-group col-lg-3">
                           <button class="btn btn-success mb-2" onclick="modal_tambah_data_mapel()">
                              Tambah Data Mata Pelajaran
                           </button>
                        </div>

                        <div class="col-lg-7">
                        </div>

                        <div class="btn-group col-lg-2 mb-2">
                          <button class="btn btn-dark" onclick="reload_table_data_mapel()">
                            Refresh 
                         </button>
                      </div>

                   </div>

                   <div class="table-responsive">
                     <table id="table_data_mapel" class="table table-sm table-hover">
                        <thead>
                           <tr>
                              <th width="10%">Aksi</th>
                              <th>Nama Mata Pelajaran</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

     <!--  <div class="col-lg-6">
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
                              <th>Kelas</th>
                              <th>Nama Kejuruan</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->

</div>
</div>
</div>

<script type="text/javascript">
/*Table Data Mapel*/
 function table_data_mapel() {

  $(document).ready(function() {

   var table_data_mapel = $('#table_data_mapel').DataTable({ 
    destroy: true,
    ordering: false,
    processing: true,
    serverSide: true,
    pageLength: 10,
    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]], 
    ajax: {
      url: "<?= site_url('data_mapel/table_data_mapel')?>",
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
}table_data_mapel();

/*Reload Table*/
function reload_table_data_mapel()
{
  table_data_mapel();
}
</script>