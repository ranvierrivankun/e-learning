<div class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Data Staff</h4>
                  </div>
               </div>
               <div class="card-body">

                  <div class="row">

                     <div class="btn-group col-lg-2">
                        <button class="btn btn-success mb-2" onclick="modal_tambah_data_staff()">
                           Tambah Data Staff
                        </button>
                     </div>

                     <div class="col-lg-8">
                     </div>

                     <div class="btn-group col-lg-2 mb-2">
                       <button class="btn btn-dark" onclick="reload_table_data_staff()">
                         Refresh 
                      </button>
                   </div>

                </div>

                <div class="table-responsive">
                  <table id="table_data_staff" class="table table-sm table-hover">
                     <thead>
                        <tr>
                           <th width="10%">Aksi</th>
                           <th>Peran</th>
                           <th>NIK</th>
                           <th>Nama</th>
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
  function table_data_staff() {

    $(document).ready(function() {

      var table_data_staff = $('#table_data_staff').DataTable({ 
        destroy: true,
        ordering: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        ajax: {
         url: "<?= site_url('data_staff/table_data_staff')?>",
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
 }table_data_staff();

/*Reload Table*/
 function reload_table_data_staff()
 {
    table_data_staff();
 }
</script>