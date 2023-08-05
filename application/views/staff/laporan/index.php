<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Laporan E-Learning</h4>
                        </div>
                     </div>
                     <div class="card-body">

                        <div class="row">

                           <div class="col-lg-10">
                           </div>

                           <div class="btn-group col-lg-2 mb-2">
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
                              <th>Kelas & Kejuruan</th>
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
/*Table Data Kelas*/
   function table_data_kelas() {

     $(document).ready(function() {

      var table_data_kelas = $('#table_data_kelas').DataTable({ 
       destroy: true,
       ordering: false,
       processing: true,
       serverSide: true,
       pageLength: -1,
       "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]], 
       ajax: {
         url: "<?= site_url('laporan/table_data_kelas')?>",
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