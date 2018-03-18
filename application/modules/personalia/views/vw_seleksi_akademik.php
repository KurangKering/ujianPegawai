<style type="text/css" media="screen">
  .toolbar {
    float: left;
  }
</style>

<div class="row">
  <div class="col-lg-12">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
        <li class=""><a href="<?php echo base_url('personalia/seleksi/administrasi/') ?>">Administrasi</a></li>
        <li class="active"><a  href="<?php echo base_url('personalia/seleksi/akademik') ?>">Akademik</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/psikotest') ?>">Psikotest</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/wawancara') ?>">Wawancara</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/diterima') ?>">Diterima</a></li>
      </ul>
      <div class="tab-content">

       <div id="tab-1" class="tab-pane active">

        <div class="panel-body">

          <div class="row">
            <div class="col-md-12">
              <div class="form-horizontal"> 
                <div class="form-group"><label class="col-lg-1 control-label">Jabatan</label>

                  <div class="col-lg-4">
                    <select class="form-control m-b" name="fakultas-subbag" id="fakultas-subbag">
                      <option selected disabled>-</option>
                      <?php if (isset($last_jabatan)): ?>
                        <?php foreach ($last_jabatan as $key => $value): ?>
                          <option data-id_fakultas="<?php echo $value['id_fakultas'] ?>" data-id_subbag="<?php echo $value['id_subbag'] ?>"><?php echo $value['nama_fakultas'] . ' - ' . $value['nama_subbag'];  ?></option>
                        <?php endforeach ?>
                      <?php endif ?>
                    </select>
                  </div>

                 <!--  <div class="col-lg-1">
                    <button type="button" class="btn btn-info" id="btn-cari">Cari</button>
                  </div> -->

                </div>
              </div>
              <div class="hr-line-dashed"></div>
            </div>
          </div>
          <div id="form-form">

          </div>
          <div id="tool-seleksi" style="display:none;">

            <div class="row dashboard-header">

              <div class="col-md-11">
                <input id="total-seleksi" name="">
              </div>
              <div class="col-md-1">
                <button id="btn-seleksi"  class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>
              </div>
            </div>
          </div>
          <table class="table table-striped" id="table-akademik">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Fakultas</th>
                <th>Sub Bagian</th>
                <th>Nilai</th>
              </tr>
            </thead>

          </table>
        </div>
      </div>

    </div>
  </div>
</div>
</div>


<script type="text/javascript">
  $(document).ready(function(){


    table_akademik = $('#table-akademik').DataTable({ 
     "bLengthChange": false,

     "bAutoWidth": false ,
     "processing": true, 
     "serverSide": true, 
     "order": [], 

     "ajax": {
      "url": '<?php echo site_url('personalia/jsonDaftarNilai/akademik'); ?>',
      "type": "POST"
    },
    "columns": [
    {"data": "nik"},
    {"data": "nama"},
    {"data": "nama_fakultas"},
    {"data": "nama_subbag"},
    {"data": "nilai_akademik"},
    ],
    dom: 'l<"#administrasi.toolbar">frtip',
    initComplete: function() {

     $("div#administrasi")
     .html('<button type="button" id="btn-show-seleksi" style="display: none" class="btn btn-primary" >Seleksi [+]</button> &nbsp;&nbsp; <button class="btn btn-info" id="btn-cetak-akademik" style="display:none" type="button">Cetak Data</button>');
     $('#btn-show-seleksi').click(function() {

      $('#tool-seleksi').toggle();
      if ($('#btn-show-seleksi').html() === 'Seleksi [+]') {
        $('#btn-show-seleksi').html('Seleksi [-]');
      }
      else {
        $('#btn-show-seleksi').html('Seleksi [+]');
      }
    });
     $("#total-seleksi").ionRangeSlider({
      min: 0,
      max: this.api().rows().count()
    });


     $("#btn-cetak-akademik").click(function(e){

       var subbag = $( "#fakultas-subbag option:selected" ).data('id_subbag');
       var fakultas = $( "#fakultas-subbag option:selected" ).data('id_fakultas');
       var tahap = '2';
       var   newForm = jQuery('<form>', {
        'action' : '<?php echo site_url() . 'personalia/cetak_data' ?>',
        'target' : '_blank',
        'method' : 'post'
      }).append(jQuery('<input>', {
        'name' : 'tahap',
        'value' : tahap,
        'type' : 'hidden'
      })).
      append(jQuery('<input>', {
        'name' : 'id_fakultas',
        'value' : fakultas,
        'type' : 'hidden'
      })).
      append(jQuery('<input>', {
        'name' : 'id_subbag',
        'value' : subbag,
        'type' : 'hidden'
      }));
      newForm.appendTo($('#form-form'));
      newForm.submit();

    });
     $('#btn-seleksi').click(function() {

      var jumlah = $('#total-seleksi').val();
      var status = '2';
      var subbag = $( "#fakultas-subbag option:selected" ).data('id_subbag');
      var fakultas = $( "#fakultas-subbag option:selected" ).data('id_fakultas');
      var data = {
        jumlah : jumlah,
        status : status,
        id_fakultas : fakultas,
        id_subbag : subbag
      };
      $.ajax({
        url: '<?php echo site_url('personalia/naikTingkat') ?>',
        type: 'POST',
        data: data,
        beforeSend: function(  ) {
          showPleaseWait();
        }
      })
      .done(function(data) {
        console.log('selesai');
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {

        table_akademik.ajax.reload();
        hidePleaseWait();

        console.log("complete");
      });

    });


     var now = "<?php echo date('Y-m-d H:i:s'); ?>";
     var tanggal_ujian_akademik = "<?php echo $pengaturan['konfig_periode']['full_ujian_akademik'] ?>";
     var tanggal_ujian_psikotest = "<?php echo $pengaturan['konfig_periode']['full_ujian_psikotest'] ?>";
     if (now > tanggal_ujian_akademik && now < tanggal_ujian_psikotest) {
      $('#btn-show-seleksi').toggle();
      $('#btn-cetak-akademik').toggle();
    }

  },

  "drawCallback" : function(settings) {

   if (!jQuery.isEmptyObject($("#total-seleksi").data("ionRangeSlider"))) 
   {
    var anu = $("#total-seleksi").data("ionRangeSlider");
    anu.update({
      max : this.api().data().count(),
      from : 0
    })
  }
}

});
    $("#fakultas").change(function(event) {
      $('#subbag').empty();
      id_fakultas = $(this).val();
      $.ajax({
       url: '<?php echo site_url(). 'personalia/jsonGetListSubbagLastPeriode' ?>',
       type: 'POST',
       dataType: 'JSON',
       data: {id_fakultas : id_fakultas},
     })
      .done(function(tmp) {
       $.each(tmp, function(i, el){
        $("#subbag").append($('<option>', {
          value: el.id_subbag,
          text : el.nama_subbag
        }))
      });
     })
      .fail(function() {
       console.log("error");
     })
      .always(function() {
       console.log("complete");
     });


    });

    $("#fakultas-subbag").change(function() {
      var id_fakultas = $("#fakultas-subbag option:selected").data('id_fakultas');
      var id_subbag = $("#fakultas-subbag option:selected").data('id_subbag');
      var url = '<?php echo site_url('personalia/jsonDaftarNilai/akademik/'); ?>';
      table_akademik.ajax.url(url + id_fakultas + "/" + id_subbag ).load();
    })

    $("#btn-cari").click(function(event) {
      var id_fakultas = $("#fakultas-subbag option:selected").data('id_fakultas');
      var id_subbag = $("#fakultas-subbag option:selected").data('id_subbag');
      var url = '<?php echo site_url('personalia/jsonDaftarNilai/akademik/'); ?>';
      table_akademik.ajax.url(url + id_fakultas + "/" + id_subbag ).load();
    });
  });
/**
 * Displays overlay with "Please wait" text. Based on bootstrap modal. Contains animated progress bar.
 */
 function showPleaseWait() {
  var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
  <div class="modal-dialog" id="modal-dialog">\
    <div class="modal-content">\
      <div class="modal-header">\
        <h4 class="modal-title">Mohon Tunggu...</h4>\
      </div>\
      <div class="modal-body">\
        <div class="progress">\
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
          aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
        </div>\
      </div>\
    </div>\
  </div>\
</div>\
</div>';
$(document.body).append(modalLoading);
$("#pleaseWaitDialog").modal("show");
}

/**
 * Hides "Please wait" overlay. See function showPleaseWait().
 */
 function hidePleaseWait() {
  $("#pleaseWaitDialog").modal("hide");
}


</script>

