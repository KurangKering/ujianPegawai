 
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo isset($judul) ? $judul : '' ?></h5> 
                
    </div>
    <div class="ibox-content">
        <table class="table" id="table-info-kelulusan" >
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>Sub Bagian</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($pelamar)): ?>
                    <?php foreach ($pelamar as $key => $value): ?>
                        <tr>
                            <th><?php echo $value['nik'] ?></th>
                            <th><?php echo $value['nama'] ?></th>
                            <th><?php echo $value['nama_fakultas'] ?></th>
                            <th><?php echo $value['nama_subbag'] ?></th>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>

    </div>
</div>
</div>
</div>

<script type="text/javascript">
    $('#table-info-kelulusan').dataTable();
</script>