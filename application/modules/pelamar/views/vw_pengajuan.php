<style type="text/css" media="screen">
    #image_preview{
        margin: 0 auto 0 auto;
        font-size: 30px;
        top: 100px;
        left: 100px;
        width: 250px;
        height: 230px;
        text-align: center;
        line-height: 180px;
        font-weight: bold;
        color: #C0C0C0;
        background-color: #FFFFFF;

    }
    #previewing {
       width: 200px;
       height: 250px;
   }
</style>
<form role="form" action="" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col-lg-6">
         <div class="ibox float-e-margins">
            <div class="ibox-title bg-primary">
               <h5>Data Diri</h5>
               <div class="ibox-tools">
                  <a class="collapse-link">
                     <i class="fa fa-chevron-up"></i>
                 </a>

                 <ul class="dropdown-menu dropdown-user">
                     <li><a href="#">Config option 1</a>
                     </li>
                     <li><a href="#">Config option 2</a>
                     </li>
                 </ul> 
             </div>
         </div>
         <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12 ">

                    <div class="form-group"><label>NIK</label> <input name="nik" maxlength="16" value="" type="text" placeholder="" class="form-control" required></div>
                    <div class="form-group"><label>Nama Lengkap</label> <input name="nama" value="" type="text" placeholder="" class="form-control" required></div>
                    <div class="form-group"><label>Email</label> <input name="email" value="" type="email" placeholder="" class="form-control" required></div>

                    <div class="form-group"><label>File Lamaran</label>
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                          <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Ubah</span>
                            <input type="file" id="file_lamaran" required="" name="file_lamaran"/ >
                        </span>
                    </div>
                    

                </div>
                <div class="form-group"><label>Pilihan Fakultas</label>
                    <select name="fakultas" required id="fakultas" class="form-control" >
                    <option value="" selected disabled>-</option>}
                    option
                        <?php if (isset($fakultas)): ?>
                            <?php foreach ($fakultas as $k => $v): ?>
                                <option value="<?php echo $v['id_fakultas']; ?>"><?php echo $v['nama_fakultas'] ?></option>}
                            <?php endforeach ?>
                        <?php endif ?>

                    </select>
                </div>
                <div class="form-group"><label>Pilihan Sub Bagian</label>
                    <select name="subbag" id="subbag"  class="form-control" >
                        
                    </select>
                </div>
                <div>
                    <button class="btn btn-sm btn-primary b-r-xl pull-right" type="submit" name="simpan" value="simpan"><strong>Simpan</strong></button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-lg-6">
    <div class="ibox float-e-margins " id="ibox-photo">
        <div class="ibox-title bg-primary">
            <h5>Pas Photo</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>

                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="ibox-content text-center ">
            <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>
            <div class="m-b-sm">
                <img alt="image" class="" id="previewing" src="">
            </div>

            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
              <div class="form-control" data-trigger="fileinput">
                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                <span class="fileinput-filename"></span>
            </div>
            <span class="input-group-addon btn btn-default btn-file">
                <span class="fileinput-new">Select file</span>
                <span class="fileinput-exists">Ubah</span>
                <input type="file" id="file_photo" required="" name="file_photo"/>
            </span>
            <!-- <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a> -->
        </div>
    </div>

</div>

<div class="ibox float-e-margins">
    <div class="ibox-title bg-danger">
        <h5>Histori Kesalahan</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>

            <ul class="dropdown-menu dropdown-user">
                <li><a href="#">Config option 1</a>
                </li>
                <li><a href="#">Config option 2</a>
                </li>
            </ul>

        </div>
    </div>
    <div class="ibox-content">

        <div id="message">
            <?php echo isset($error) ? $error : ''; ?>
        </div>

    </div>
</div>
</div>  


</div>
</form>

<script>


// Function to preview image after validation
$(function() {


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



  $("#btn-cari").click(function(event) {
      var id_fakultas = $("#fakultas").val();
      var id_subbag = $("#subbag").val();
      var url = '<?php echo site_url('personalia/jsonDaftarNilai/akademik/'); ?>';
      table_akademik.ajax.url(url + id_fakultas + "/" + id_subbag ).load();
  });



$("#file_photo").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var fileSize = file.size / 1000 ;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])) ||  fileSize > 1500)
{
    $('#previewing').attr('src','');
    $("#message").html("<p id='error'>Silahkan Pilih File Gambar & Ukuran Max 1 MB</p>"+"<h4>Note</h4>"+"<span id='error_message'>Hanya File Berformat jpeg, jpg and png Yang Dibolehkan</span>");
    $("#file_photo").val("");
    return false;
}
else
{
    var reader = new FileReader();
    reader.onload = imageIsLoaded;
    reader.readAsDataURL(this.files[0]);

}
});

$("#file_lamaran").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var fileType = file.type;
var match= "application/pdf";
if(!((fileType==match)))
{
    $('#previewing').attr('src','');
    $("#message").html("<p id='error'>Silahkan Pilih Berkas Lamaran</p>"+"<h4>Note</h4>"+"<span id='error_message'>Hanya File Berformat PDF yang Dibolehkan</span>");
    $("#file_lamaran").val("");
    return false;
}
});

});
function imageIsLoaded(e) {
    $("#file").css("color","green");
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '250px');
    $('#previewing').attr('height', '230px');
};
</script>
