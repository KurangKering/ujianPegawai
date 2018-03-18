<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="ibox">
            <div class="ibox-content">

                <div class="text-center article-title">
                    <h1>
                        Penerimaan Pegawai Universitas Islam Riau
                    </h1>
                </div>
                <h3>Persyaratan Umum : </h3>
                <?php echo $konfig_umum['persyaratan_umum']; ?>

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
                        <div class="row">
                        <div class="col-md-8 col-md-offset-4">

                              
                              <div class="col-md-3">
                                  <a href="<?php echo site_url(). 'pelamar/info_kelulusan' ?>"  class="btn btn-info">Info Kelulusan   </a>

                              </div>

                                <div class="col-md-3">
                                  <a href="<?php echo site_url(). 'pelamar/pengajuan' ?>"  class="btn btn-primary">Pengajuan</a>
                              </div>

                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
