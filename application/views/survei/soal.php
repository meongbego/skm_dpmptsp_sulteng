<section class="bg-primary">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <form class="" action="<?php echo site_url('survei/finish') ?>" method="post" class="form" role="form">

          <input type="hidden" name="kode_peserta_survei" value="<?php echo $this->uri->segment(3) ?>">
          <?php $no=1 ?>
          <?php foreach ($data_soal as $key =>$value): ?>
            <div class="form-group">
              <label for="">
                <?php echo $no++ ?>.
                <?php echo $value["nm_soal"] ?>
              </label><br>
              <?php foreach ($value['jawaban'] as $key): ?>
                <label class="radio-inline">
                  <input type="radio" name="<?php echo $value["kode_pertanyaan"] ?>" value="<?php echo $key->kode_relasi_pertanyaan_bobot ?>" required>
                  <?php echo $key->nm_jawaban ?>
                </label>
                <br>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
          <div class="form-group">
            <button type="submit" class="btn btn-success btn-xl page-scroll">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
