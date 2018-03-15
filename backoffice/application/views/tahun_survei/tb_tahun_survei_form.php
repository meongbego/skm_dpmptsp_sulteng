
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Tahun Survei <?php echo form_error('kode_tahun_survei') ?></label>
            <input type="text" class="form-control" name="kode_tahun_survei" id="kode_tahun_survei" placeholder="Kode Tahun Survei" value="<?php echo $kode_tahun_survei; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Tahun <?php echo form_error('nm_tahun') ?></label>
            <input type="text" class="form-control" name="nm_tahun" id="nm_tahun" placeholder="Nm Tahun" value="<?php echo $nm_tahun; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_tahun_survei" value="<?php echo $id_tahun_survei; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tahun_survei') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>