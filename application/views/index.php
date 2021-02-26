<!-- Hero Slider -->
<section class="hero-slider style1">
	<div class="home-slider">
		<?php

		foreach ($slideshow as $key => $s) {

		?>
			<!-- Single Slider -->
			<div class="single-slider" style="background-image:url('<?= base_url('assets/img/slideshow/') . $s['gambar'] ?>')">
				<div class="slide-overlay"></div>
				<div class="container">
					<div class="row">
						<div class="col-lg col-md col-12">
							<div class="welcome-text">
								<div class="hero-text text-center">
									<h1><?= $s['judul'] ?></h1>
									<div class="p-text">
										<p style="font-size: 25px"><?= $s['keterangan'] ?></p>
									</div>
									<div class="button">
										<?php
										if (!empty($s['nama_btn1'])) {
										?>
											<a href="<?= $s['link_btn1'] ?>" class="bizwheel-btn theme-1 effect"><?= $s['nama_btn1'] ?></a>
										<?php
										}
										?>
										<?php
										if (!empty($s['nama_btn2'])) {
										?>
											<a href="<?= $s['link_btn2'] ?>" class="bizwheel-btn theme-2 effect"><?= $s['nama_btn2'] ?></a>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Single Slider -->

		<?php
		} //end foreach slideshow
		?>

	</div>
</section>
<!--/ End Hero Slider -->

<!-- Features Area -->
<section class="features-area section-bg">
	<div class="container">
		<div class="row">

			<?php
			foreach ($layanan as $key => $l) {
			?>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Single Feature -->
					<div class="single-feature">
						<div class="icon-head"><i class="fa fa-clipboard"></i></div>
						<h4><a href="<?= base_url('layanan/') . $l['slug'] ?>"><?= $l['judul'] ?></a></h4>
						<!-- 					<p><?= substr($l['konten'], 0, 120) ?></p> -->
						<div class="button">
							<a href="<?= base_url('layanan/') . $l['slug'] ?>" class="bizwheel-btn"><i class="fa fa-arrow-circle-o-right"></i>Lihat Persyaratan</a>
						</div>
					</div>
					<!--/ End Single Feature -->
				</div>
			<?php
			}
			?>

		</div>
		<div class="row my-4">
			<div class="col d-flex justify-content-end">
				<a href="<?= base_url('layanan') ?>" class="btn btn-light">Lebih Lengkap <span class="fa fa-fw fa-chevron-right"></span></a>
			</div>
		</div>
	</div>
</section>
<!--/ End Features Area -->

<!-- Call To Action -->
<section class="call-action overlay" style="background-image:url('https://source.unsplash.com/s9wPpQqo3d8/1500x300')">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="call-inner text-center">
					<h2><i>"<?= $jargon['jargon1'] ?>"</i></h2>
					<p><?= $jargon['subjargon1'] ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Call to action -->

<!-- Latest Blog -->
<section class="latest-blog section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
				<div class="section-title default text-center">
					<div class="section-top">
						<h1><span><i class="fa fa-paper-plane"></i></span><b>Kabar Terbaru</b></h1>
					</div>
					<div class="section-bottom">
						<div class="text">

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="blog-latest blog-latest-slider">

					<?php foreach ($berita as $b) {
					?>

						<div class="single-slider">
							<!-- Single Blog -->
							<div class="single-news ">
								<div class="news-head overlay">
									<span class="news-img" style="background-image:url('<?= base_url('assets/img/berita/') . $b['gambar'] ?>')"></span>
									<a href="<?= base_url('berita/') . $b['slug'] ?>" class="bizwheel-btn theme-2">Selengkapnya</a>
								</div>
								<div class="news-body">
									<div class="news-content">
										<h3 class="news-title"><a href="<?= base_url('berita/') . $b['slug'] ?>"><?= $b['judul'] ?></a></h3>
										<div class="news-text">
											<p><?= substr($b['konten'], 0, 120) ?></p>
										</div>
										<ul class="news-meta">
											<li class="date"><i class="fa fa-calendar"></i><?= date('j F Y', strtotime($b['tanggal_dibuat']))  ?></li>
											<li class="view"><i class="fa fa-folder"></i><?= $b['kategori'] ?></li>
										</ul>
									</div>
								</div>
							</div>
							<!--/ End Single Blog -->
						</div>

					<?php } ?>

				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col d-flex justify-content-end">
				<a href="<?= base_url('berita') ?>" class="btn btn-light">Lebih Lengkap <span class="fa fa-fw fa-chevron-right"></span></a>
			</div>
		</div>
	</div>
</section>
<!--/ End Latest Blog -->

<!-- Call To Action -->
<section class="call-action overlay" style="background-image:url('https://source.unsplash.com/s9wPpQqo3d8/1500x300')">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="call-inner">
					<h2><i>"<?= $jargon['jargon2'] ?>"</i></h2>
					<p><?= $jargon['subjargon2'] ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Call to action -->

<!-- Portfolio -->
<section class="portfolio section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
				<div class="section-title default text-center">
					<div class="section-top">
						<h1><span><i class="fa fa-heart"></i></span><b>Potensi Desa</b></h1>
					</div>
					<div class="section-bottom">
						<div class="text">
							<p>Ini hanya sebagian dari seluruh kekayaan desa kami. Lihat selengkapnya di <a href="<?= base_url('potensi') ?>">halaman ini</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="portfolio-menu">
					<!-- Portfolio Nav -->
					<ul id="portfolio-nav" class="portfolio-nav tr-list list-inline cbp-l-filters-work">
						<li data-filter="*" class="cbp-filter-item active">Semua</li>
						<?php foreach ($kat_potensi as $k) {
						?>
							<li data-filter=".<?= lcfirst($k['kategori']) ?>" class="cbp-filter-item"><?= $k['kategori'] ?></li>
						<?php
						} ?>
						<!--/ End Portfolio Nav -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="portfolio-main">
					<div id="portfolio-item" class="portfolio-item-active">

						<?php
						foreach ($potensi as $p) {
						?>
							<div class="cbp-item <?= lcfirst($p['kategori']) ?>">
								<!-- Single Portfolio -->
								<div class="single-portfolio">
									<div class="portfolio-head overlay">
										<img src="<?= base_url('assets/img/potensi/') . $p['gambar'] ?>" alt="#">
										<a class="more" href="<?= base_url('potensi/') . $p['slug'] ?>"><i class="fa fa-long-arrow-right"></i></a>
									</div>
									<div class="portfolio-content">
										<h4><a href="<?= base_url('potensi/') . $p['slug'] ?>"><?= $p['judul'] ?></a></h4>
										<p><?= $p['kategori'] ?></p>
									</div>
								</div>
								<!--/ End Single Portfolio -->
							</div>
						<?php
						} ?>


					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col d-flex justify-content-end">
				<a href="<?= base_url('potensi') ?>" class="btn btn-light">Lebih Lengkap <span class="fa fa-fw fa-chevron-right"></span></a>
			</div>
		</div>
	</div>
</section>
<!--/ End Portfolio -->

<!-- Client Area -->
<div class="clients section-bg">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="partner-slider">
					<?php foreach ($pranala as $p) {
					?>
						<!-- Single client -->
						<div class="single-slider">
							<div class="single-client">
								<a href="#" data-toggle="modal" id="pranala" data-target="#detailModal" data-judul="<?= $p['judul'] ?>" data-alamat="<?= $p['alamat'] ?>" data-telp="<?= $p['telp'] ?>" data-logo="<?= $p['logo'] ?>" data-web="<?= ($p['website']) ? $p['website'] : 'kosong' ?>" data-fb="<?= ($p['fb']) ? $p['fb'] : 'kosong' ?>" data-twitter="<?= ($p['twitter']) ? $p['twitter'] : 'kosong' ?>" data-ig="<?= ($p['ig']) ? $p['ig'] : 'kosong' ?>"><img src="<?= base_url('assets/img/pranala/') . $p['logo'] ?>" alt="#"></a>
							</div>
						</div>
						<!--/ End Single client -->
					<?php
					} ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Client Area -->


<!-- MODAL HAPUS STARTS HERE-->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalDetailLabel">Ini Judul</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col my-4">
					<img class="img-fluid" src="<?= base_url('assets/img/pranala/') ?>" width="200">
				</div>
				<div class="col">
					<p class="alamat"><strong><span class="fa fa-fw fa-home mr-2"></span></strong></p>
					<br>
					<p class="telp"><strong><span class="fa fa-fw fa-phone mr-2"></span></strong></p>
					<br>
				</div>
				<div class="col">
					<div class="btn-group" role="group" aria-label="Media sosial">
						<a type="button" href="#" class="btn btn-sm btn-light website" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" target="_blank"><span class="fa fa-fw fa-globe mr-2"></span></a>
						<a type="button" href="#" class="btn btn-sm btn-light fb" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" target="_blank"><span class="fa fa-fw fa-facebook mr-2"></span></a>
						<a type="button" href="#" class="btn btn-sm btn-light twitter" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" target="_blank"><span class="fa fa-fw fa-twitter mr-2"></span></a>
						<a type="button" href="#" class="btn btn-sm btn-light ig" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" target="_blank"><span class="fa fa-fw fa-instagram mr-2"></span></a>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- MODAL HAPUS ENDS HERE -->

<script type="text/javascript">
	$(function() {

		$('#detailModal').on('show.bs.modal', function(event) {
			$(this).find('.modal-body img').attr('src', '<?= base_url('assets/img/pranala/') ?>')
			$(this).find('.modal-body p.alamat').html('');
			$(this).find('.modal-body p.telp').html('');
			// 		$(this).find('.modal-body a.website').attr({
			//   href: '#',
			//   title: 'Judul'
			// });
			// 		$(this).find('.modal-body a.fb').attr({
			//   href: '#',
			//   title: 'Judul'
			// });
			// 		$(this).find('.modal-body a.twitter').attr({
			//   href: '#',
			//   title: 'Judul'
			// });
			// 		$(this).find('.modal-body a.ig').attr({
			//   href: '#',
			//   title: 'Judul'
			// });
			$(this).find('.modal-body a.website').show();
			$(this).find('.modal-body a.fb').show();
			$(this).find('.modal-body a.twitter').show();
			$(this).find('.modal-body a.ig').show();
			$(this).find('.modal-header .modal-title').html('');
			var button = $(event.relatedTarget) // Button that triggered the modal
			var alamat = button.data('alamat') // Extract info from data-* attributes
			var telp = button.data('telp')
			var logo = button.data('logo')
			var judul = button.data('judul')
			var web = button.data('web') // Extract info from data-* attributes
			var fb = button.data('fb')
			var twitter = button.data('twitter')
			var ig = button.data('ig')

			var modal = $(this);
			modal.find('.modal-header .modal-title').html(judul);
			modal.find('.modal-body p.alamat').html("<span class='fa fa-fw fa-home mr-2'></span>" + alamat);
			modal.find('.modal-body p.telp').html("<span class='fa fa-fw fa-phone mr-2'></span>" + telp);
			if (web == 'kosong') {
				modal.find('.modal-body a.website').hide();
			} else {
				modal.find('.modal-body a.website')
					.attr({
						href: web,
						title: web
					});

			}

			if (fb == 'kosong') {
				modal.find('.modal-body a.fb').hide();
			} else {
				modal.find('.modal-body a.fb').attr({
					href: fb,
					title: fb
				});

			}

			if (twitter == 'kosong') {
				modal.find('.modal-body a.twitter').hide();
			} else {
				modal.find('.modal-body a.twitter').attr({
					href: twitter,
					title: twitter
				});

			}

			if (ig == 'kosong') {
				modal.find('.modal-body a.ig').hide();
			} else {
				modal.find('.modal-body a.ig').attr({
					href: ig,
					title: ig
				});

			}

			modal.find('.modal-body img').attr('src', function(i, val) {
				return val + logo;
			});
		});

	})
</script>