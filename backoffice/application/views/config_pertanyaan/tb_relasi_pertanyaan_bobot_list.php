<div class="row-fluid">
  <div class="col-md-12">
      <h3 class="page-header"><b ><?php echo $title ?></b></h3>
  </div>
</div>
<div class="row">
  <div class="col-md-12 text-center">
      <div id="message">
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-10">
    <hr>
    <table class="table table-bordered table-striped" id="">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Relasi</th>
          <th>Pertanyaan</th>
          <th>Jawaban</th>
          <th>Bobot</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $start = 0;
        foreach ($config_pertanyaan_data as $config_pertanyaan)
        {
        ?>
        <tr>
          <td><?php echo ++$start ?></td>
          <td><?php echo $config_pertanyaan->kode_relasi_pertanyaan_bobot ?></td>
          <td><?php echo $config_pertanyaan->ket_pertanyaan ?></td>
          <td><?php echo $config_pertanyaan->nm_jawaban ?></td>
          <td><?php echo $config_pertanyaan->bobot ?></td>
          <td style="text-align:center" width="200px">
            <a href="<?php echo site_url('config_pertanyaan/read/'.$config_pertanyaan->id_relasi_pertanyaan_bobot) ?>" class="btn btn-warning btn-xs"><i class='fa fa-eye'></i></a>
            <a href="<?php echo site_url('config_pertanyaan/update/'.$config_pertanyaan->id_relasi_pertanyaan_bobot.'/'. $config_pertanyaan->kode_pertanyaan) ?>" class="btn btn-success btn-xs"><i class='fa fa-pencil-square'></i></a>
            <a href="<?php echo site_url('config_pertanyaan/delete/'.$config_pertanyaan->id_relasi_pertanyaan_bobot.'/'. $config_pertanyaan->kode_pertanyaan) ?>" class="btn btn-danger btn-xs" onclick="javasciprt: return confirm('Are You Sure ?')"><i class='fa fa-trash'></i></a>
          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-2">
    <h3></h3><hr>
    <a href="<?php echo site_url('config_pertanyaan/create/'.$kode_pertanyaan) ?>" class="btn btn-warning btn-block"><i class='fa fa-eye'></i> Konfigurasi</a>
    <a href="<?php echo site_url('pertanyaan/finish_konfig/'.$kode_pertanyaan) ?>" class="btn btn-success btn-block"><i class='fa fa-eye'></i> Selesai Konfigurasi</a>
  </div>
</div>
