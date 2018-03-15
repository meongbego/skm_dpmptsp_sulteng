
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Relasi Pertanyaan Bobot <?php echo form_error('kode_relasi_pertanyaan_bobot') ?></label>
            <input type="text" class="form-control" name="kode_relasi_pertanyaan_bobot" id="kode_relasi_pertanyaan_bobot" placeholder="Kode Relasi Pertanyaan Bobot" value="<?php echo $kode_relasi_pertanyaan_bobot; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pertanyaan">Kode Pertanyaan <?php echo form_error('kode_pertanyaan') ?></label>
                          <select class="form-control" rows="3" name="kode_pertanyaan" id="kode_pertanyaan" value="<?php echo $kode_pertanyaan ?>"><?php echo $kode_pertanyaan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pertanyaan as $key){
                              ?>
                              <option value="<?php echo $key->kode_pertanyaan ?>"><?php echo $key->kode_pertanyaan ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pertanyaan">Kode Pertanyaan <?php echo form_error('kode_pertanyaan') ?></label>
                          <select class="form-control" rows="3" name="kode_pertanyaan" id="kode_pertanyaan" value="<?php echo $kode_pertanyaan ?>"><?php echo $kode_pertanyaan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pertanyaan as $key){
                              ?>
                              <?php if ($key->kode_pertanyaan == $kode_pertanyaan): ?>
                                <option value="<?php echo $key->kode_pertanyaan ?>" selected="True"><?php echo $key->kode_pertanyaan ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_pertanyaan ?>"><?php echo $key->kode_pertanyaan ?></option>
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
                          <label class="form-label" for="kode_jawaban">Kode Jawaban <?php echo form_error('kode_jawaban') ?></label>
                          <select class="form-control" rows="3" name="kode_jawaban" id="kode_jawaban" value="<?php echo $kode_jawaban ?>"><?php echo $kode_jawaban; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_jawaban as $key){
                              ?>
                              <option value="<?php echo $key->kode_jawaban ?>"><?php echo $key->kode_jawaban ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_jawaban">Kode Jawaban <?php echo form_error('kode_jawaban') ?></label>
                          <select class="form-control" rows="3" name="kode_jawaban" id="kode_jawaban" value="<?php echo $kode_jawaban ?>"><?php echo $kode_jawaban; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_jawaban as $key){
                              ?>
                              <?php if ($key->kode_jawaban == $kode_jawaban): ?>
                                <option value="<?php echo $key->kode_jawaban ?>" selected="True"><?php echo $key->kode_jawaban ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_jawaban ?>"><?php echo $key->kode_jawaban ?></option>
                              <?php endif; ?>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="int">Bobot <?php echo form_error('bobot') ?></label>
            <input type="text" class="form-control" name="bobot" id="bobot" placeholder="Bobot" value="<?php echo $bobot; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_relasi_pertanyaan_bobot" value="<?php echo $id_relasi_pertanyaan_bobot; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('relasi_pertanyaan_bobot') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>