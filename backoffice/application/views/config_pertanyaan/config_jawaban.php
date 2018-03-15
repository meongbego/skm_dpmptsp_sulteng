
<div class="row-fluid">
  <div class="col-md-4">
      <h3 class="page-header"><b><?php echo $title ?></b></h3>
  </div>
  <div class="col-md-4 text-center">
      <div id="message">
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
      </div>
  </div>
  <div class="col-md-4 text-right">
  </div>
</div>

<div class="row-fluid">
  <div class="col-md-12">
    <hr>
    <table class="table table-bordered table-striped data-table" id="">
      <thead>
          <tr>
            <th>No</th>
            <th>Kode Jawaban</th>
            <th>Jawaban</th>
            <th style="text-align:center">Konfigurasi</th>
          </tr>
      </thead>

      <tbody>
          <?php
          $start = 0;
          foreach ($config_jawaban as $tb_jawaban)
          {
              ?>
          <tr>
            <td><?php echo ++$start ?></td>
            <td><?php echo $tb_jawaban->kode_jawaban ?></td>
            <td><?php echo $tb_jawaban->nm_jawaban ?></td>
            <td style="text-align:center">
              <a href="<?php echo site_url() ?>" class="btn btn-primary btn-xs"><i class='fa fa-gears'></i></a>
            </td>
          </tr>
        <?php
    }
    ?>
      </tbody>
    </table>
  </div>
</div>
