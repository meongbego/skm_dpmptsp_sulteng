
<div class="row">
  <div class="col-md-12">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <?php echo anchor(site_url('peserta_survei/create'), 'Tambah Data', 'class="btn btn-success"'); ?>
		<?php echo anchor(site_url('peserta_survei/excel'), 'Excel', 'class="btn btn-warning"'); ?>
	
  </div>
  <div class="col-md-4">
      <div id="message">
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <br>
    <table class="table table-bordered table-striped data-table" id="tablepeserta_survei">
      <thead>
          <tr>
            <th style="text-align:center" width="40px">No</th>
		    <th style="text-align:center">Kode Peserta Survei</th>
		    <th style="text-align:center">Status Isi</th>
		    <th style="text-align:center">Kode Pegawai</th>
		    <th style="text-align:center">Kode Peserta</th>
		    <th style="text-align:center">Kode Tahun Survei</th>
		    <th style="text-align:center">Kode Status Survei</th>
		
            <th style="text-align:center" width="100px">Action</th>
          </tr>
      </thead>
	
      <tbody>
          <?php
          $start = 0;
          foreach ($peserta_survei_data as $peserta_survei)
          {
              ?>
              <tr>
		    <td><?php echo ++$start ?></td>
		<td><?php echo $peserta_survei->kode_peserta_survei ?></td>
		<td><?php echo $peserta_survei->status_isi ?></td>
		<td><?php echo $peserta_survei->kode_pegawai ?></td>
		<td><?php echo $peserta_survei->kode_peserta ?></td>
		<td><?php echo $peserta_survei->kode_tahun_survei ?></td>
		<td><?php echo $peserta_survei->kode_status_survei ?></td>
		    <td style="text-align:center" width="100px">
              <a href="<?php echo site_url('peserta_survei/read/'.$peserta_survei->id_peserta_survei) ?>"><i class='fa fa-eye'></i></a> |
              <a href="<?php echo site_url('peserta_survei/update/'.$peserta_survei->id_peserta_survei) ?>"><i class='fa fa-pencil-square-o'></i></a> |
              <a href="<?php echo site_url('peserta_survei/delete/'.$peserta_survei->id_peserta_survei) ?>" onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
	
              </tr>
        <?php
    }
    ?>
      </tbody>
    </table>
  </div>
  </div>
</div>