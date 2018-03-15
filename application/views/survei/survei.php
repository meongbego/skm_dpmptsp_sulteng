<section class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Masukan Data Diri Anda</h3><hr>
                <form class="form" role="form" action="<?php echo site_url("survei/save_biodata") ?>" method="post">
                    <input type="hidden" name="kode_formulir" id="kode_formulir" required="" readonly>
                    <div class="form-group">
                        <label class="">Umur</label>
                        <input type="text" name="umur" id="umur" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label class="">Jenis Kelamin</label>
                        <select class="form-control" name="jenkel" required>
                            <option value="">-------- Pilih Salah Satu --------</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pendidikan Terakhir</label>
                        <select class="form-control" name="pendidikan" required>
                            <option value="">-------- Pilih Salah Satu --------</option>
                            <?php foreach ($dt_pendidikan as $key): ?>
                                <option value="<?php echo $key->kode_pendidikan ?>"><?php echo $key->kode_pendidikan ?> | <?php echo $key->nm_pendidikan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pekerjaan</label>
                        <select class="form-control" name="pekerjaan" required>
                            <option value="">-------- Pilih Salah Satu --------</option>
                            <?php foreach ($dt_pekerjaan as $key): ?>
                                <option value="<?php echo $key->kode_pekerjaan ?>"><?php echo $key->kode_pekerjaan ?> | <?php echo $key->nm_pekerjaan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Survei</label>
                        <select class="form-control" name="tahun_survei" required>
                            <option value="">-------- Pilih Salah Satu --------</option>
                            <?php foreach ($dt_tahun as $key): ?>
                                <option value="<?php echo $key->kode_tahun_survei ?>"><?php echo $key->kode_tahun_survei ?> | <?php echo $key->nm_tahun ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Status Survei</label>
                        <select class="form-control" name="status_survei" required>
                            <option value="">-------- Pilih Salah Satu --------</option>
                            <?php foreach ($dt_status as $key): ?>
                                <option value="<?php echo $key->kode_status_survei ?>"><?php echo $key->kode_status_survei ?> | <?php echo $key->nm_status_survei ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pegawai</label>
                        <select class="form-control" name="pegawai" required>
                            <?php foreach ($dt_pegawai as $key): ?>
                                <option value="<?php echo $key->kode_pegawai ?>"><?php echo $key->kode_pegawai ?> | <?php echo $key->nm_pegawai ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="form-control btn btn-block btn-default btn-sm sr-button">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
