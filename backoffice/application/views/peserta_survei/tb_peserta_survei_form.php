
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Peserta Survei <?php echo form_error('kode_peserta_survei') ?></label>
            <input type="text" class="form-control" name="kode_peserta_survei" id="kode_peserta_survei" placeholder="Kode Peserta Survei" value="<?php echo $kode_peserta_survei; ?>" />
        </div>
	<div class="form-group">
              <label class="form-label" for="status_isi">Status Isi <?php echo form_error('status_isi') ?></label>
              <select class="form-control" rows="3" name="status_isi" id="status_isi"><?php echo $status_isi; ?>
                <option value=""> Mohon Pilih Salah Satu</option> <!-- tolong edit -->
	            <option value="Y">Y</option>
	            <option value="N">N</option>
	            <option value="T">T</option>
</select>
          </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pegawai">Kode Pegawai <?php echo form_error('kode_pegawai') ?></label>
                          <select class="form-control" rows="3" name="kode_pegawai" id="kode_pegawai" value="<?php echo $kode_pegawai ?>"><?php echo $kode_pegawai; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pegawai as $key){
                              ?>
                              <option value="<?php echo $key->kode_pegawai ?>"><?php echo $key->kode_pegawai ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pegawai">Kode Pegawai <?php echo form_error('kode_pegawai') ?></label>
                          <select class="form-control" rows="3" name="kode_pegawai" id="kode_pegawai" value="<?php echo $kode_pegawai ?>"><?php echo $kode_pegawai; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pegawai as $key){
                              ?>
                              <?php if ($key->kode_pegawai == $kode_pegawai): ?>
                                <option value="<?php echo $key->kode_pegawai ?>" selected="True"><?php echo $key->kode_pegawai ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_pegawai ?>"><?php echo $key->kode_pegawai ?></option>
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
                          <label class="form-label" for="kode_tahun_survei">Kode Tahun Survei <?php echo form_error('kode_tahun_survei') ?></label>
                          <select class="form-control" rows="3" name="kode_tahun_survei" id="kode_tahun_survei" value="<?php echo $kode_tahun_survei ?>"><?php echo $kode_tahun_survei; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_tahun_survei as $key){
                              ?>
                              <option value="<?php echo $key->kode_tahun_survei ?>"><?php echo $key->kode_tahun_survei ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_tahun_survei">Kode Tahun Survei <?php echo form_error('kode_tahun_survei') ?></label>
                          <select class="form-control" rows="3" name="kode_tahun_survei" id="kode_tahun_survei" value="<?php echo $kode_tahun_survei ?>"><?php echo $kode_tahun_survei; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_tahun_survei as $key){
                              ?>
                              <?php if ($key->kode_tahun_survei == $kode_tahun_survei): ?>
                                <option value="<?php echo $key->kode_tahun_survei ?>" selected="True"><?php echo $key->kode_tahun_survei ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_tahun_survei ?>"><?php echo $key->kode_tahun_survei ?></option>
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
                          <label class="form-label" for="kode_status_survei">Kode Status Survei <?php echo form_error('kode_status_survei') ?></label>
                          <select class="form-control" rows="3" name="kode_status_survei" id="kode_status_survei" value="<?php echo $kode_status_survei ?>"><?php echo $kode_status_survei; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_status_survei as $key){
                              ?>
                              <option value="<?php echo $key->kode_status_survei ?>"><?php echo $key->kode_status_survei ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_status_survei">Kode Status Survei <?php echo form_error('kode_status_survei') ?></label>
                          <select class="form-control" rows="3" name="kode_status_survei" id="kode_status_survei" value="<?php echo $kode_status_survei ?>"><?php echo $kode_status_survei; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_status_survei as $key){
                              ?>
                              <?php if ($key->kode_status_survei == $kode_status_survei): ?>
                                <option value="<?php echo $key->kode_status_survei ?>" selected="True"><?php echo $key->kode_status_survei ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_status_survei ?>"><?php echo $key->kode_status_survei ?></option>
                              <?php endif; ?>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                ?>
	    <div class="form-actions"><input type="hidden" name="id_peserta_survei" value="<?php echo $id_peserta_survei; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('peserta_survei') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>