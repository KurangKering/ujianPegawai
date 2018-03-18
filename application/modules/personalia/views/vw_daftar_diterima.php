<style type="text/css" media="screen">
.toolbar {
  float: left;
}
</style>

<div class="row">
  <div class="col-lg-12">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
        <li class=""><a href="<?php echo base_url('personalia/daftarnilai/akademik/') ?>">Akademik</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/daftarnilai/psikotest') ?>"">Psikotest</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/daftarnilai/wawancara') ?>">Wawancara</a></li>
        <li class="active"><a  href="<?php echo base_url('personalia/daftarnilai/diterima') ?>"">Diterima</a></li>
      </ul>
      <div class="tab-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="tabs-container">
              <div class="tabs-right">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#tab-diterima-administrasi">Administrasi</a></li>
                  <li class=""><a data-toggle="tab" href="#tab-diterima-keamanan">Keamanan</a></li>
                </ul>


                <div class="tab-content ">
                  <div id="tab-diterima-administrasi" class="tab-pane active">
                    <div class="panel-body">
                      <div id="toolvote-diterima-administrasi" style="display:none;">

                        <div class="row dashboard-header">

                          <div class="col-md-11">
                            <input id="upvote-diterima-administrasi" name="">
                          </div>
                          <div class="col-md-1">
                            <button id="btn-upvote-diterima-administrasi"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>

                          </div>
                        </div>
                      </div>


                      <div class="col-md-12">

                       <table class="table table-striped" id="table-diterima-administrasi">
                        <thead>
                          <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>A</th>
                            <th>P</th>
                            <th>W </th>
                            <th>AVG</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>


                  </div>
                </div>
                <div id="tab-diterima-keamanan" class="tab-pane ">
                  <div class="panel-body">
                    <div id="toolvote-diterima-keamanan" style="display:none;">

                      <div class="row dashboard-header">

                        <div class="col-md-11">
                          <input id="upvote-diterima-keamanan" name="">
                        </div>
                        <div class="col-md-1">
                          <button id="btn-upvote-diterima-keamanan"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-12">

                     <table class="table table-striped" id="table-diterima-keamanan">
                      <thead>
                        <tr>
                         <th>NIK</th>
                         <th>Nama</th>
                         <th>A</th>
                         <th>P</th>
                         <th>W  </th>
                         <th>AVG</th>
                         <th>Aksi</th>
                       </tr>
                     </thead>
                     <tbody>

                     </tbody>
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
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){


  table_diterima_administrasi = $('#table-diterima-administrasi').DataTable({ 
   "bLengthChange": false,

   "bAutoWidth": false ,
   "processing": true, 
   "serverSide": true, 
   "order": [], 

   "ajax": {
    "url": '<?php echo site_url('personalia/jsonDaftarNilai/diterima/administrasi'); ?>',
    "type": "POST"
  },
  "columns": [
  {"data": "nik"},
  {"data": "nama"},
  {"data": "nilai_akademik"},
  {"data": "nilai_psikotest"},
  {"data": "nilai_wawancara"},
  {"data": "rata_rata"},
  {"data": "nik"}
  ],

});



  table_diterima_keamanan = $('#table-diterima-keamanan').DataTable({ 
   "bLengthChange": false,
   "bAutoWidth": false ,
   "processing": true, 
   "serverSide": true, 
   "order": [], 

   "ajax": {
    "url": '<?php echo site_url('personalia/jsonDaftarNilai/diterima/keamanan'); ?>',
    "type": "POST"
  },
  "columns": [
  {"data": "nik"},
  {"data": "nama"},
  {"data": "nilai_akademik"},
  {"data": "nilai_psikotest"},
  {"data": "nilai_wawancara"},
  {"data": "rata_rata"},
  {"data": "nik"}
  ]

});

});
</script>