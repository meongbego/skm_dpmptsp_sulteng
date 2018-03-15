<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h3 class="page-header"><b ><?php echo $title ?></b></h3>
  </div>

  <div class="col-md-8">
  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
    <div class="form-group">
      <label class="form-label" for="varchar">Kode Relasi Pertanyaan Bobot <?php echo form_error('kode_relasi_pertanyaan_bobot') ?></label>
      <?php if ($uri == 'create'): ?>
        <input type="text" class="form-control" name="kode_relasi_pertanyaan_bobot" id="kode_relasi_pertanyaan_bobot" placeholder="Kode Relasi Pertanyaan Bobot" value="<?php echo $kode_relasi_pertanyaan_bobot; ?>" readonly/>
      <?php else: ?>
        <input type="text" class="form-control" name="kode_relasi_pertanyaan_bobot" id="kode_relasi_pertanyaan_bobot" placeholder="Kode Relasi Pertanyaan Bobot" value="<?php echo $kode_relasi_pertanyaan_bobot; ?>" />
      <?php endif; ?>

    </div>
    <div class="form-group">
      <label class="form-label" for="varchar">Kode Pertanyaan <?php echo form_error('kode_pertanyaan') ?></label>
      <?php if ($uri == 'create'): ?>
        <input type="text" class="form-control" name="kode_pertanyaan" id="kode_pertanyaan" placeholder="Kode Pertanyaan" value="<?php echo $kode_pertanyaan; ?>" readonly/>
      <?php else: ?>
        <input type="text" class="form-control" name="kode_pertanyaan" id="kode_pertanyaan" placeholder="Kode Pertanyaan" value="<?php echo $kode_pertanyaan; ?>" />
      <?php endif; ?>
    </div>
                <?php
                if($uri == 'create'){
                  ?>
	                 <div class="form-group">
                          <label class="form-label" for="kode_jawaban">Kode Jawaban <?php echo form_error('kode_jawaban') ?></label>
                          <select class="form-control" rows="3" name="kode_jawaban" id="kode_jawaban" value="<?php echo $kode_jawaban ?>"><?php echo $kode_jawaban; ?>
                            <option value=""> ---- Mohon Pilih Salah Satu ----</option>
                            <?php
                            foreach($tb_jawaban as $key){
                              ?>
                              <option value="<?php echo $key->kode_jawaban ?>"><?php echo $key->nm_jawaban ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Jawaban <?php echo form_error('kode_jawaban') ?></label>
                          <input type="text" class="form-control" name="kode_jawaban" id="kode_jawaban" placeholder="Kode Jawaban" value="<?php echo $kode_jawaban; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="int">Bobot <?php echo form_error('bobot') ?></label>
            <!-- <input type="text" class="form-control" name="bobot" id="bobot" placeholder="Bobot" value="<?php echo $bobot; ?>" /> -->
            <select class="form-control" name="bobot" id="bobot" placeholder="Bobot">
              <option value="">--------------Pilih--------------</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
        </div>
	    <div class="form-actions"><input type="hidden" name="id_relasi_pertanyaan_bobot" value="<?php echo $id_relasi_pertanyaan_bobot; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
      <?php
       ?>
	    <a href="<?php echo site_url('config_pertanyaan/konfigurasi/'.$kode_pertanyaan) ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>
