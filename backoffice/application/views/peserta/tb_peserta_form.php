
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">No Peserta <?php echo form_error('no_peserta') ?></label>
            <input type="text" class="form-control" name="no_peserta" id="no_peserta" placeholder="No Peserta" value="<?php echo $no_peserta; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="int">Umur <?php echo form_error('umur') ?></label>
            <input type="text" class="form-control" name="umur" id="umur" placeholder="Umur" value="<?php echo $umur; ?>" />
        </div>
	<div class="form-group">
              <label class="form-label" for="jenkel">Jenkel <?php echo form_error('jenkel') ?></label>
              <select class="form-control" rows="3" name="jenkel" id="jenkel"><?php echo $jenkel; ?>
                <option value=""> Mohon Pilih Salah Satu</option> <!-- tolong edit -->
	            <option value="L">L</option>
	            <option value="P">P</option>
</select>
          </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pendidikan">Kode Pendidikan <?php echo form_error('kode_pendidikan') ?></label>
                          <select class="form-control" rows="3" name="kode_pendidikan" id="kode_pendidikan" value="<?php echo $kode_pendidikan ?>"><?php echo $kode_pendidikan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pendidikan as $key){
                              ?>
                              <option value="<?php echo $key->kode_pendidikan ?>"><?php echo $key->kode_pendidikan ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pendidikan">Kode Pendidikan <?php echo form_error('kode_pendidikan') ?></label>
                          <select class="form-control" rows="3" name="kode_pendidikan" id="kode_pendidikan" value="<?php echo $kode_pendidikan ?>"><?php echo $kode_pendidikan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pendidikan as $key){
                              ?>
                              <?php if ($key->kode_pendidikan == $kode_pendidikan): ?>
                                <option value="<?php echo $key->kode_pendidikan ?>" selected="True"><?php echo $key->kode_pendidikan ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_pendidikan ?>"><?php echo $key->kode_pendidikan ?></option>
                              <?php endif; ?>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                ?>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pekerjaan">Kode Pekerjaan <?php echo form_error('kode_pekerjaan') ?></label>
                          <select class="form-control" rows="3" name="kode_pekerjaan" id="kode_pekerjaan" value="<?php echo $kode_pekerjaan ?>"><?php echo $kode_pekerjaan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pekerjaan as $key){
                              ?>
                              <option value="<?php echo $key->kode_pekerjaan ?>"><?php echo $key->kode_pekerjaan ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pekerjaan">Kode Pekerjaan <?php echo form_error('kode_pekerjaan') ?></label>
                          <select class="form-control" rows="3" name="kode_pekerjaan" id="kode_pekerjaan" value="<?php echo $kode_pekerjaan ?>"><?php echo $kode_pekerjaan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pekerjaan as $key){
                              ?>
                              <?php if ($key->kode_pekerjaan == $kode_pekerjaan): ?>
                                <option value="<?php echo $key->kode_pekerjaan ?>" selected="True"><?php echo $key->kode_pekerjaan ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_pekerjaan ?>"><?php echo $key->kode_pekerjaan ?></option>
                              <?php endif; ?>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                ?>
	    <div class="form-actions"><input type="hidden" name="id_peserta" value="<?php echo $id_peserta; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('peserta') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>