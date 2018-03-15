
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span><h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Kategori Pertanyaan <?php echo form_error('kode_kategori_pertanyaan') ?></label>
            <input type="text" class="form-control" name="kode_kategori_pertanyaan" id="kode_kategori_pertanyaan" placeholder="Kode Kategori Pertanyaan" value="<?php echo $kode_kategori_pertanyaan; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Kategori Pertanyaan <?php echo form_error('nm_kategori_pertanyaan') ?></label>
            <input type="text" class="form-control" name="nm_kategori_pertanyaan" id="nm_kategori_pertanyaan" placeholder="Nm Kategori Pertanyaan" value="<?php echo $nm_kategori_pertanyaan; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_kategori_pertanyaan" value="<?php echo $id_kategori_pertanyaan; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('kategori_pertanyaan') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>
