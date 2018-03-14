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
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/akademik') ?>">Akademik</a></li>
        <li class="active"><a  href="<?php echo base_url('personalia/seleksi/psikotest') ?>">Psikotest</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/wawancara') ?>">Wawancara</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/diterima') ?>">Diterima</a></li>
      </ul>
      <div class="tab-content">
       <div id="tab-1" class="tab-pane active">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-horizontal"> 
                <div class="form-group">
                  <label class="col-lg-1 control-label">Jabatan</label>

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
          <table class="table table-striped" id="table-psikotest">
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
<div class="modal inmodal fade" id="modal-psikotest" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated rubberBand">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Input Nilai Psikotest</h4>
        <h3 class="modal-title"><span id="last_jabatan"></span></h3>
      </div>
      <div class="modal-body">
        <form method="get" class="form-horizontal" id="form-psikotest">
          <input type="hidden" id="id_fakultas" name="id_fakultas">
          <input type="hidden" id="id_subbag" name="id_subbag">
          <input type="hidden" id="tahap" name="tahap" value="2">
          <div class="modal-body">
            <div id="wadah">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="submitNilai()" id="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){


    table_psikotest = $('#table-psikotest').DataTable({ 
     "bLengthChange": false,

     "bAutoWidth": false ,
     "processing": true, 
     "serverSide": true, 
     "order": [], 

     "ajax": {
      "url": '<?php echo site_url('personalia/jsonDaftarNilai/psikotest'); ?>',
      "type": "POST"
    },
    "columns": [
    {"data": "nik"},
    {"data": "nama"},
    {"data": "nama_fakultas"},
    {"data": "nama_subbag"},
    {"data": "nilai_psikotest"},
    ],
    dom: 'l<"#administrasi.toolbar">frtip',
    initComplete: function() {

     $("div#administrasi")
     .html('<button class="btn btn-empty" id="btn-modal-psikotest" style="display:none" type="button">Input Nilai</button> &emsp; <button type="button" id="btn-show-seleksi" style="display:none" class="btn btn-warning" >Seleksi [+]</button> &emsp;<button class="btn btn-info" id="btn-cetak-psikotest" style="display:none" type="button">Cetak Data</button>');

     $('#btn-modal-psikotest').click(function(event) {


      var last_jabatan =  $("#fakultas-subbag option:selected");
      showModals(last_jabatan);
    });


     $('#btn-show-seleksi').click(function() {

      $('#tool-seleksi').toggle('fast');
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
     $("#btn-cetak-psikotest").click(function(e){

       var subbag = $( "#fakultas-subbag option:selected" ).data('id_subbag');
       var fakultas = $( "#fakultas-subbag option:selected" ).data('id_fakultas');
       var tahap = '3';
       var   newForm = jQuery('<form>', {
        'action' : '<?php echo site_url() . 'personalia/cetak_data' ?>',
        'target' : '_blank',
        'method' : 'post'
      }).append(jQuery('<input>', {
        'name' : 'tahap',
        'value' : tahap,
        'type' : 'hidden'
      }))
      // .
      // append(jQuery('<input>', {
      //   'name' : 'id_fakultas',
      //   'value' : fakultas,
      //   'type' : 'hidden'
      // })).
      // append(jQuery('<input>', {
      //   'name' : 'id_subbag',
      //   'value' : subbag,
      //   'type' : 'hidden'
      // }));
      newForm.appendTo($('#form-form'));
      newForm.submit();

    });


     $('#btn-seleksi').click(function() {

       var jumlah = $('#total-seleksi').val();
       var status = '3';
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
        beforeSend : function() {
          showPleaseWait();
        }
      })
      .done(function(data) {

      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        table_psikotest.ajax.reload();
        hidePleaseWait();
        console.log("complete");
      });

    });

     var now = "<?php echo date('Y-m-d H:i:s'); ?>";
     var tanggal_ujian_psikotest = "<?php echo $pengaturan['konfig_periode']['full_ujian_psikotest'] ?>";
     var tanggal_ujian_wawancara = "<?php echo $pengaturan['konfig_periode']['full_ujian_wawancara'] ?>";
     if (now > tanggal_ujian_psikotest && now < tanggal_ujian_wawancara) {
      $('#btn-show-seleksi').toggle();
      $('#btn-modal-psikotest').toggle();
      $('#btn-cetak-psikotest').toggle();

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
      var url = '<?php echo site_url('personalia/jsonDaftarNilai/psikotest/'); ?>';
      table_psikotest.ajax.url(url + id_fakultas + "/" + id_subbag ).load();
    })
    $("#btn-cari").click(function(event) {
      var id_fakultas = $("#fakultas-subbag option:selected").data('id_fakultas');
      var id_subbag = $("#fakultas-subbag option:selected").data('id_subbag');
      var url = '<?php echo site_url('personalia/jsonDaftarNilai/psikotest/'); ?>';
      table_psikotest.ajax.url(url + id_fakultas + "/" + id_subbag ).load();
    });
  });



/**
 * Displays overlay with "Please wait" text. Based on bootstrap modal. Contains animated progress bar.
 */
 function showPleaseWait() {
   var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
   <div class="modal-dialog" id="modal-dialog">\
   <div class="modal-content">\
   <div class="modal-body">\
   <div class="sk-spinner sk-spinner-three-bounce">\
   <div class="sk-bounce1"></div>\
   <div class="sk-bounce2"></div>\
   <div class="sk-bounce3"></div>\
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


 //Tampilkan Modal 
 function showModals( last_jabatan)
 {
  id_fakultas = last_jabatan.data('id_fakultas');
  id_subbag = last_jabatan.data('id_subbag');
  showPleaseWait();
  clearModals();
  $.ajax({
    type: "POST",
    url: "<?php echo base_url('personalia/kelolaNilai'); ?>",
    dataType: 'json',
    data: {id_fakultas:id_fakultas, id_subbag:id_subbag,tahap : "2", tipe:"get"},
    success: function(res) {
      hidePleaseWait();
      setModalData(res, last_jabatan);
    }
  });
}

function submitNilai()
{
  var formData = $("#form-psikotest").serialize();
  showPleaseWait();

  $.ajax({
    type: "POST",
    url: "<?php echo base_url('personalia/kelolaNilai'); ?>",
    dataType: 'json',
    data: formData+"&tipe=input",
  })
  .done(function() {
    console.log("success");
    hidePleaseWait(); 
  })
  .fail(function() {
    console.log("error");
    hidePleaseWait();
  })
  .always(function() {
    $("#modal-psikotest").modal("hide");

    table_psikotest.ajax.reload();

    console.log("complete");
  });

}

function setModalData( res , last_jabatan)
{

  $("#id_fakultas").val(last_jabatan.data('id_fakultas'));
  $("#id_subbag").val(last_jabatan.data('id_subbag'));
  $("#wadah").html(res);
  $("#last_jabatan").html(last_jabatan.text());
  $("#modal-psikotest").modal("show");
}


function clearModals()
{
  $("#removeWarning").hide();
  $("#id_jabatan").val("").removeAttr( "disabled" );
  $("#id_fakultas").val("").removeAttr( "disabled" );
  $("#id_subbag").val("").removeAttr( "disabled" );
  $("#wadah").html("");
  $("#last_jabatan").html("");


}


</script>

