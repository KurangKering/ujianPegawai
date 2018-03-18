<style type="text/css" media="screen">
#previewing {
    width: 250px;
    height: 300px;
}
</style>
<div class="row">
    <div class="col-lg-2">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <!-- <span class="label label-success pull-right">Monthly</span> -->
                <h5>Total Pelamar</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $total['pelamar']; ?></h1>
                <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                <!-- <small>Total income</small> -->
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <!-- <span class="label label-info pull-right">Annual</span> -->
                <h5> Disetujui</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $total['diverifikasi']; ?></h1>
                <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                <!-- <small>New orders</small> -->
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <!-- <span class="label label-primary pull-right">Today</span> -->
                <h5>Ditolak</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $total['ditolak']; ?></h1>
                <!-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> -->
                <!-- <small>New visits</small> -->
            </div>
        </div>
    </div>
    
    
    
    <div class="col-lg-2">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <!-- <span class="label label-danger pull-right">Low value</span> -->
                <h5>Belum Verifikasi</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $total['belum']; ?></h1>
                <!-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> -->
                <!-- <small>In first month</small> -->
            </div>
        </div>
    </div>
</div>
<?php if (!$result): ?>
  <div class="row  border-bottom white-bg dashboard-header">

    <div class="col-md-12">
        <h2>Semuda Data Telah Diverifikasi</h2>

    </div>

</div>
<?php else: ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins" id="ibox-verifikasi">
                <div class="ibox-title">
                    <h5>Pelamar     </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        
                        

                    </div>
                </div>
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <form method="post" class="form-horizontal">

                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="nik" value="<?php echo $result['nik']; ?>">
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

                    <div class="form-group"><label class="col-lg-2 control-label">Jabatan</label>

                    <div class="col-lg-10"><p class="form-control-static"><?php echo $result['jabatan_keterangan'] ?></p></div>
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

    $('#btn-lihat').on('click', function(){

        $('#ibox-verifikasi').children('.ibox-content').toggleClass('sk-loading');

    })

});

</script>
