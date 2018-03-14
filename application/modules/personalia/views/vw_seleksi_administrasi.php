<?php 
$now = date('Y-m-d H:i:s');
$tanggal_ujian_akademik = $pengaturan['konfig_periode']['full_ujian_akademik'];
$isMasih= $now < $tanggal_ujian_akademik ? true : false;
?>
<style type="text/css" media="screen">
    #previewing {
        width: 250px;
        height: 300px;
    }
</style>
<style type="text/css" media="screen">
    .toolbar {
      float: left;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
        <li class="active"><a href="<?php echo base_url('personalia/seleksi/administrasi/') ?>">Administrasi</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/akademik') ?>">Akademik</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/psikotest') ?>">Psikotest</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/wawancara') ?>">Wawancara</a></li>
        <li class=""><a  href="<?php echo base_url('personalia/seleksi/diterima') ?>">Diterima</a></li>
    </ul>
    <div class="tab-content">
     <div id="tab-1" class="tab-pane active">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-2 col-lg-offset-1">
                    <div class="ibox float-e-margins border-bottom border-left border-right">

                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $total['total'] ?></h1>
                            <small>Total Pelamar</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="ibox float-e-margins border-bottom border-left border-right">

                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $total['ditolak'] ?></h1>
                            <small>Ditolak</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="ibox float-e-margins border-bottom border-left border-right">

                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $total['belum'] ?></h1>
                            <small>Belum Verifikasi</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ibox float-e-margins border-bottom border-left border-right">

                        <div class="ibox-content">
                           <table class="table" width="100%">
                            <thead>

                                <header id="header" class=""><h4 class="no-margins">Detail Telah Verifikasi</h4>
                                </thead>

                            </header><!-- /header -->                                <tbody>
                                <?php foreach ($total['detail_jabatan_periode'] as $key => $value): ?>
                                   <tr>
                                       <td><small><?php echo $value['keterangan'] ?></small></td>
                                       <td><?php echo $value['jumlah'] ?></td>
                                   </tr>
                               <?php endforeach ?>
                               <tr>
                                   <td class="text-right"><strong>Total</strong></td>
                                   <td><?php echo $total['diverifikasi']; ?></td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>

       </div>
       <?php if (!isset($result) || $isMasih): ?>
          <div class="row  border-bottom white-bg dashboard-header">
            <div class="col-md-12">
                <h2>Tidak Ada Data</h2>
            </div>
        </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins" id="ibox-verifikasi">

                        <div class="ibox-content">
                            <div class="sk-spinner sk-spinner-three-bounce">
                                <div class="sk-bounce1"></div>
                                <div class="sk-bounce2"></div>
                                <div class="sk-bounce3"></div>
                            </div>
                            <form method="post" class="form-horizontal" id="form-verifikasi">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="hidden" name="nik" id="nik" value="<?php echo $result['nik']; ?>">
                                        <div class="form-group"><label class="col-lg-2 control-label">NIK</label>
                                            <div class="col-lg-10"><p class="form-control-static"><?php echo $result['nik'] ?></p></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Nama</label>
                                            <div class="col-lg-10"><p class="form-control-static"><?php echo $result['nama'] ?></p></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-10"><p class="form-control-static"><?php echo $result['email'] ?></p></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Fakultas</label>
                                            <div class="col-lg-10"><p class="form-control-static"><?php echo $result['nama_fakultas'] ?></p></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Sub Bagian</label>
                                            <div class="col-lg-10"><p class="form-control-static"><?php echo $result['nama_subbag'] ?></p></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Berkas</label>
                                            <div class="col-lg-10"><p class="form-control-static"><a href="<?php echo site_url('personalia/tampilpdf?file=') . $result['file_lamaran']; ?>" target="_blank">Lihat</a></p></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center border-left">
                                        <div class="m-b-xl ">
                                            <img alt="image" class="" id="previewing" src="<?php echo base_urL('files/photo/') . $result['file_photo']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <div class="">
                                                <button class="btn btn-danger" type="submit" name="verif" value="-1">Tolak Verifikasi</button>
                                                <button class="btn btn-primary" type="submit" name="verif" value="1" >Verifikasi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function(){

                    $('button[type="submit"').click(function(e) {
                        e.preventDefault();
                        var nik = $('#nik').val();
                        var verif = $(this).val();
                        var formData = {nik : nik , verif : verif};

                        $('#ibox-verifikasi').children('.ibox-content').addClass('sk-loading');
                        $.ajax({
                            url: '<?php echo site_url() . 'personalia/seleksi_administrasi' ?>',
                            type: 'POST',
                            data: formData,
                        })
                        .done(function() {
                            console.log("success");
                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("complete");
                            $('#ibox-verifikasi').children('.ibox-content').removeClass('sk-loading');
                            window.location.reload();

                        });
                        
                    })
                });
            </script>
        <?php endif ?>
    </div>
</div>
</div>
</div>
</div>
</div>
