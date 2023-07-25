<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Jadwal Pelajaran</h4>
                        </div>
                     </div>
                     <div class="card-body">

                        <div class="row">

                           <div class="col-lg-10">
                           </div>

                           <div class="btn-group col-lg-2 mb-2">
                            <button class="btn btn-dark" onclick="reload_table_jadwal_pelajaran()">
                             Refresh 
                          </button>
                       </div>

                    </div>

                    <div class="table-responsive">
                     <table id="table_jadwal_pelajaran" class="table table-sm table-hover">
                        <thead>
                           <tr>
                              <th width="10%">Aksi</th>
                              <th>Nama Mata Pelajaran</th>
                              <th>Hari & Jam Pelajaran</th>
                              <th>Guru</th>
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
  function table_jadwal_pelajaran() {

    $(document).ready(function() {

      var table_jadwal_pelajaran = $('#table_jadwal_pelajaran').DataTable({ 
        destroy: true,
        ordering: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]], 
        ajax: {
         url: "<?= site_url('Jadwal_pelajaran/table_jadwal_pelajaran')?>",
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
 }table_jadwal_pelajaran();

/*Reload Table*/
 function reload_table_jadwal_pelajaran()
 {
    table_jadwal_pelajaran();
 }
</script>