<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SKM</title>

<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/plugins/dataTables/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/datepicker3.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet">
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
<script src="<?php echo base_url('assets/js/lumino.glyphs.js') ?>"></script>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>SKM</span> DATA</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $this->session->userdata('username') ?></a></li>
							<li><a href="<?php echo site_url('auth/logout') ?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="<?php echo base_url() ?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-4"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Pengguna
				</a>
				<ul class="children collapse" id="sub-item-4">
					<li>
						<a class="" href="<?php echo site_url('admin') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Admin
						</a>
					</li>
				</ul>
			</li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Master Data
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="<?php echo site_url('pendidikan') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Pendidikan
						</a>
					</li>
					<li>
						<a class="" href="<?php echo site_url('pekerjaan') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Pekerjaan
						</a>
					</li>
					<li>
						<a class="" href="<?php echo site_url('status_survei') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Jenis Survei
						</a>
					</li>
					<li>
						<a class="" href="<?php echo site_url('tahun_survei') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Tahun Survei
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>

			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Pertanyaan Dan Jawaban
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="<?php echo site_url('pertanyaan') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Pertanyaan
						</a>
					</li>
					<li>
						<a class="" href="<?php echo site_url('kategori_pertanyaan') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Kategori Pertanyaan
						</a>
					</li>
					<li>
						<a class="" href="<?php echo site_url('jawaban') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Jawaban
						</a>
					</li>
					<!-- <li>
						<a class="" href="<?php echo site_url('config_pertanyaan') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Konfigurasi
						</a>
					</li> -->
				</ul>
			</li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-5"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Peserta Survei
				</a>
				<ul class="children collapse" id="sub-item-5">
					<li>
						<a class="" href="<?php echo site_url('peserta') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Peserta
						</a>
					</li>
					<li>
						<a class="" href="<?php echo site_url('peserta_survei') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Konfigurasi Peserta
						</a>
					</li>
				</ul>
			</li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-6"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Hitung Survei
				</a>
				<ul class="children collapse" id="sub-item-6">
					<li>
						<a class="" href="<?php echo site_url('survei') ?>">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Hitung Hasil
						</a>
					</li>
				</ul>
			</li>
		</ul>

	</div><!--/.sidebar-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<?php echo $view; ?>
	</div>	<!--/.main-->

	<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/easypiechart.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/easypiechart-data.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/qcode-decoder.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/plugins/dataTables/js/jquery.dataTables.js') ?>"></script>
	<script src="<?php echo base_url('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') ?>"></script>
  <?php
      if ($assign_js != '') {
          $this->load->view($assign_js);
      }
  ?>

  <script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d'
    });

    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
      if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
  </script>

</body>

</html>
