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
              <li class="active"><a  href="<?php echo base_url('personalia/daftarnilai/psikotest') ?>"">Psikotest</a></li>
              <li class=""><a  href="<?php echo base_url('personalia/daftarnilai/wawancara') ?>">Wawancara</a></li>
              <li class=""><a  href="<?php echo base_url('personalia/daftarnilai/diterima') ?>"">Diterima</a></li>
          </ul>
          <div class="tab-content">
            <div class="row">

                <div class="col-lg-12">
                    <div class="tabs-container">
                        <div class="tabs-right">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-psikotest-administrasi">Administrasi</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-psikotest-keamanan">Keamanan</a></li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab-psikotest-administrasi" class="tab-pane active">
                                    <div class="panel-body">
                                        <div id="toolvote-psikotest-administrasi" style="display:none;">

                                            <div class="row dashboard-header">

                                                <div class="col-md-11">
                                                    <input id="upvote-psikotest-administrasi" name="">
                                                </div>
                                                <div class="col-md-1">
                                                 <button id="btn-upvote-psikotest-administrasi"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>

                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-md-12">

                                        <table class="table table-striped " id="table-psikotest-administrasi"> 
                                            <thead>
                                                <tr>
                                                    <th>NIK</th>
                                                    <th>Nama</th>
                                                    <th>A</th>
                                                    <th>P</th>
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
                            <div id="tab-psikotest-keamanan" class="tab-pane ">
                                <div class="panel-body">
                                    <div id="toolvote-psikotest-keamanan" style="display:none;">

                                        <div class="row dashboard-header">

                                            <div class="col-md-11">
                                                <input id="upvote-psikotest-keamanan" name="">
                                            </div>
                                            <div class="col-md-1">
                                                <button id="btn-upvote-psikotest-keamanan"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <table class="table table-striped " id="table-psikotest-keamanan">
                                            <thead>
                                                <tr>
                                                    <th>NIK</th>
                                                    <th>Nama</th>
                                                    <th>A</th>
                                                    <th>P</th>
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


    table_psikotest_administrasi = $('#table-psikotest-administrasi').DataTable({ 
     "bLengthChange": false,
     "bAutoWidth": false ,
     "processing": true, 
     "serverSide": true, 
     "order": [], 

     "ajax": {
        "url": '<?php echo site_url('personalia/jsonDaftarNilai/psikotest/administrasi'); ?>',
        "type": "POST"
    },
    "columns": [
    {"data": "nik"},
    {"data": "nama"},
    {"data": "nilai_akademik"},
    {"data": "nilai_psikotest"},
    {"data": "rata_rata"},
    {"data": "nik"}
    ],
    dom: 'l<"#administrasi.toolbar">frtip',
    initComplete: function(){
      $("div#administrasi")
      .html('<button type="button" id="btn-show-toolvote-psikotest-administrasi" class="btn btn-primary" >Seleksi [+]</button> <button type="button" id="btn-input-psikotest-administrasi" class="btn btn-info" >Input Nilai</button>'); 

      $('#btn-show-toolvote-psikotest-administrasi').click(function() {
        $('#toolvote-psikotest-administrasi').toggle();
        if ($('#btn-show-toolvote-psikotest-administrasi').html() === 'Seleksi [+]') {
            $('#btn-show-toolvote-psikotest-administrasi').html('Seleksi [-]');
        }
        else {
            $('#btn-show-toolvote-psikotest-administrasi').html('Seleksi [+]');
        }
    });
      $("#upvote-psikotest-administrasi").ionRangeSlider({

        min: 0,
        max:  this.api().rows().count(),
    });

      $('#btn-upvote-psikotest-administrasi').click(function() {
        var jumlah = $('#upvote-psikotest-administrasi').val();
        var status = '3';
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
          table_psikotest_administrasi.ajax.reload();
          console.log("complete");
      });
      
  });
      var x = $("#upvote-psikotest-administrasi").data("ionRangeSlider");
      console.log(jQuery.isEmptyObject(x));
  },
  "drawCallback" : function(settings) {
    if (!jQuery.isEmptyObject($("#upvote-psikotest-administrasi").data("ionRangeSlider"))) 
     {
        var anu = $("#upvote-psikotest-administrasi").data("ionRangeSlider");
        anu.update({
          max : this.api().rows().count(),
          from : 0
      })
    }
}
});

      table_psikotest_keamanan = $('#table-psikotest-keamanan').DataTable({ 
     "bLengthChange": false,
     "bAutoWidth": false ,
     "processing": true, 
     "serverSide": true, 
     "order": [], 

     "ajax": {
        "url": '<?php echo site_url('personalia/jsonDaftarNilai/psikotest/keamanan'); ?>',
        "type": "POST"
    },
    "columns": [
    {"data": "nik"},
    {"data": "nama"},
    {"data": "nilai_akademik"},
    {"data": "nilai_psikotest"},
    {"data": "rata_rata"},
    {"data": "nik"}
    ],
    dom: 'l<"#keamanan.toolbar">frtip',
    initComplete: function(){
      $("div#keamanan")
      .html('<button type="button" id="btn-show-toolvote-psikotest-keamanan" class="btn btn-primary" >Seleksi [+]</button> <button type="button" id="btn-input-psikotest-keamanan" class="btn btn-info" >Input Nilai</button>'); 

      $('#btn-show-toolvote-psikotest-keamanan').click(function() {
        $('#toolvote-psikotest-keamanan').toggle();
        if ($('#btn-show-toolvote-psikotest-keamanan').html() === 'Seleksi [+]') {
            $('#btn-show-toolvote-psikotest-keamanan').html('Seleksi [-]');
        }
        else {
            $('#btn-show-toolvote-psikotest-keamanan').html('Seleksi [+]');
        }
    });
      $("#upvote-psikotest-keamanan").ionRangeSlider({

        min: 0,
        max:  this.api().rows().count(),
    });

      $('#btn-upvote-psikotest-keamanan').click(function() {
        var jumlah = $('#upvote-psikotest-keamanan').val();
        var status = '3';
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
          table_psikotest_keamanan.ajax.reload();
          console.log("complete");
      });
      
  });
      var x = $("#upvote-psikotest-keamanan").data("ionRangeSlider");
      console.log(jQuery.isEmptyObject(x));
  },
  "drawCallback" : function(settings) {
    if (!jQuery.isEmptyObject($("#upvote-psikotest-keamanan").data("ionRangeSlider"))) 
     {
        var anu = $("#upvote-psikotest-keamanan").data("ionRangeSlider");
        anu.update({
          max : this.api().rows().count(),
          from : 0
      })
    }
}
});

});

</script>