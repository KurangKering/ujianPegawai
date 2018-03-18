
<style type="text/css" media="screen">
  input[type="radio"]:checked+label 
  {
    text-decoration: underline;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="row">

         <div class="col-lg-12 ">
          <div class="alert alert-primary col-md-5">
            <table class="table table-bordered" style="margin-bottom: 0px">
              <tr><td width="30%">Tanggal</td><td width="70%"><?php echo $pengaturan['konfig_periode']['tanggal_ujian_akademik']; ?></td></tr>
              <tr><td>Mata Pelajaran</td><td><?php echo $matpel['nama_pelajaran'] ?></td></tr>
            </table>
          </div>
          <div class="col-md-2"></div>
          <div class="alert  col-md-5">
            <table class="table table-bordered" style="margin-bottom: 0px">
              <tr><td width="30%">Jumlah Soal</td><td width="70%"><?php echo count($kumpulan_soal) . ' Buah' ?></td></tr>
              <tr><td>Total Waktu</td><td><?php echo $pengaturan['konfig_umum']['durasi_ujian_akademik'] . ' Menit'; ?> </td></tr>
            </table>
          </div>
        </div>
      </div>
      <div id="timer" style="font-weight: bold" class="btn btn-danger"></div>

    </div>
    <div class="ibox-content">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">

          <form method="post" id="form-soal">
            <?php $pilihan = array('A', 'B', 'C', 'D'); ?>
              <?php foreach ($kumpulan_soal as $index => $soal): ?>
              <table class="table">
                <thead>
                  <tr>
                    <th colspan="2"><?php echo $soal['soal']; ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pilihan as $key => $v): ?>
                    <?php $tmp = isset($log_pilihan[$soal['id_soal']]) ? $log_pilihan[$soal['id_soal']] : ""; ?>
                    <tr>
                      <td> 
                        <div class="radio radio-success">
                          <input type="radio" <?= $v === $tmp ? "checked" : "" ?> name="<?php echo $soal['id_soal'] ?>" id="<?php echo 'pilihan_'.$v.'_'.$soal['id_soal'] ;?>" value="<?php echo $v; ?>">
                          <label for="<?php echo 'pilihan_'.$v.'_'.$soal['id_soal'] ;?>">
                            <?php echo $soal['pilihan_' . $v] ?>
                          </label>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            <?php endforeach ?>
            

            <div class="" id="button-area">
              <div class="pull-left">
                <?php  echo $this->pagination->create_links(); ?>
              </div>

              <div class="pull-right">
                <button type="button" class="btn btn-danger" id="btn-selesai">Selesai</button>
              </div>
            </div>
            
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
</div>


<script type="text/javascript">





$(document).ready(function() {
  var waktu_selesai = "<?php echo $waktu_selesai; ?>";
  var current_date = "<?php echo $current_date ?>";


  $("#timer")
  .countdown(waktu_selesai, function(event) {
    $(this).text(

      event.strftime('Waktu Tersisa : %H Jam :%M Menit :%S Detik')
      );
  }).on('finish.countdown', function() {
    $("#btn-selesai").click();
  });


  $("#btn-selesai").click(function(event) {
    var formData = $('#form-soal').serializeArray();
    $.ajax({
      url: '<?php echo base_url('pelamar/jsonSetLogUjian') ?>',
      type: 'POST',
      dataType: 'json',
      data: {data: formData},
    })
    .done(function() {

      console.log("success");
    })
    .fail(function(e) {
      console.log(e);
    })
    .always(function() {
     $.ajax({
      url: '<?php echo base_url('pelamar/ujianAkademik'); ?>',
      type: 'POST',
      dataType: 'json',
      data: {selesai: 'selesai'},
    })
     .done(function() {
      console.log("success");
    })
     .fail(function(e) {
      console.log("error");
    })
     .always(function() {
      console.log("complete");
      window.location.href = "<?php echo site_url('pelamar/ujianAkademik'); ?>";



    });
   });

  });

  if (current_date > waktu_selesai) {
    $("#btn-selesai").click();

  };



  $('.save').click(function(e)  {
    e.preventDefault();
    var link = $(this).find('a').attr('href');
    var formData = $('#form-soal').serializeArray();
    $.ajax({
      url: '<?php echo base_url('pelamar/jsonSetLogUjian') ?>',
      type: 'POST',
      dataType: 'json',
      data: {data: formData},
    })
    .done(function() {

      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      window.location.href = link;

    });



    
  });
});

</script>