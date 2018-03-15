
<div class="row">
  <div class="col-md-12">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <?php echo anchor(site_url('tahun_survei/create'), 'Tambah Data', 'class="btn btn-success"'); ?>
		<?php echo anchor(site_url('tahun_survei/excel'), 'Excel', 'class="btn btn-warning"'); ?>
	
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
    <table class="table table-bordered table-striped data-table" id="tabletahun_survei">
      <thead>
          <tr>
            <th style="text-align:center" width="40px">No</th>
		    <th style="text-align:center">Kode Tahun Survei</th>
		    <th style="text-align:center">Nm Tahun</th>
		
            <th style="text-align:center" width="100px">Action</th>
          </tr>
      </thead>
	
      <tbody>
          <?php
          $start = 0;
          foreach ($tahun_survei_data as $tahun_survei)
          {
              ?>
              <tr>
		    <td><?php echo ++$start ?></td>
		<td><?php echo $tahun_survei->kode_tahun_survei ?></td>
		<td><?php echo $tahun_survei->nm_tahun ?></td>
		    <td style="text-align:center" width="100px">
              <a href="<?php echo site_url('tahun_survei/read/'.$tahun_survei->id_tahun_survei) ?>"><i class='fa fa-eye'></i></a> |
              <a href="<?php echo site_url('tahun_survei/update/'.$tahun_survei->id_tahun_survei) ?>"><i class='fa fa-pencil-square-o'></i></a> |
              <a href="<?php echo site_url('tahun_survei/delete/'.$tahun_survei->id_tahun_survei) ?>" onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
	
              </tr>
        <?php
    }
    ?>
      </tbody>
    </table>
  </div>
  </div>
</div>