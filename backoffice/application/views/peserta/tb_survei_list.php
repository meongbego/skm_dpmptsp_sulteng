
<div class="row">
  <div class="col-md-12">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <?php echo anchor(site_url('survei/create'), 'Tambah Data', 'class="btn btn-success"'); ?>
		<?php echo anchor(site_url('survei/excel'), 'Excel', 'class="btn btn-warning"'); ?>

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
    <table class="table table-bordered table-striped data-table" id="tablesurvei">
      <thead>
          <tr>
            <th style="text-align:center" width="40px">No</th>
    		    <th style="text-align:center">Kode Survei</th>
    		    <th style="text-align:center">Kode Peserta Survei</th>
    		    <th style="text-align:center">Pertanyaan</th>
            <th style="text-align:center" width="100px">Action</th>
          </tr>
      </thead>

      <tbody>
          <?php
          $start = 0;
          foreach ($survei_data as $survei)
          {
              ?>
              <tr>
        		    <td><?php echo ++$start ?></td>
            		<td><?php echo $survei->kode_survei ?></td>
            		<td><?php echo $survei->kode_peserta_survei ?></td>
            		<td><?php echo $survei->ket_pertanyaan ?></td>
  	            <td style="text-align:center" width="100px">
                  <a href="<?php echo site_url('survei/read/'.$survei->id_survei) ?>"><i class='fa fa-eye'></i></a> |
                  <a href="<?php echo site_url('survei/update/'.$survei->id_survei) ?>"><i class='fa fa-pencil-square-o'></i></a> |
                  <a href="<?php echo site_url('survei/delete/'.$survei->id_survei) ?>" onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
                </td>
              </tr>
        <?php
    }
    ?>
      </tbody>
    </table>
  </div>
  </div>
</div>
