<div class="row">
  <div class="col-lg-8 col-lg-offset-2">
    <div class="ibox">
      <div class="ibox-content bg-primary">

        <div class="text-center ">
          <h1 style="text-decoration: underline;">
            Penerimaan Pegawai Universitas Islam Riau
          </h1>
        </div>
      </div>
      <div class="ibox-content">
       <h3>Persyaratan Umum : </h3>
       <p style="white-space: pre;"><?php echo $konfig_umum['persyaratan_umum']; ?></p>


       <h4>Daftar Posisi Yang Dibutuhkan : </h4>
       <?php $nomor = 1; ?>
       <?php foreach ($detail_last_jabatan as $key => $jabatan) {
        $this->db->where('id_fakultas', $jabatan['id_fakultas']);
        $fakultas = $this->db->get('mst_fakultas')->row_array();

        $this->db->where('id_subbag', $jabatan['id_subbag']);
        $subbag = $this->db->get('mst_subbag')->row_array(); ?>
        <p><?php echo $nomor++ . '. ' . 'Fakultas ' . $fakultas['nama_fakultas'] . ' Sub Bagian ' . $subbag['nama_subbag'] . ' Membutuhkan ' . $jabatan['jumlah'] . ' staff' ?></p>
        <?php } ?>
        <br>
        <br>
        <div class="form-group">
         <a   href="<?php echo site_url(). 'pelamar/pengajuan' ?>"  class="btn btn-primary col-md-offset-5">Pengajuan</a>

       </div>
     </div>

   </div>
 </div>
</div>
