
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Pertanyaan <?php echo form_error('kode_pertanyaan') ?></label>
            <input type="text" class="form-control" name="kode_pertanyaan" id="kode_pertanyaan" placeholder="Kode Pertanyaan" value="<?php echo $kode_pertanyaan; ?>" />
        </div>
        <?php
                if($uri == 'create'){
                  ?>
	                   <div class="form-group">
                          <label class="form-label" for="kode_kategori_pertanyaan">Kode Kategori Pertanyaan <?php echo form_error('kode_kategori_pertanyaan') ?></label>
                          <select class="form-control" rows="3" name="kode_kategori_pertanyaan" id="kode_kategori_pertanyaan" value="<?php echo $kode_kategori_pertanyaan ?>"><?php echo $kode_kategori_pertanyaan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_kategori_pertanyaan as $key){
                              ?>
                              <option value="<?php echo $key->kode_kategori_pertanyaan ?>"><?php echo $key->kode_kategori_pertanyaan ?> | <?php echo $key->nm_kategori_pertanyaan ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	                 <div class="form-group">
                          <label class="form-label" for="kode_kategori_pertanyaan">Kode Kategori Pertanyaan <?php echo form_error('kode_kategori_pertanyaan') ?></label>
                          <select class="form-control" rows="3" name="kode_kategori_pertanyaan" id="kode_kategori_pertanyaan" value="<?php echo $kode_kategori_pertanyaan ?>"><?php echo $kode_kategori_pertanyaan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_kategori_pertanyaan as $key){
                              ?>
                              <?php if ($key->kode_kategori_pertanyaan == $kode_kategori_pertanyaan): ?>
                                <option value="<?php echo $key->kode_kategori_pertanyaan ?>" selected="True"><?php echo $key->kode_kategori_pertanyaan ?></option>
                              <?php else: ?>
                                <option value="<?php echo $key->kode_kategori_pertanyaan ?>"><?php echo $key->kode_kategori_pertanyaan ?></option>
                              <?php endif; ?>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                ?>
	      <div class="form-group">
            <label class="form-label" for="ket_pertanyaan">Pertanyaan <?php echo form_error('ket_pertanyaan') ?></label>
            <textarea class="form-control" rows="3" name="ket_pertanyaan" id="ket_pertanyaan" placeholder="Pertanyaan"><?php echo $ket_pertanyaan; ?></textarea>
        </div>
	<!-- <div class="form-group">
              <label class="form-label" for="status_config">Status Config <?php echo form_error('status_config') ?></label>
              <select class="form-control" rows="3" name="status_config" id="status_config"><?php echo $status_config; ?>
                <option value=""> Mohon Pilih Salah Satu</option>
	            <option value="Y">Y</option>
	            <option value="N">N</option>
</select>
          </div> -->
	    <div class="form-actions"><input type="hidden" name="id_pertanyaan" value="<?php echo $id_pertanyaan; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('pertanyaan') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>
