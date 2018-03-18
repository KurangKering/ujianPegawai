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
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/psikotest') ?>">Psikotest</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/wawancara') ?>">Wawancara</a></li>
        <li class="active"><a  href="<?php echo base_url('personalia/seleksi/diterima') ?>">Diterima</a></li>
      </ul>
      <div class="tab-content">
       <div id="tab-1" class="tab-pane active">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
             <div class="form-group">

              <label class="col-lg-1 control-label">Jabatan</label>

              <div class="col-lg-4">
                <select class="form-control m-b" name="fakultas-subbag" id="fakultas-subbag">
                  <option data-id_fakultas="" data-id_subbag="" selected>-semua fakultas-</option>
                  <?php if (isset($last_jabatan)): ?>
                    <?php foreach ($last_jabatan as $key => $value): ?>
                      <option data-id_fakultas="<?php echo $value['id_fakultas'] ?>" data-id_subbag="<?php echo $value['id_subbag'] ?>"><?php echo $value['nama_fakultas'] . ' - ' . $value['nama_subbag'];  ?></option>
                    <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div>

          <!--     <div class="col-lg-1">
                <button type="button" class="btn btn-info" id="btn-cari">Cari</button>
              </div>
            -->


          </div>
        </div>
      </div>
      <div id="form-form"></div>
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
      <table class="table table-striped" id="table-diterima">
        <thead>
          <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Fakultas</th>
            <th>Sub Bgian</th>
            <th>Rata-Rata</th>
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


    table_diterima = $('#table-diterima').DataTable({ 
     "bLengthChange": false,

     "bAutoWidth": false ,
     "processing": true, 
     "serverSide": true, 
     "order": [], 

     "ajax": {
      "url": '<?php echo site_url('personalia/jsonDaftarNilai/diterima'); ?>',
      "type": "POST"
    },
    "columns": [
    {"data": "nik"},
    {"data": "nama"},
    {"data": "nama_fakultas"},
    {"data": "nama_subbag"},
    {"data": "rata_rata"},
    ],
    'columnDefs': [
    {
      "targets": 0,
      "className": "text-center",
    }
    ,
    {
      "targets": 2,
      "className": "text-center",
    },
    {
      "targets": 3,
      "className": "text-center",
    },
    {
      "targets": 4,
      "className": "text-center",
    }
    ],
    order: [[1, 'desc']],
    dom: 'l<"#administrasi.toolbar">frtip',
    initComplete: function() {
     $("div#administrasi")
     .html('<button class="btn btn-info" id="btn-cetak-diterima" style="" type="button">Cetak Data</button>');


     $("#btn-cetak-diterima").click(function(e){

       var subbag = $( "#fakultas-subbag option:selected" ).data('id_subbag');
       var fakultas = $( "#fakultas-subbag option:selected" ).data('id_fakultas');
       var tahap = '4';
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
   },
 });

    $("#fakultas-subbag").change(function() {
      var id_fakultas = $("#fakultas-subbag option:selected").data('id_fakultas');
      var id_subbag = $("#fakultas-subbag option:selected").data('id_subbag');
      var url = '<?php echo site_url('personalia/jsonDaftarNilai/diterima/'); ?>';
      table_diterima.ajax.url(url + id_fakultas + "/" + id_subbag ).load();
    })


    


    $("#btn-cari").click(function(event) {

      var id_fakultas = $("#fakultas-subbag option:selected").data('id_fakultas');
      var id_subbag = $("#fakultas-subbag option:selected").data('id_subbag');
      var url = '<?php echo site_url('personalia/jsonDaftarNilai/diterima/'); ?>';
      table_diterima.ajax.url(url + id_fakultas + "/" + id_subbag ).load();
    });

    $("#jabatan").change(function(event) {
      var id_jabatan = $(this).val();
      var url = '<?php echo site_url('personalia/jsonDaftarNilai/diterima/'); ?>';
      table_akademik.ajax.url(url + id_jabatan).load();
    });
  });

</script>

