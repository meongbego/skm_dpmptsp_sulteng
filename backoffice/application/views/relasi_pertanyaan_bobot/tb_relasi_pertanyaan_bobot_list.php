
<div class="row">
  <div class="col-md-12">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <?php echo anchor(site_url('relasi_pertanyaan_bobot/create'), 'Tambah Data', 'class="btn btn-success"'); ?>
		<?php echo anchor(site_url('relasi_pertanyaan_bobot/excel'), 'Excel', 'class="btn btn-warning"'); ?>
	
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
    <table class="table table-bordered table-striped data-table" id="tablerelasi_pertanyaan_bobot">
      <thead>
          <tr>
            <th style="text-align:center" width="40px">No</th>
		    <th style="text-align:center">Kode Relasi Pertanyaan Bobot</th>
		    <th style="text-align:center">Kode Pertanyaan</th>
		    <th style="text-align:center">Kode Jawaban</th>
		    <th style="text-align:center">Bobot</th>
		
            <th style="text-align:center" width="100px">Action</th>
          </tr>
      </thead>
	
      <tbody>
          <?php
          $start = 0;
          foreach ($relasi_pertanyaan_bobot_data as $relasi_pertanyaan_bobot)
          {
              ?>
              <tr>
		    <td><?php echo ++$start ?></td>
		<td><?php echo $relasi_pertanyaan_bobot->kode_relasi_pertanyaan_bobot ?></td>
		<td><?php echo $relasi_pertanyaan_bobot->kode_pertanyaan ?></td>
		<td><?php echo $relasi_pertanyaan_bobot->kode_jawaban ?></td>
		<td><?php echo $relasi_pertanyaan_bobot->bobot ?></td>
		    <td style="text-align:center" width="100px">
              <a href="<?php echo site_url('relasi_pertanyaan_bobot/read/'.$relasi_pertanyaan_bobot->id_relasi_pertanyaan_bobot) ?>"><i class='fa fa-eye'></i></a> |
              <a href="<?php echo site_url('relasi_pertanyaan_bobot/update/'.$relasi_pertanyaan_bobot->id_relasi_pertanyaan_bobot) ?>"><i class='fa fa-pencil-square-o'></i></a> |
              <a href="<?php echo site_url('relasi_pertanyaan_bobot/delete/'.$relasi_pertanyaan_bobot->id_relasi_pertanyaan_bobot) ?>" onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
	
              </tr>
        <?php
    }
    ?>
      </tbody>
    </table>
  </div>
  </div>
</div>