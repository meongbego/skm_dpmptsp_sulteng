
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Jawaban <?php echo form_error('kode_jawaban') ?></label>
            <input type="text" class="form-control" name="kode_jawaban" id="kode_jawaban" placeholder="Kode Jawaban" value="<?php echo $kode_jawaban; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Jawaban <?php echo form_error('nm_jawaban') ?></label>
            <input type="text" class="form-control" name="nm_jawaban" id="nm_jawaban" placeholder="Nm Jawaban" value="<?php echo $nm_jawaban; ?>" />
        </div>
	<div class="form-group">
              <label class="form-label" for="ket_jawaban">Ket Jawaban <?php echo form_error('ket_jawaban') ?></label>
              <select class="form-control" rows="3" name="ket_jawaban" id="ket_jawaban"><?php echo $ket_jawaban; ?>
                <option value=""> Mohon Pilih Salah Satu</option> <!-- tolong edit -->
	            <option value="Y">Y</option>
	            <option value="N">N</option>
</select>
          </div>
	    <div class="form-actions"><input type="hidden" name="id_jawaban" value="<?php echo $id_jawaban; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jawaban') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>