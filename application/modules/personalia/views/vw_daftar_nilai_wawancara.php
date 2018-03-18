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
              <li class="active"><a  href="<?php echo base_url('personalia/daftarnilai/wawancara') ?>">Wawancara</a></li>
              <li class=""><a  href="<?php echo base_url('personalia/daftarnilai/diterima') ?>"">Diterima</a></li>
          </ul>
          <div class="tab-content">
            <div class="row">

                <div class="col-lg-12">
                    <div class="tabs-container">
                        <div class="tabs-right">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-wawancara-administrasi">Administrasi</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-wawancara-keamanan">Keamanan</a></li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab-wawancara-administrasi" class="tab-pane active">
                                    <div class="panel-body">
                                        <div id="toolvote-wawancara-administrasi" style="display:none;">

                                            <div class="row dashboard-header">

                                                <div class="col-md-11">
                                                    <input id="upvote-wawancara-administrasi" name="">
                                                </div>
                                                <div class="col-md-1">
                                                    <button id="btn-upvote-wawancara-administrasi"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <table class="table table-striped " id="table-wawancara-administrasi">
                                                <thead>
                                                    <tr>
                                                        <th>NIK</th>
                                                        <th>Nama</th>
                                                        <th>A</th>
                                                        <th>P</th>
                                                        <th>W</th>
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
                                <div id="tab-wawancara-keamanan" class="tab-pane " >
                                    <div class="panel-body">
                                        <div id="toolvote-wawancara-keamanan" style="display:none;">

                                            <div class="row dashboard-header">

                                                <div class="col-md-11">
                                                    <input id="upvote-wawancara-keamanan" name="">
                                                </div>
                                                <div class="col-md-1">
                                                 <button id="btn-upvote-wawancara-keamanan"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-md-12">

                                        <table class="table table-striped " id="table-wawancara-keamanan">
                                            <thead>
                                                <tr>
                                                    <th>NIK</th>
                                                    <th>Nama</th>
                                                    <th>A</th>
                                                    <th>P</th>
                                                    <th>W</th>
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


    table_wawancara_administrasi = $('#table-wawancara-administrasi').DataTable({ 
     "bLengthChange": false,
     "bAutoWidth": false ,
     "processing": true, 
     "serverSide": true, 
     "order": [], 

     "ajax": {
        "url": '<?php echo site_url('personalia/jsonDaftarNilai/wawancara/administrasi'); ?>',
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

    dom: 'l<"#administrasi.toolbar">frtip',
    initComplete: function(){
        $("div#administrasi")
        .html('<button type="button" id="btn-show-toolvote-wawancara-administrasi" class="btn btn-primary" >Seleksi [+] </button> <button type="button" id="btn-input-wawancara-administrasi" class="btn btn-info" >Input Nilai</button>'); 

        $('#btn-show-toolvote-wawancara-administrasi').click(function() {
            $('#toolvote-wawancara-administrasi').toggle();
            if ($('#btn-show-toolvote-wawancara-administrasi').html() === 'Seleksi [+]') {
                $('#btn-show-toolvote-wawancara-administrasi').html('Seleksi [-]');
            }
            else {
                $('#btn-show-toolvote-wawancara-administrasi').html('Seleksi [+]');
            }
        });

        $("#upvote-wawancara-administrasi").ionRangeSlider({

            min: 0,
            max: this.api().rows().count(),
        });

        $('#btn-upvote-wawancara-administrasi').click(function() {
            var jumlah = $('#upvote-wawancara-administrasi').val();
            var status = '4';
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
            table_wawancara_administrasi.ajax.reload();
            console.log("complete");
        });

      });
        var x = $("#upvote-wawancara-administrasi").data("ionRangeSlider");
        console.log(jQuery.isEmptyObject(x));
    },
    "drawCallback" : function(settings) {
        if (!jQuery.isEmptyObject($("#upvote-wawancara-administrasi").data("ionRangeSlider"))) 
        {
            var anu = $("#upvote-wawancara-administrasi").data("ionRangeSlider");
            anu.update({
              max : this.api().rows().count(),
              from : 0
          })
        }
    }
});

    table_wawancara_keamanan = $('#table-wawancara-keamanan').DataTable({ 
     "bLengthChange": false,
     "bAutoWidth": false ,
     "processing": true, 
     "serverSide": true, 
     "order": [], 

     "ajax": {
        "url": '<?php echo site_url('personalia/jsonDaftarNilai/wawancara/keamanan'); ?>',
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


    dom: 'l<"#keamanan.toolbar">frtip',
    initComplete: function(){
        $("div#keamanan")
        .html('<button type="button" id="btn-show-toolvote-wawancara-keamanan" class="btn btn-primary" >Seleksi [+]</button> <button type="button" id="btn-input-wawancara-keamanan" class="btn btn-info" >Input Nilai</button>'); 

        $('#btn-show-toolvote-wawancara-keamanan').click(function() {
            $('#toolvote-wawancara-keamanan').toggle();
            if ($('#btn-show-toolvote-wawancara-keamanan').html() === 'Seleksi [+]') {
                $('#btn-show-toolvote-wawancara-keamanan').html('Seleksi [-]');
            }
            else {
                $('#btn-show-toolvote-wawancara-keamanan').html('Seleksi [+]');
            }
        }) ;
        $("#upvote-wawancara-keamanan").ionRangeSlider({

            min: 0,
            max:  this.api().rows().count(),
        });

        $('#btn-upvote-wawancara-keamanan').click(function() {
            var jumlah = $('#upvote-wawancara-keamanan').val();
            var status = '4';
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
            table_wawancara_keamanan.ajax.reload();
              console.log("complete");
          });

      });
        var x = $("#upvote-wawancara-keamanan").data("ionRangeSlider");
        console.log(jQuery.isEmptyObject(x));
    },
    "drawCallback" : function(settings) {
        if (!jQuery.isEmptyObject($("#upvote-wawancara-keamanan").data("ionRangeSlider"))) 
        {
            var anu = $("#upvote-wawancara-keamanan").data("ionRangeSlider");
            anu.update({
              max : this.api().rows().count(),
              from : 0
          })
        }
    }
});

});

</script>