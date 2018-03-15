
<div class="row">
  <div class="col-md-12">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">

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
    		    <th style="text-align:center">Tahun</th>
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
            		<td><?php echo $tahun_survei->nm_tahun ?></td>
        		    <td style="text-align:center">
                  <a href="<?php echo site_url('survei/hitung_survei/'.$tahun_survei->kode_tahun_survei) ?>"><i class='fa fa-eye'></i></a>
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
