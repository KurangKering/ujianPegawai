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
                <h5>Daftar Seluruh Pelamar Periode Ini</h5>
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
            <div class="ibox-content" id="ibox-pelamar">
               <div class="sk-spinner sk-spinner-three-bounce">
                <div class="sk-bounce1"></div>
                <div class="sk-bounce2"></div>
                <div class="sk-bounce3"></div>
            </div>
            <div class="table table-striped">
                <table class="table table-striped table-bordered table-hover" id="table-daftar-pelamar" >
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Status</th>
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
<!-- 
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
                            <div class="form-group"><label class="col-lg-2 control-label">status</label>

                                <div class="col-lg-10"><p class="form-control-static" id="status"></p></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-lg-2 control-label">Fakultas</label>

                                <div class="col-lg-10"><p class="form-control-static" id="nama_fakultas"></p></div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Sub Bagian</label>

                                <div class="col-lg-10"><p class="form-control-static" id="nama_subbag"></p></div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Berkas</label>

                                <div class="col-lg-10"><p class="form-control-static"><a id="berkas" href="" target="_blank">Lihat</a></p></div>
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
</div> -->

<div id="modal-detail" data-iziModal-fullscreen="true" data-iziModal-title="Detail Pelamar" data-iziModal-openFullscreen="false"  data-iziModal-icon="icon-home"  data-iziModal-closeOnEscape="true" data-iziModal-overlayClose="false">

    <div class="ibox-content">
        <form method="post" class="form-horizontal">

            <div class="row">
                <div class="col-md-8">
                    <input type="hidden" name="nik" value="">
                    <div class="form-group"><label class="col-lg-3 control-label">NIK</label>

                        <div class="col-lg-9"><p class="form-control-static" id="nik"></p></div>
                    </div>

                    <div class="form-group"><label class="col-lg-3 control-label">Nama</label>

                        <div class="col-lg-9"><p class="form-control-static" id="nama"></p></div>
                    </div>

                    <div class="form-group"><label class="col-lg-3 control-label">Email</label>

                        <div class="col-lg-9"><p class="form-control-static" id="email"></p></div>
                    </div>



                    <div class="form-group"><label class="col-lg-3 control-label">Fakultas</label>

                        <div class="col-lg-9"><p class="form-control-static" id="nama_fakultas"></p></div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Sub Bagian</label>

                        <div class="col-lg-9"><p class="form-control-static" id="nama_subbag"></p></div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Berkas</label>

                        <div class="col-lg-9"><p class="form-control-static"><a href=""  id="berkas" target="_blank" title="">Lihat</a></p></div>

                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Nilai Ujian</label>

                        <div class="col-lg-9">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jenis</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Akademik</td>
                                        <td class="text-center"><span id="nilai_akademik"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Psikotes</td>
                                        <td class="text-center"><span id="nilai_psikotest"></span></td>
                                    </tr>
                                    <tr >
                                        <td>Wawancara</td>
                                        <td class="text-center"><span id="nilai_wawancara"></span></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="bg-muted text-center"><span id="rata_rata" style="font-weight: bold"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4  border-left">
                    <div class="m-b-xl ">
                        <img alt="image" style="width: 100%" class="" id="previewing" src="">
                    </div>
                </div>
            </div>
        </form>
    </div>
    

</div>

<script type="text/javascript">
    iziModal($("#modal-detail"));

    $(document).ready(function() {
        table_daftar_pelamar = $('#table-daftar-pelamar').DataTable({ 
         "bAutoWidth": false ,
         "processing": true, 
         "serverSide": true, 
         "order": [], 

         "ajax": {
            "url": '<?php echo site_url('personalia/jsonGetSeluruhPelamar'); ?>',
            "type": "POST"
        },
        "columns": [
        {"data": "nik_link", "orderable" : false},
        {"data": "nama"},
        {"data": "status_keterangan"},
        {"data": "nama_fakultas"},
        {"data": "nama_subbag"},
        ],
        'columnDefs': [
        {
          "targets": 0,
          "className": "text-center",
          "width" : "9%"
      }]
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

function showModals( nik )
{
    // showPleaseWait();
    // $('#ibox-pelamar').addClass('sk-loading');
    clearModals();

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('personalia/jsonGetDetailSeluruhPelamar'); ?>",
        dataType: 'json',
        data: {nik:nik},
        success: function(res) {
            // hidePleaseWait();
             // $('#ibox-pelamar').removeClass('sk-loading');

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
    $("#status").text(data.keterangan);
    $("#nama_subbag").text(data.nama_subbag);
    $("#nama_fakultas").text(data.nama_fakultas);
    $("#nilai_akademik").text(data.nilai_akademik);
    $("#nilai_psikotest").text(data.nilai_psikotest);
    $("#nilai_wawancara").text(data.nilai_wawancara);
    $("#rata_rata").text(data.rata_rata);
    $("#berkas").attr("href", "<?php echo site_url('personalia/tampilpdf?file=') ?>"+data.file_lamaran);
    $("#previewing").attr("src", "<?php echo base_url('files/photo/') ?>"+ data.file_photo);
    // $("#modal-detail-pelamar").modal("show");
    $('#modal-detail').iziModal('open');

}
function clearModals()
{
    $("#previewing").attr("src", "");
    $("#nik").text("");
    $("#nama").text("");
    $("#email").text("");
    $("#status").text("");
    $("#nama_fakultas").text("");
    $("#nama_subbag").text("");
    $("#nilai_akademik").text("");
    $("#nilai_psikotest").text("");
    $("#nilai_wawancara").text("");
    $("#rata_rata").text("");
    $("#berkas").attr("href", "");
    
}

function iziModal(modal)
{
    modal.iziModal({
        title: '',
        subtitle: '',
        headerColor: '#88A0B9',
        background: null,
    theme: '',  // light
    icon: null,
    iconText: null,
    iconColor: '',
    rtl: false,
    width: 800,
    top: null,
    bottom: null,
    borderBottom: true,
    padding: 0,
    radius: 3,
    zindex: 9999,
    iframe: false,
    iframeHeight: 400,
    iframeURL: null,
    focusInput: true,
    group: '',
    loop: false,
    arrowKeys: true,
    navigateCaption: true,
    navigateArrows: true, // Boolean, 'closeToModal', 'closeScreenEdge'
    history: false,
    restoreDefaultContent: false,
    autoOpen: 0, // Boolean, Number
    bodyOverflow: false,
    fullscreen: false,
    openFullscreen: false,
    closeOnEscape: true,
    closeButton: true,
    appendTo: 'body', // or false
    appendToOverlay: 'body', // or false
    overlay: true,
    overlayClose: true,
    overlayColor: 'rgba(0, 0, 0, 0.4)',
    timeout: false,
    timeoutProgressbar: false,
    pauseOnHover: false,
    timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
    transitionIn: 'comingIn',
    transitionOut: 'comingOut',
    transitionInOverlay: 'fadeIn',
    transitionOutOverlay: 'fadeOut',
    onFullscreen: function(){},
    onResize: function(){},
    onOpening: function(){},
    onOpened: function(){},
    onClosing: function(){},
    onClosed: function(){},
    afterRender: function(){}
});
}
</script>