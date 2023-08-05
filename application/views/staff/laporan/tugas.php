<div class="content-page">
   <div class="container-fluid">
      <div class="row">

         <div class="col-lg-12">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Laporan Tugas Kelas <?= $head->nama_kelas ?> - <?= $head->nama_kejuruan ?></h4>
                        </div>
                     </div>
                     <div class="card-body" id="header">

                        <div class="row">


                         <input type="hidden" id="id_kelas" value="<?= $where->id_kelas ?>">
                         <input type="hidden" id="id_jadpel" value="<?= $where->id_jadpel ?>">


                         <div class="col-lg-4 mb-1">
                           <select class="form-control mapel" name="mapel">
                              <option value=""></option>
                           </select>
                        </div>

                        <div class="col-lg-6">
                        </div>

                        <div class="btn-group col-lg-2 mb-2">
                           <button class="btn btn-dark" onclick="filter()">
                             Filter 
                          </button>
                          <form action="<?= site_url('laporan/table_tugas_excel') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                           <input type="hidden" name="waktu" class="waktu">
                           <input type="hidden" name="jadpel" class="jadpel">
                           <input type="hidden" name="mapel" id="mapel">
                           <input type="hidden" name="id_kelas" class="id_kelas">


                           <button type="submit" class="btn btn-success" id="btn-excel">
                            <i class="fas fa-file-excel"></i>
                            Export Excel
                         </button>
                      </form>
                   </div>

                </div>

                <div id="table_laporan_tugas"></div>

             </div>
          </div>
       </div>
    </div>
 </div>

</div>
</div>
</div>

<!-- Select2 Last -->
<script src="<?= base_url('') ?>/assets/vendor/select2_last/dist/js/select2.full.min.js"></script>

<!-- DayJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/dayjs.min.js" integrity="sha512-C2m821NxMpJ4Df47O4P/17VPqt0yiK10UmGl59/e5ynRRYiCSBvy0KHJjhp2XIjUJreuR+y3SIhVyiVilhCmcQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/locale/id.min.js" integrity="sha512-40gkhuMAPYiwcLQJ31uEIiVHke0TNMmPasdCU0c3m9WZSPg4JP0TaTIS190llixCdtqG0lMfdBJaWbdzZSUsBw==" crossorigin="anonymous"></script>

<script type="text/javascript">
 /*Select Mata Pelajaran*/
   $(".mapel").select2({
    theme: 'bootstrap4',
    dropdownParent: $("#header"),
    placeholder: 'Pilih Mata Pelajaran',
    ajax: { 
     url: "<?= site_url('select/mapel_laporan')?>",
     type: "post",
     dataType: 'json',
     delay: 250,
     data: function (params) {
      var id_kelas = $('#id_kelas').val();

      return {
       searchTerm: params.term,
       id_kelas: id_kelas,
    };
 },
 processResults: function (response) {
   return {
    results: response
 };
},
cache: true
}
});

   function filter() {
    dayjs.locale('id');

  // Update the '.waktu' element with the current time in the specified format
    $('.waktu').val(dayjs().format('dddd, DD-MM-YYYY HH:mm:ss'));

  // Get the values from the input elements
    var waktu = $('.waktu').val();
    var mapel = $('.mapel').val();
    var jadpel = $('#id_jadpel').val();
    var id_kelas = $('#id_kelas').val();

    $('#mapel').val(mapel);
    $('.jadpel').val(jadpel);
     $('.id_kelas').val(id_kelas);

  // Prepare the data object to be sent in the AJAX request
    var requestData = {
     waktu: waktu,
     mapel: mapel,
     jadpel: jadpel,
     id_kelas: id_kelas
  };

  $.ajax({
     url: "<?= site_url('laporan/table_laporan_tugas') ?>",
     method: "POST",
     data: requestData,

     beforeSend: () => {
      $('#btn-filter').html(`<i class='fa-solid fa-spinner'></i> Memproses`);
      $('#btn-filter').attr('disabled', true);
      $('#table_laporan_tugas').html(`<i class='fa-solid fa-spinner'></i> Memproses`);
   },

   success: (data) => {
      $('#btn-filter').html(`<i class='fa fa-filter'></i> Filter`);
      $('#btn-filter').attr('disabled', false);
      $('#table_laporan_tugas').html(data);
   },

   error: (xhr, textStatus, errorThrown) => {
      // Handle the error if the AJAX request fails
      console.error("AJAX request failed:", textStatus, errorThrown);
      $('#btn-filter').html(`<i class='fa fa-filter'></i> Filter`);
      $('#btn-filter').attr('disabled', false);
   }
});
}

// Call the filter function to initiate the AJAX request
filter();
</script>