
<div class="row">
  <div class="col-md-12">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <?php echo anchor(site_url('peserta/create'), 'Tambah Data', 'class="btn btn-success"'); ?>
		<?php echo anchor(site_url('peserta/excel'), 'Excel', 'class="btn btn-warning"'); ?>

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
    <table class="table table-bordered table-striped data-table" id="tablepeserta">
      <thead>
          <tr>
            <th style="text-align:center" width="40px">No</th>
    		    <th style="text-align:center">Kode Peserta</th>
    		    <th style="text-align:center">Umur</th>
            <th style="text-align:center">Jenkel</th>
    		    <th style="text-align:center">Jawaban</th>
            <th style="text-align:center" width="100px">Action</th>
          </tr>
      </thead>

      <tbody>
          <?php
          $start = 0;
          foreach ($peserta_data as $peserta)
          {
              ?>
              <tr>
        		    <td><?php echo ++$start ?></td>
            		<td><?php echo $peserta->kode_peserta ?></td>
            		<td><?php echo $peserta->umur ?></td>
                <td><?php echo $peserta->jenkel ?></td>
            		<td style="text-align:center">
                  <a class="btn btn-success btn-sm"href="<?php echo site_url('peserta/jsurvei/'.$peserta->kode_peserta_survei) ?>"><i class='fa fa-eye'></i></a>
                </td>
        		    <td style="text-align:center" width="100px">
                  <a href="<?php echo site_url('peserta/read/'.$peserta->id_peserta_survei) ?>"><i class='fa fa-eye'></i></a> |
                  <a href="<?php echo site_url('peserta/update/'.$peserta->id_peserta_survei) ?>"><i class='fa fa-pencil-square-o'></i></a> |
                  <a href="<?php echo site_url('peserta/delete/'.$peserta->id_peserta_survei) ?>" onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
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
