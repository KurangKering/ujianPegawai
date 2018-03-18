<style type="text/css" media="screen">
.row.text-center > div {
    display: inline-block;
    float: none;
}

#modal-dialog { position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto; width: 500px; height: 300px; }
.toolbar {
  float: left;
}

}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Master Jabatan</h5> 
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table table-striped">
                    <table class="table table-striped table-bordered table-hover" id="table-daftar-jabatan" >
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Jabatan</th>
                                <th>Persyaratan Khusus</th>
                                <th>Action</th>
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

<div class="modal inmodal fade" id="modal-jabatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content animated rubberBand">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"Edit> </h4>
            </div>
            <div class="modal-body">
                <form method="get" class="form-horizontal" id="form-jabatan">
                    <div class="modal-body">

                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" class="form-control" id="type" name="type">

                        <div class="form-group"><label class="col-sm-2 control-label">Jabatan</label>

                        <div class="col-sm-10"><input type="text" id="keterangan" name="keterangan" class="form-control"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Persyaratan Khusus</label>

                    <div class="col-sm-10"><textarea name="persyaratan_khusus" id="persyaratan_khusus"  class="form-control" ></textarea></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" onclick="submitjabatan()" id="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
$(function() {






    $("#submit").click(function(event) {
     event.preventDefault();
    });
    table_daftar_jabatan = $('#table-daftar-jabatan').DataTable({ 
     "bAutoWidth": false ,
     "processing": true, 
     "serverSide": true, 
     "bLengthChange": false,

     "order": [], 

     "ajax": {
        "url": '<?php echo site_url('personalia/jsonGetSeluruhJabatan'); ?>',
        "type": "POST"
    },
    "columns": [
    {"data": "id"},
    {"data": "keterangan"},
    {"data": "persyaratan_khusus"},
    {"data": "action"},
    ],
    dom: 'l<"#administrasi.toolbar">frtip',
    initComplete: function() {
     $("div#administrasi")
     .html('<button type="button" id="btn-tambah-jabatan" onClick="showModals()" class="btn btn-primary" >Tambah</button>');
 },
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
 //Tampilkan Modal 
 function showModals( id )
 {
    showPleaseWait();
    clearModals();

    if( id )
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('personalia/kelola_jabatan_crud'); ?>",
            dataType: 'json',
            data: {id:id,type:"get"},
            success: function(res) {
                hidePleaseWait();
                setModalData(res);
            }
        });
    }
    else
    {

        hidePleaseWait();
        $("#modal-jabatan").modal("show");
        $("#myModalLabel").html("Tambah Jabatan ");
        $("#type").val("new"); 
        
    }
}

function setModalData( data )
{

    $("#myModalLabel").html("Edit Jabatan ");
    $("#id").val(data.id);
    $("#type").val("edit");
    $("#keterangan").val(data.keterangan);
    $("#persyaratan_khusus").val(data.persyaratan_khusus);

    $("#modal-jabatan").modal("show");
}

function submitjabatan()
{
    var formData = $("#form-jabatan").serialize();
    showPleaseWait();

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('personalia/kelola_jabatan_crud'); ?>",
        dataType: 'json',
        data: formData,
    })
    .done(function() {
        console.log("success");
                        table_daftar_jabatan.ajax.reload(); 

                        hidePleaseWait();  
    $("#modal-jabatan").modal("hide");



                    })
    .fail(function() {
        console.log("error");
        hidePleaseWait();
    })
    .always(function() {
        console.log("complete");
    });

}

function deleteJabatan( id )
{

    clearModals();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('personalia/kelola_jabatan_crud'); ?>",
        dataType: 'json',
        data: {id:id,type:"get"},
        success: function(data) {
            $("#removeWarning").show();
            $("#myModalLabel").html("Delete jabatan");
            $("#id").val(data.id);
            $("#type").val("delete");
            $("#keterangan").val(data.keterangan).attr("disabled","true");
            $("#persyaratan_khusus").val(data.persyaratan_khusus).attr("disabled","true");
            $("#modal-jabatan").modal("show");
            hidePleaseWait();           
        }
    });
}

function clearModals()
{
    $("#removeWarning").hide();
    $("#id").val("").removeAttr( "disabled" );
    $("#keterangan").val("").removeAttr( "disabled" );
    $("#persyaratan_khusus").val("").removeAttr( "disabled" );
}



</script>



