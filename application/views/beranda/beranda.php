<header>
<div class="header-content">
    <div class="header-content-inner">
        <h1 id="homeHeading">SELAMAT DATANG DI SURVEI KEPUASAN MASYARAKAT <br>INSTANSI</h1>
        <hr>
        <p class="">
            <h4><i>Bantu Kami Meningkatkan Kualitas Pelayanan</i></h4>
        </p>
        <a href="<?php echo site_url("survei") ?>" class="btn btn-primary btn-xl page-scroll">Survei Sekarang</a>
    </div>
</div>
</header>

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
            <h2>Privasi</h2><hr>
            <h4>
              <i>Kami sangat menjaga mengenai kerahasiaan data anda, data yang kami publis tidak akan bersifat sensitif dan merugikan</i>
            </h4>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark" id="service">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
            <h2>HASIL SURVEI <?php echo $nm_tahun ?></h2><hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>Keterangan</th>
                    <?php foreach ($unsur_pelayanan as $key): ?>
                    <th><?php echo $key->kode_kategori_pertanyaan ?></th>
                    <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th>Semua Nilai / Unsur</th>
                    <?php foreach ($data_hasil_hitung as $key => $value): ?>
                        <td><?php echo $value['total_bobot'] ?></td>
                    <?php endforeach; ?>
                    </tr>
                    <tr>
                    <th>NRR / Unsur</th>
                    <?php foreach ($data_hasil_hitung as $key => $value): ?>
                        <td><?php echo number_format($value['nrr_unsur'],3)  ?></td>
                    <?php endforeach; ?>
                    </tr>
                    <tr>
                    <th>NRR Tertimbang / Unsur</th>
                    <?php foreach ($data_hasil_hitung as $key => $value): ?>
                        <td><?php echo number_format($value['nrr_tertimbang'],3)  ?></td>
                    <?php endforeach; ?>
                    </tr>
                    <tr>
                    <th>Nilai IKM</th>
                    <th colspan="<?php echo $jumlah_unsur ?>"><?php echo number_format($nilai_ikm,3)  ?></th>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


