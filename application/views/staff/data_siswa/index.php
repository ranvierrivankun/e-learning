<div class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Data Siswa</h4>
                  </div>
               </div>
               <div class="card-body">

                  <div class="row">

                     <div class="btn-group col-lg-2">
                        <button class="btn btn-success mb-2" onclick="modal_tambah_data_siswa()">
                           Tambah Data Siswa
                        </button>
                     </div>

                     <div class="col-lg-8">
                     </div>

                     <div class="btn-group col-lg-2 mb-2">
                      <button class="btn btn-dark" onclick="reload_table_data_siswa()">
                       Refresh 
                    </button>
                 </div>

              </div>

              <div class="table-responsive">
               <table id="table_data_siswa" class="table table-sm table-hover">
                  <thead>
                     <tr>
                        <th width="10%">Aksi</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Gender</th>
                        <th>No Telepon</th>
                        <th>Email</th>
                        <th width="5%">Status</th>
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

<script type="text/javascript">
/*Table Data Staff*/
 function table_data_siswa() {

  $(document).ready(function() {

   var table_data_siswa = $('#table_data_siswa').DataTable({ 
    destroy: true,
    ordering: false,
    processing: true,
    serverSide: true,
    pageLength: 10,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
    ajax: {
      url: "<?= site_url('data_siswa/table_data_siswa')?>",
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
}table_data_siswa();

/*Reload Table*/
function reload_table_data_siswa()
{
  table_data_siswa();
}
</script>