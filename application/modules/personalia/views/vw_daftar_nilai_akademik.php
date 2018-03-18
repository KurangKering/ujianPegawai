<style type="text/css" media="screen">
.toolbar {
  float: left;
}
</style>

<div class="row">
  <div class="col-lg-12">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
        <li class="active"><a href="<?php echo base_url('personalia/daftarnilai/akademik/') ?>">Akademik</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/daftarnilai/psikotest') ?>"">Psikotest</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/daftarnilai/wawancara') ?>">Wawancara</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/daftarnilai/diterima') ?>"">Diterima</a></li>
      </ul>
      <div class="tab-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="tabs-container">
              <div class="tabs-right">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#tab-akademik-administrasi">Administrasi</a></li>
                  <li class=""><a data-toggle="tab" href="#tab-akademik-keamanan">Keamanan</a></li>
                </ul>


                <div class="tab-content ">
                  <div id="tab-akademik-administrasi" class="tab-pane active">
                    <div class="panel-body">
                      <div id="toolvote-akademik-administrasi" style="display:none;">

                        <div class="row dashboard-header">

                          <div class="col-md-11">
                            <input id="upvote-akademik-administrasi" name="">
                          </div>
                          <div class="col-md-1">
                            <button id="btn-upvote-akademik-administrasi"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>

                          </div>
                        </div>
                      </div>


                      <div class="col-md-12">

                       <table class="table table-striped" id="table-akademik-administrasi">
                        <thead>
                          <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Akademik</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>


                  </div>
                </div>
                <div id="tab-akademik-keamanan" class="tab-pane ">
                  <div class="panel-body">
                    <div id="toolvote-akademik-keamanan" style="display:none;">

                      <div class="row dashboard-header">

                        <div class="col-md-11">
                          <input id="upvote-akademik-keamanan" name="">
                        </div>
                        <div class="col-md-1">
                          <button id="btn-upvote-akademik-keamanan"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-12">

                     <table class="table table-striped" id="table-akademik-keamanan">
                      <thead>
                        <tr>
                          <th>NIK</th>
                          <th>Nama</th>
                          <th>Akademik</th>
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


  table_akademik_administrasi = $('#table-akademik-administrasi').DataTable({ 
   "bLengthChange": false,

   "bAutoWidth": false ,
   "processing": true, 
   "serverSide": true, 
   "order": [], 

   "ajax": {
    "url": '<?php echo site_url('personalia/jsonDaftarNilai/akademik/administrasi'); ?>',
    "type": "POST"
  },
  "columns": [
  {"data": "nik"},
  {"data": "nama"},
  {"data": "nilai_akademik"},
  {"data": "nik"}
  ],
  dom: 'l<"#administrasi.toolbar">frtip',
  initComplete: function() {
   $("div#administrasi")
   .html('<button type="button" id="btn-show-toolvote-akademik-administrasi" class="btn btn-primary" >Seleksi [+]</button>'); 
   $('#btn-show-toolvote-akademik-administrasi').click(function() {
    $('#toolvote-akademik-administrasi').toggle();
    if ($('#btn-show-toolvote-akademik-administrasi').html() === 'Seleksi [+]') {
      $('#btn-show-toolvote-akademik-administrasi').html('Seleksi [-]');
    }
    else {
      $('#btn-show-toolvote-akademik-administrasi').html('Seleksi [+]');
    }
  }); 

   $("#upvote-akademik-administrasi").ionRangeSlider({
    min: 0,
    max: this.api().rows().count(),
  });
   $('#btn-upvote-akademik-administrasi').click(function() {
    var jumlah = $('#upvote-akademik-administrasi').val();
    var status = '2';
    var formasi = 'administrasi';
    var data = {
      jumlah : jumlah,
      status : status,
      formasi : formasi
    };
    $.ajax({
      url: '<?php echo site_url('personalia/naikTingkat') ?>',
      type: 'POST',
      data: data,
    })
    .done(function(data) {

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      table_akademik_administrasi.ajax.reload();
      console.log("complete");
    });
    
  });
   var x = $("#upvote-akademik-administrasi").data("ionRangeSlider");
   console.log(jQuery.isEmptyObject(x));
 },
 "drawCallback" : function(settings) {
   if (!jQuery.isEmptyObject($("#upvote-akademik-administrasi").data("ionRangeSlider"))) 
   {
    var anu = $("#upvote-akademik-administrasi").data("ionRangeSlider");
    anu.update({
      max : this.api().rows().count(),
      from : 0
    })
  }
}
});





  table_akademik_keamanan = $('#table-akademik-keamanan').DataTable({ 
   "bLengthChange": false,
   "bAutoWidth": false ,
   "processing": true, 
   "serverSide": true, 
   "order": [], 

   "ajax": {
    "url": '<?php echo site_url('personalia/jsonDaftarNilai/akademik/keamanan'); ?>',
    "type": "POST"
  },
  "columns": [
  {"data": "nik"},
  {"data": "nama"},
  {"data": "nilai_akademik"},
  {"data": "nik"}
  ],

  dom: 'l<"#keamanan.toolbar">frtip',
  initComplete: function(){
    var api = this.api();
    $("div#keamanan")
    .html('<button type="button" id="btn-show-toolvote-akademik-keamanan" class="btn btn-primary" >Seleksi [+]</button>'); 

    $('#btn-show-toolvote-akademik-keamanan').click(function() {

      $('#toolvote-akademik-keamanan').toggle();
      if ($('#btn-show-toolvote-akademik-keamanan').html() === 'Seleksi [+]') {
        $('#btn-show-toolvote-akademik-keamanan').html('Seleksi [-]');
      }
      else {
        $('#btn-show-toolvote-akademik-keamanan').html('Seleksi [+]');
      }
    })
    $("#upvote-akademik-keamanan").ionRangeSlider({

      min: 0,
      max: this.api().rows().count(),
    });
    $('#btn-upvote-akademik-keamanan').click(function() {
      var jumlah = $('#upvote-akademik-keamanan').val();
      var status = '2';
      var formasi = 'keamanan';
      var data = {
        jumlah : jumlah,
        status : status,
        formasi : formasi
      };
      $.ajax({
        url: '<?php echo site_url('personalia/naikTingkat') ?>',
        type: 'POST',
        data: data,
      })
      .done(function(data) {

      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        table_akademik_keamanan.ajax.reload();

        console.log("complete");
      });

    });

  },
  "drawCallback" : function(settings) {
    if (!jQuery.isEmptyObject($("#upvote-akademik-keamanan").data("ionRangeSlider"))) 
    {
      var anu = $("#upvote-akademik-keamanan").data("ionRangeSlider");
      anu.update({
        max : this.api().rows().count(),
        from : 0
      })
    }
  }

});

});
</script>