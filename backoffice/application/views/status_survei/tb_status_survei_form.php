
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Status Survei <?php echo form_error('kode_status_survei') ?></label>
            <input type="text" class="form-control" name="kode_status_survei" id="kode_status_survei" placeholder="Kode Status Survei" value="<?php echo $kode_status_survei; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Status Survei <?php echo form_error('nm_status_survei') ?></label>
            <input type="text" class="form-control" name="nm_status_survei" id="nm_status_survei" placeholder="Nm Status Survei" value="<?php echo $nm_status_survei; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_status_survei" value="<?php echo $id_status_survei; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('status_survei') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>