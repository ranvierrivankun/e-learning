<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title mb-1">Data Absen <?= $where->nama_mapel ?></h4>
                           <h5 class="font-italic"><?= $where->nama_kelas ?> - <?= $where->nama_kejuruan ?></h5>
                           <span class="badge badge-pill badge-light"><?= $where->nama_hari ?></span>
                           <span class="badge badge-pill badge-primary"><?= $where->waktu_mulai ?> - <?= $where->waktu_selesai ?></span>
                        </div>
                     </div>
                     <div class="card-body">

                        <input type="hidden" id="id_jadpel" value="<?= $where->id_jadpel; ?>"></input>
                        <input type="hidden" id="id_mapel" value="<?= $where->id_mapel; ?>"></input>
                        <input type="hidden" id="id_kelas" value="<?= $where->id_kelas; ?>"></input>

                        <div class="row">

                           <?php if($where2->absen == 'nonaktif') { ?>

                              <div class="btn-group col-lg-2">
                                 <button class="btn btn-success mb-2" onclick="modal_tambah_data_absen()">
                                    Buka Absen 
                                 </button>
                              </div>

                              <div class="col-lg-8">
                              </div>

                           <?php } else { ?>

                              <div class="btn-group col-lg-2">
                                 <button class="btn btn-danger mb-2" onclick="tutup_data_absen()">
                                    Tutup Absen 
                                 </button>
                              </div>

                              <div class="col-lg-8">
                              </div>

                           <?php } ?>
                           
                           

                           <div class="btn-group col-lg-2 mb-2">
                            <button class="btn btn-dark" onclick="reload_table_data_absen()">
                             Refresh 
                          </button>
                       </div>

                    </div>

                    <div class="table-responsive">
                     <table id="table_data_absen" class="table table-sm table-hover">
                        <thead>
                           <tr>
                              <th width="5%">Aksi</th>
                              <th>Judul</th>
                              <th>Tanggal</th>
                              <th>Mulai</th>
                              <th>Selesai</th>
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
/*Table Data Absen*/
  function table_data_absen() {

   var id_jadpel = $('#id_jadpel').val();
   var id_mapel = $('#id_mapel').val();
   var id_kelas = $('#id_kelas').val();

   $(document).ready(function() {

      var table_data_absen = $('#table_data_absen').DataTable({ 
        destroy: true,
        ordering: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]], 
        ajax: {
         url: "<?= site_url('Jadwal_mengajar/table_data_absen')?>",
         method: "POST",
         data: {
            id_jadpel: id_jadpel,
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
}table_data_absen();

/*Reload Table*/
function reload_table_data_absen()
{
 table_data_absen();
}
</script>