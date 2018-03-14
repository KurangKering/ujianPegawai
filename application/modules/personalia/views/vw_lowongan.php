<?php 
$tanggal_sekarang =  date('m/d/Y'); 
$waktu_sekarang =  date('H:i'); 
?>
<div class="tabs-container">
    <div class="tabs-right">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-periode"> Periode</a></li>
            <li class=""><a data-toggle="tab" href="#tab-umum">Umum</a></li>
        </ul>
        <div class="tab-content ">
            <div id="tab-periode" class="tab-pane active">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="ibox-content" id="ibox-periode">
                            <div class="sk-spinner sk-spinner-three-bounce">
                                <div class="sk-bounce1"></div>
                                <div class="sk-bounce2"></div>
                                <div class="sk-bounce3"></div>
                            </div>

                            <form method="post" class="form-horizontal" id="form-periode">
                                <input type="hidden" name="tipe" value="periode">
                                <input type="hidden" name="id_periode" value="<?php echo isset($konfig_periode['id_periode']) ? $konfig_periode['id_periode'] :"" ;  ?>">
                                <div class="ibox float-e-margins">
                                    <div class="form-group"><label class="col-md-2 control-label">Status : </label>
                                        <div class="col-md-9">

                                            <p><?php echo $konfig_umum['aktif']  === 'Y' ? '<span class="label label-primary">Active</span>' : '<span class="label label-warning">Tidak Aktif</span>' ?></p>
                                        </div>

                                    </div>
                                    <div class="hr-line-dashed" ></div>

                                    <div class="form-group"><label class="col-md-2 control-label">Pengajuan</label>
                                        <div class="col-md-9">

                                            <div class="input-daterange input-group" id="date-pengajuan">
                                                <input type="text" class="input-md form-control" name="tanggal_buka_lamaran" value="<?php echo isset($konfig_periode['tanggal_buka_lamaran']) ? $konfig_periode['tanggal_buka_lamaran'] : $tanggal_sekarang  ?>"/>
                                                <span class="input-group-addon">Sampai</span>
                                                <input type="text" class="input-md form-control" name="tanggal_tutup_lamaran" value="<?php echo isset($konfig_periode['tanggal_tutup_lamaran']) ? $konfig_periode['tanggal_tutup_lamaran'] : $tanggal_sekarang  ?>" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="hr-line-dashed" ></div>

                                    <div class="form-group" id="tanggal_ujian_akademik"><label class="col-md-2 control-label">Ujian Akademik</label>
                                        <div class="col-md-9">

                                            <div class="row">
                                                <div class="col-sm-4"> <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="tanggal_ujian_akademik" class="form-control" value="<?php echo isset($konfig_periode['tanggal_ujian_akademik']) ? $konfig_periode['tanggal_ujian_akademik'] :  $tanggal_sekarang; ?>">
                                                </div></div>
                                                <div class="col-sm-4">
                                                    <div class="input-group clockpicker" data-autoclose="true">
                                                        <input name="waktu_ujian_akademik" type="text" class="form-control" value="<?php echo isset($konfig_periode['waktu_ujian_akademik']) ? $konfig_periode['waktu_ujian_akademik'] :  $waktu_sekarang; ?>" >
                                                        <span class="input-group-addon">
                                                            <span class="fa fa-clock-o"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="hr-line-dashed" ></div>

                                    <div class="form-group " id=""><label class="col-md-2 control-label">Ujian Psikotest</label>
                                        <div class="col-md-9">

                                            <div class="row">
                                                <div class="col-md-4">
                                                 <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="tanggal_ujian_psikotest" class="form-control" value="<?php echo isset($konfig_periode['tanggal_ujian_psikotest']) ? $konfig_periode['tanggal_ujian_psikotest'] :  $tanggal_sekarang; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <input name="waktu_ujian_psikotest" type="text" class="form-control" value="<?php echo isset($konfig_periode['waktu_ujian_psikotest']) ? $konfig_periode['waktu_ujian_psikotest'] :  $waktu_sekarang; ?>" >
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="hr-line-dashed" ></div>

                                <div class="form-group "><label class="col-md-2 control-label">Ujian wawancara</label>
                                    <div class="col-md-9">

                                        <div class="row">
                                            <div class="col-md-4">
                                             <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="tanggal_ujian_wawancara" class="form-control" value="<?php echo isset($konfig_periode['tanggal_ujian_wawancara']) ? $konfig_periode['tanggal_ujian_wawancara'] :  $tanggal_sekarang; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group clockpicker" data-autoclose="true">
                                                <input name="waktu_ujian_wawancara" type="text" class="form-control" value="<?php echo isset($konfig_periode['waktu_ujian_wawancara']) ? $konfig_periode['waktu_ujian_wawancara'] :  $waktu_sekarang; ?>" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed" ></div>

                        <div class="form-group "><label class="col-md-2 control-label">Jabatan</label>
                            <div class="col-md-9">

                                <div class="row">
                                    <div class="col-md-4">
                                        <select  id="id_fakultas" class="form-control">
                                         <?php foreach ($list_fakultas as $key => $fakultas): ?>
                                             <option value="<?php echo $fakultas['id_fakultas'] ?>"><?php echo $fakultas['nama_fakultas'] ?></option>}
                                             option
                                         <?php endforeach ?>
                                     </select>
                                 </div>
                                 <div class="col-md-5">
                                    <select id="id_subbag" class="form-control">
                                     <?php foreach ($list_subbag as $key => $subbag): ?>
                                         <option value="<?php echo $subbag['id_subbag'] ?>"><?php echo $subbag['nama_subbag'] ?></option>}
                                         option
                                     <?php endforeach ?>
                                 </select>
                             </div>
                             <div class="col-md-2">
                                <input type="text" id="jumlah" class="form-control">
                            </div>
                            <div class="col-md-1">
                             <button type="button" id="add" class="btn btn-primary">+</button>
                         </div>
                     </div>
                 </div>

             </div> 
             <div class="hr-line-dashed" ></div>
             <div class="form-horizontal">
                <div id="div-jabatan">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" id="submit-pengaturan-periode">Simpan Pengaturan</button>
                <?php if ($is_periode_aktif): ?>
                    <button class="btn btn-danger btn-block" id="akhiri_periode" type="button">Akhiri Periode</button>
                <?php endif ?>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<div id="tab-umum" class="tab-pane">
    <div class="panel-body">
        <div class="col-md-12">
         <div class="ibox-content" id="ibox-umum">
            <div class="sk-spinner sk-spinner-three-bounce">
                <div class="sk-bounce1"></div>
                <div class="sk-bounce2"></div>
                <div class="sk-bounce3"></div>
            </div>

            <form role="form" method="post" class="form-horizontal" id="form-umum">
                <input type="hidden" name="tipe" value="umum">
                <div class="form-group"><label class="col-md-3 control-label">Persyaratan Umum</label>
                    <div class="col-md-9">
                        <textarea  name="persyaratan_umum" class="form-control"><?php echo isset($konfig_umum['persyaratan_umum']) ? $konfig_umum['persyaratan_umum'] : set_value('persyaratan_umum')  ?></textarea>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " id="tanggal-akademik"><label class="col-md-3 control-label">Lokasi Ujian Akademik</label>
                    <div class="col-md-9">
                        <input type="text" name="lokasi_ujian_akademik" value="<?php echo isset($konfig_umum['lokasi_ujian_akademik']) ? $konfig_umum['lokasi_ujian_akademik'] : set_value('lokasi_ujian_akademik')  ?>" class="form-control">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " id="tanggal-akademik"><label class="col-md-3 control-label">Lokasi Ujian Psikotest</label>
                    <div class="col-md-9">
                        <input type="text" name="lokasi_ujian_psikotest" value="<?php echo isset($konfig_umum['lokasi_ujian_psikotest']) ? $konfig_umum['lokasi_ujian_psikotest'] : set_value('lokasi_ujian_psikotest')  ?>"  class="form-control">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " id="tanggal-akademik"><label class="col-md-3 control-label">Lokasi Ujian Wawancara</label>
                    <div class="col-md-9">
                        <input type="text" name="lokasi_ujian_wawancara" value="<?php echo isset($konfig_umum['lokasi_ujian_wawancara']) ? $konfig_umum['lokasi_ujian_wawancara'] : set_value('lokasi_ujian_wawancara')  ?>" class="form-control">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " id="tanggal-akademik"><label class="col-md-3 control-label">Durasi Ujian Akademik (M) </label>
                    <div class="col-md-9">
                        <div class="m-r-md ">
                            <input type="text" name="durasi_ujian_akademik" value="<?php echo isset($konfig_umum['durasi_ujian_akademik']) ? $konfig_umum['durasi_ujian_akademik'] : 0  ?>" class="dial m-r-md " data-fgColor="#1AB394" data-width="75" data-height="75"  />
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <button class="btn btn-primary col-md-offset-5" type="submit" id="submit-pengaturan-umum">Simpan Pengaturan</button>
                </div>    
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<div class="modal inmodal" id="modal-akhiri" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <form method="post">
                <input type="hidden" name="tipe" value="akhiri_periode">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h2>Yakin Ingin Mengakhiri Periode ?</h2>
                    <small class="font-bold">Semua Data Pada Periode Ini Akan Dihapus</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-akhiri">Akhiri Periode</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#akhiri_periode').click(function () {
        swal({
            title: "Akhiri Periode Ini",
            text: "Yakin Ingin Mengakhiri Periode Saat Ini ? ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Akhiri !",
            closeOnConfirm: false
        }, function () {
            var tipe = 'akhiri_periode';
            $.ajax({
                url: '<?php echo site_url() . 'personalia/lowongan' ?>',
                type: 'POST',
                data: {tipe: tipe},
            })
            .done(function() {
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
                swal("Sukses!", "Berhasil Mengakhiri Periode", "success");
                window.location.reload();
            });
            
            
        });
    });

    $(document).ready(function() {



        // $('#akhiri_periode').click(function(event) {
        //     $('#modal-akhiri').modal('show');
        // });
        var listFakultas = <?php echo json_encode($list_fakultas) ?>;
        var listSubbag = <?php echo json_encode($list_subbag) ?>;
        var detail = <?php echo json_encode($detail_last_jabatan); ?>;
        $.each(detail, function(index, el) {
            var num = ++index;
            var x_fakultas = [];
            var x_subbag = [];
            $.each(listFakultas, function(inFak, elFak) {
                if (elFak['id_fakultas'] == el.id_fakultas)
                {
                    x_fakultas['id'] = elFak['id_fakultas'];
                    x_fakultas['nama'] = elFak['nama_fakultas'];
                }
            });
            $.each(listSubbag, function(inSubBag, elSubBag) {
                if (elSubBag['id_subbag'] == el.id_subbag)
                {
                    x_subbag['id'] = elSubBag['id_subbag'];
                    x_subbag['nama'] = elSubBag['nama_subbag'];
                }
            });
            var rowWrapper = $("<div class=\"form-group div-jabatan\" id=\""+x_fakultas['id']+ "-"+x_subbag['id']+"\">");
            var labelClass = $("<div class=\"col-lg-1\"><button type=\"button\" class=\"btn btn-info btn-sm form-control-static\">-</button></div>");
            var inputFakultas = $("<input type=\"hidden\" name=\"id_fakultas[]\" value=\""+x_fakultas['id']+"\">");
            var inputSubbag = $("<input type=\"hidden\" name=\"id_subbag[]\" value=\""+x_subbag['id']+"\">");
            var inputJumlah = $("<input type=\"hidden\" name=\"jumlah[]\" value=\""+el['jumlah']+"\">");
            var fFakultas = $("<div class=\"col-lg-5\"><input type=\"text\" class=\"form-control\" readonly value=\""+x_fakultas['nama']+"\" /></div>"); 
            var fJabatan = $("<div class=\"col-lg-4\"><input type=\"text\" class=\"form-control\" readonly value=\""+x_subbag['nama']+"\" /></div>"); 
            var fJumlah = $("<div class=\"col-lg-1\"><input type=\"text\" class=\"form-control\" readonly value=\""+el['jumlah']+"\" /></div>"); 
            // var fFakultas = $("<div class=\"col-lg-10\"><p class=\"form-control-static\"><span></span>" +x_fakultas['nama']+ " - "+x_subbag['nama']+" - " +el['jumlah']+ "</p></div>");
            var removeButton = $("<div class=\"col-lg-1\"><button type=\"button\" class=\"btn btn-danger btn-sm form-control-static\">x</button></div>");
            removeButton.click(function() {
                $(this).parent().remove();
            });
            rowWrapper.append(labelClass);
            rowWrapper.append(inputFakultas);
            rowWrapper.append(inputSubbag);
            rowWrapper.append(inputJumlah);
            rowWrapper.append(fFakultas);
            rowWrapper.append(fJabatan);
            rowWrapper.append(fJumlah);
            rowWrapper.append(removeButton);
            $("#div-jabatan").append(rowWrapper);

        });
        $("#add").click(function() {
            id_fakultas = $("#id_fakultas").val();
            id_subbag = $("#id_subbag").val();
            jumlah = $("#jumlah").val();
            text_id_fakultas = $("#id_fakultas :selected").text();
            text_id_subbag = $("#id_subbag :selected").text();
            // if (!$('[id^="'+id_fakultas+"-"+id_subbag+'"').length) 
            if (!$("#"+id_fakultas+"-"+id_subbag).length) 
            {
             var rowWrapper = $("<div class=\"form-group div-jabatan\" id=\""+id_fakultas+ "-"+id_subbag+"\">");
             var labelClass = $("<label class=\"col-lg-1 control-label\">-</label>");
             var inputFakultas = $("<input type=\"hidden\" name=\"id_fakultas[]\" value=\""+id_fakultas+"\">");
             var inputSubbag = $("<input type=\"hidden\" name=\"id_subbag[]\" value=\""+id_subbag+"\">");
             var inputJumlah = $("<input type=\"hidden\" name=\"jumlah[]\" value=\""+jumlah+"\">");
             var fFakultas = $("<div class=\"col-lg-5\"><input type=\"text\" class=\"form-control\" readonly value=\""+text_id_fakultas+"\" /></div>"); 
             var fJabatan = $("<div class=\"col-lg-4\"><input type=\"text\" class=\"form-control\" readonly value=\""+text_id_subbag+"\" /></div>"); 
             var fJumlah = $("<div class=\"col-lg-1\"><input type=\"text\" class=\"form-control\" readonly value=\""+jumlah+"\" /></div>"); 
             var removeButton = $("<div class=\"col-lg-1\"><button type=\"button\" class=\"btn btn-danger btn-sm form-control-static\">x</button></div>");
             removeButton.click(function() {
                $(this).parent().remove();
            });
             rowWrapper.append(labelClass);
             rowWrapper.append(inputFakultas);
             rowWrapper.append(inputSubbag);
             rowWrapper.append(inputJumlah);
             rowWrapper.append(fFakultas);
             rowWrapper.append(fJabatan);
             rowWrapper.append(fJumlah);
             rowWrapper.append(removeButton);
             $("#div-jabatan").append(rowWrapper);
         }
     });

        $('#date-pengajuan').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $('button[type="submit"').click(function(event) {
          event.preventDefault();
          var ibox =  $(this).parent().parent().parent();
          var form =  $(this).parent().parent();

          ibox.addClass('sk-loading');
          $.ajax({
            url: '<?php echo site_url(). 'personalia/lowongan' ?>',
            type: 'POST',
            data: form.serialize(),
        })
          .done(function() {
             console.log("success");
         })
          .fail(function() {
             console.log("error");
         })
          .always(function() {
             console.log("complete");
             ibox.removeClass('sk-loading');
             console.log(ibox);
             if (ibox.is(".modal-content") || !$('#akhiri_periode').length ) 
             {
                window.location.reload();
            }
        });

      });

    });
$('.input-group.date').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});
$('.clockpicker').clockpicker();
$(".dial").knob();




</script>