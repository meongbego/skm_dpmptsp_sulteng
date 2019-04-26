
<div class="row">
  <div class="col-md-12">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
      <h5 class="page-header"><?php echo $title ?></h5>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="col-md-2"><?php echo anchor(site_url('survei/cetak_survei/'.$tahun), 'Excel', 'class="btn btn-warning btn-block"'); ?></div>
    <form action="form" role="form">
      <div class="col-md-4">
        <input type="text" class="form-control datepicker">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control datepicker">
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary btn-block">Filter</button>
      </div>
    </form>
    
  </div>
  <div class="col-md-4">
      <div id="message">
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
      </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-striped data-table" id="tablesurvei">
      <thead>
        <tr>
          <th>No.</th>
          <th>Kode Peserta</th>
          <th>Umur</th>
          <th>Tanggal survei</th>
          <?php foreach ($unsur_pelayanan as $key): ?>
          <th><?php echo $key->kode_kategori_pertanyaan ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
          <?php
          $start = 1;
          $bobot=0;
          foreach ($data_survey as $key => $value)
          {
          ?>
          <tr>
            <th><?php echo $start++ ?></th>
            <th><?php echo $value['kode_peserta_survei'] ?></th>
            <th><?php echo $value['umur'] ?> Tahun</th>
            <th><?php echo $value['tgl_survei'] ?></th>
            <?php foreach ($value['data'] as $key1 => $value1): ?>
            <th><?php echo $value1['bobot'] ?></th>
            <?php endforeach; ?>
          </tr>
          <?php
          }
          ?>
      </tbody>
    </table>
    <br>
    <b>Hasil Perhitungan</b><hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Keterangan</th>
          <?php foreach ($unsur_pelayanan as $key): ?>
          <th><?php echo $key->kode_kategori_pertanyaan ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Semua Nilai / Unsur</th>
          <?php foreach ($data_hasil_hitung as $key => $value): ?>
            <td><?php echo $value['total_bobot'] ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>NRR / Unsur</th>
          <?php foreach ($data_hasil_hitung as $key => $value): ?>
            <td><?php echo number_format($value['nrr_unsur'],3)  ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>NRR Tertimbang / Unsur</th>
          <?php foreach ($data_hasil_hitung as $key => $value): ?>
            <td><?php echo number_format($value['nrr_tertimbang'],3)  ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <th>Nilai IKM</th>
          <th colspan="<?php echo $jumlah_unsur ?>"><?php echo number_format($nilai_ikm,3)  ?></th>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
</div>
