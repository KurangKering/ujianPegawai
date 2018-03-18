<style type="text/css" media="screen">
    .toolbar {
      float: left;
  }
  #previewing {
    width: 250px;
    height: 300px;

}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Arsip Pegawai Yang Diterima Seluruh Periode</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">

                <div class="table table-striped">
                    <table class="table table-striped table-bordered table-hover" id="table-arsip-pelamar" >
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Fakultas</th>
                                <th>Sub Bagian</th>
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

<div class="modal inmodal fade" id="modal-detail-pelamar" data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail Pelamar</h4>
            </div>
            <div class="modal-body">
              <div class="ibox-content">
                <div class="sk-spinner sk-spinner-double-bounce">
                    <div class="sk-double-bounce1"></div>
                    <div class="sk-double-bounce2"></div>
                </div>
                <form method="post" class="form-horizontal">

                    <div class="row">
                        <div class="col-md-8">
                            <input type="hidden" name="nik" value="">
                            <div class="form-group"><label class="col-lg-2 control-label">NIK</label>

                                <div class="col-lg-10"><p class="form-control-static" id="nik"></p></div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-lg-2 control-label">Nama</label>

                                <div class="col-lg-10"><p class="form-control-static" id="nama"></p></div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                                <div class="col-lg-10"><p class="form-control-static" id="email"></p></div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-lg-2 control-label">Fakultas</label>

                                <div class="col-lg-10"><p class="form-control-static" id="nama_fakultas"></p></div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Sub Bagian</label>

                                <div class="col-lg-10"><p class="form-control-static" id="nama_subbag"></p></div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Berkas</label>

                                <div class="col-lg-10"><p class="form-control-static"><button type="button" id="btn-lihat" class="btn">Lihat</button></p></div>

                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Nilai Ujian</label>

                                <div class="col-lg-10">
                                    <ul>
                                        <li>Akademik</li>
                                        <li>Psikotest</li>
                                        <li>Wawancara</li>
                                        <li>Rata-Rata</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center border-left">
                            <div class="m-b-xl ">
                                <img alt="image" class="" id="previewing" src="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        table_arsip_pelamar = $('#table-arsip-pelamar').DataTable({ 
         "bAutoWidth": false ,
         "processing": true, 
         "serverSide": true, 
         "order": [], 

         "ajax": {
            "url": '<?php echo site_url('personalia/jsonGetArsipPelamar'); ?>',
            "type": "POST"
        },
        "columns": [
        {"data": "nik_link", "orderable" : false},
        {"data": "nama"},
        {"data": "nama_fakultas"},
        {"data": "nama_subbag"},
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
    }
    
  ],
  order: [[1, 'desc']],

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

function showModals( nik )
{
    showPleaseWait();
    clearModals();

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('personalia/jsonGetDetailSeluruhPelamar'); ?>",
        dataType: 'json',
        data: {nik:nik},
        success: function(res) {
            hidePleaseWait();
            setModalData(res);
            console.log(res);
        }
    });


}
function setModalData( data )
{
    $("#nik").text(data.nik);
    $("#nama").text(data.nama);
    $("#email").text(data.email);
    $("#nama_subbag").text(data.nama_subbag);
    $("#nama_fakultas").text(data.nama_fakultas);
    $("#previewing").attr("src", "<?php echo base_url('files/photo/') ?>"+ data.file_photo);
    $("#modal-detail-pelamar").modal("show");
}
function clearModals()
{
    $("#previewing").attr("src", "");
    $("#nik").text("");
    $("#nama").text("");
    $("#email").text("");
    $("#nama_subbag").text("");
    $("#nama_fakultas").text("");
    $("#jabatan_keterangan").text("");
    
}
</script>