
<?php 
$tanggal_sekarang =  date('m/d/Y'); 
$waktu_sekarang =  date('H:i'); 
?>

<div class="row">
    <form role="form" method="post">
        <input type="hidden" name="tipe" value="umum">
        <div class="col-lg-6">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Umum</h5> 
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="form-group"><label>Persyaratan Umum</label>
                            <textarea name="persyaratan_umum" class="form-control"><?php echo isset($konfig_umum['persyaratan_umum']) ? $konfig_umum['persyaratan_umum'] : set_value('persyaratan_umum')  ?></textarea>
                        </div>
                        <div class="form-group " id="tanggal-akademik"><label>Lokasi Ujian Akademik</label>
                            <input type="text" name="lokasi_ujian_akademik" value="<?php echo isset($konfig_umum['lokasi_ujian_akademik']) ? $konfig_umum['lokasi_ujian_akademik'] : set_value('lokasi_ujian_akademik')  ?>" class="form-control">
                        </div>
                        <div class="form-group " id="tanggal-akademik"><label>Lokasi Ujian Psikotest</label>
                            <input type="text" name="lokasi_ujian_psikotest" value="<?php echo isset($konfig_umum['lokasi_ujian_psikotest']) ? $konfig_umum['lokasi_ujian_psikotest'] : set_value('lokasi_ujian_psikotest')  ?>"  class="form-control">
                        </div>
                        <div class="form-group " id="tanggal-akademik"><label>Lokasi Ujian Wawancara</label>
                            <input type="text" name="lokasi_ujian_wawancara" value="<?php echo isset($konfig_umum['lokasi_ujian_wawancara']) ? $konfig_umum['lokasi_ujian_wawancara'] : set_value('lokasi_ujian_wawancara')  ?>" class="form-control">
                        </div>
                        <div class="form-group " id="tanggal-akademik"><label>Durasi Ujian Akademik</label>
                            <div class="m-r-md ">
                                <input type="text" name="durasi_ujian_akademik" value="<?php echo isset($konfig_umum['durasi_ujian_akademik']) ? $konfig_umum['durasi_ujian_akademik'] : 0  ?>" class="dial m-r-md " data-fgColor="#1AB394" data-width="75" data-height="75"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Simpan Pengaturan</button>
                        </div>    


                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="post">
        <input type="hidden" name="tipe" value="periode">
        <input type="hidden" name="id_periode" value="<?php echo isset($konfig_periode['id_periode']) ? $konfig_periode['id_periode'] :"" ;  ?>">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Periode</h5> 
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="form-group"><label>Status : </label>
                        <p><?php echo $konfig_umum['aktif']  === 'Y' ? '<span class="label label-primary">Active</span>' : '<span class="label label-warning">Tidak Aktif</span>' ?></p>
                    </div>

          <!--   <div class="form-group"><label>Periode Baru</label>
            <input type="checkbox" name="periode_baru" class="js-switch form-control"  />
        </div> -->
        <div class="form-group"><label>Pengajuan</label>
            <div class="input-daterange input-group" id="date-pengajuan">
                <input type="text" class="input-md form-control" name="tanggal_buka_lamaran" value="<?php echo isset($konfig_periode['tanggal_buka_lamaran']) ? $konfig_periode['tanggal_buka_lamaran'] : $tanggal_sekarang  ?>"/>
                <span class="input-group-addon">Sampai</span>
                <input type="text" class="input-md form-control" name="tanggal_tutup_lamaran" value="<?php echo isset($konfig_periode['tanggal_tutup_lamaran']) ? $konfig_periode['tanggal_tutup_lamaran'] : $tanggal_sekarang  ?>" />
            </div>
        </div>
        <div class="form-group" id="tanggal_ujian_akademik"><label>Ujian Akademik</label>
            <div class="row">
                <div class="col-sm-8"> <div class="input-group date">
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


        <div class="form-group " id=""><label>Ujian Psikotest</label>
            <div class="row">

                <div class="col-md-8">
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
    <div class="form-group "><label>Ujian wawancara</label>
        <div class="row">

            <div class="col-md-8">
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
<div class="ibox-content">

    <div class="form-group "><label>Jabatan</label>
        <div class="row">

            <div class="col-md-4">
                <select  id="id_fakultas" class="form-control">
                 <?php foreach ($list_fakultas as $key => $fakultas): ?>
                     <option value="<?php echo $fakultas['id_fakultas'] ?>"><?php echo $fakultas['nama_fakultas'] ?></option>}
                     option
                 <?php endforeach ?>
             </select>
         </div>
         <div class="col-md-4">
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
    <div class="col-md-2">
     <button type="button" id="add" class="btn btn-info">+</button>
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




</div>
</form>
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
                    <button type="submit" class="btn btn-primary">Akhiri Periode</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script type="text/javascript">


    $(document).ready(function() {

        $('#akhiri_periode').click(function(event) {
            $('#modal-akhiri').modal('show');
        });

        var listFakultas = <?php echo json_encode($list_fakultas) ?>;
        var listSubbag = <?php echo json_encode($list_subbag) ?>;
        var detail = <?php echo json_encode($detail_last_jabatan); ?>

        $.each(detail, function(index, el) {
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
            var labelClass = $("<label class=\"col-lg-1 control-label\">-</label>");
            var inputFakultas = $("<input type=\"hidden\" name=\"id_fakultas[]\" value=\""+x_fakultas['id']+"\">");
            var inputSubbag = $("<input type=\"hidden\" name=\"id_subbag[]\" value=\""+x_subbag['id']+"\">");
            var inputJumlah = $("<input type=\"hidden\" name=\"jumlah[]\" value=\""+el['jumlah']+"\">");
            var fSelect = $("<div class=\"col-lg-10\"><p class=\"form-control-static\"><span></span>" +x_fakultas['nama']+ " - "+x_subbag['nama']+" - " +el['jumlah']+ "</p></div>");
            var removeButton = $("<div class=\"col-lg-1\"><button type=\"button\" class=\"btn btn-danger btn-sm form-control-static\">x</button></div>");
            removeButton.click(function() {
                $(this).parent().remove();
            });
            rowWrapper.append(labelClass);
            rowWrapper.append(inputFakultas);
            rowWrapper.append(inputSubbag);
            rowWrapper.append(inputJumlah);
            rowWrapper.append(fSelect);
            rowWrapper.append(removeButton);
            $("#div-jabatan").append(rowWrapper);
        });
        $("#add").click(function() {

            if ($('#jumlah').val() == '') 
            {
                return false;
            }
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
             var fSelect = $("<div class=\"col-lg-10\"><p class=\"form-control-static\"><span></span>" +text_id_fakultas+ " - "+text_id_subbag+" - " +jumlah+ "</p></div>");
             var removeButton = $("<div class=\"col-lg-1\"><button type=\"button\" class=\"btn btn-danger btn-sm form-control-static\">x</button></div>");
             removeButton.click(function() {
                $(this).parent().remove();
            });
             rowWrapper.append(labelClass);
             rowWrapper.append(inputFakultas);
             rowWrapper.append(inputSubbag);
             rowWrapper.append(inputJumlah);
             rowWrapper.append(fSelect);
             rowWrapper.append(removeButton);
             $("#div-jabatan").append(rowWrapper);
         }

     });


        // $('#submit-pengaturan-periode').submit(function() {
        //     var x_id_fakultas = new Array();
        //     var x_id_subbag = new Array();
        //     var x_jumlah = new Array();
        //     $(".div-jabatan").each(function() {
        //         x_id_fakultas.push($(this).data("id_fakultas"));
        //         x_id_subbag.push($(this).data("id_subbag"));
        //         x_id_

        //     })


        // });





        $('#date-pengajuan').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });
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