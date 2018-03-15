
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Survei <?php echo form_error('kode_survei') ?></label>
            <input type="text" class="form-control" name="kode_survei" id="kode_survei" placeholder="Kode Survei" value="<?php echo $kode_survei; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_peserta_survei">Kode Peserta Survei <?php echo form_error('kode_peserta_survei') ?></label>
                          <select class="form-control" rows="3" name="kode_peserta_survei" id="kode_peserta_survei" value="<?php echo $kode_peserta_survei ?>"><?php echo $kode_peserta_survei; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_peserta_survei as $key){
                              ?>
                              <option value="<?php echo $key->kode_peserta_survei ?>"><?php echo $key->kode_peserta_survei ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_peserta_survei">Kode Peserta Survei <?php echo form_error('kode_peserta_survei') ?></label>
                          <select class="form-control" rows="3" name="kode_peserta_survei" id="kode_peserta_survei" value="<?php echo $kode_peserta_survei ?>"><?php echo $kode_peserta_survei; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_peserta_survei as $key){
                              ?>
                              <?php if ($key->kode_peserta_survei == $kode_peserta_survei): ?>
                                <option value="<?php echo $key->kode_peserta_survei ?>" selected="True"><?php echo $key->kode_peserta_survei ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_peserta_survei ?>"><?php echo $key->kode_peserta_survei ?></option>
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
                          <label class="form-label" for="kode_relasi_pertanyaan_bobot">Kode Relasi Pertanyaan Bobot <?php echo form_error('kode_relasi_pertanyaan_bobot') ?></label>
                          <select class="form-control" rows="3" name="kode_relasi_pertanyaan_bobot" id="kode_relasi_pertanyaan_bobot" value="<?php echo $kode_relasi_pertanyaan_bobot ?>"><?php echo $kode_relasi_pertanyaan_bobot; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_relasi_pertanyaan_bobot as $key){
                              ?>
                              <option value="<?php echo $key->kode_relasi_pertanyaan_bobot ?>"><?php echo $key->kode_relasi_pertanyaan_bobot ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_relasi_pertanyaan_bobot">Kode Relasi Pertanyaan Bobot <?php echo form_error('kode_relasi_pertanyaan_bobot') ?></label>
                          <select class="form-control" rows="3" name="kode_relasi_pertanyaan_bobot" id="kode_relasi_pertanyaan_bobot" value="<?php echo $kode_relasi_pertanyaan_bobot ?>"><?php echo $kode_relasi_pertanyaan_bobot; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_relasi_pertanyaan_bobot as $key){
                              ?>
                              <?php if ($key->kode_relasi_pertanyaan_bobot == $kode_relasi_pertanyaan_bobot): ?>
                                <option value="<?php echo $key->kode_relasi_pertanyaan_bobot ?>" selected="True"><?php echo $key->kode_relasi_pertanyaan_bobot ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_relasi_pertanyaan_bobot ?>"><?php echo $key->kode_relasi_pertanyaan_bobot ?></option>
                              <?php endif; ?>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                ?>
	    <div class="form-actions"><input type="hidden" name="id_survei" value="<?php echo $id_survei; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('survei') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>