<!-- Portfolio -->
<section class="portfolio section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-12">
				<div class="section-title default text-center">
					<div class="section-top">
						<h1><span><i class="fa fa-heart"></i></span><b>Potensi Desa</b></h1>
					</div>
					<div class="section-bottom">
						<div class="text">
							<p>Ini semua adalah kekayaan desa kami</p>
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
						<?php
						foreach ($kategori as $k) {
						?>
						<li data-filter=".<?= lcfirst($k['kategori']) ?>" class="cbp-filter-item"><?= $k['kategori'] ?></li>
						<?php
						} ?>
					</ul>
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
									<img src="<?= base_url('assets/img/potensi/').$p['gambar'] ?>" alt="#">
									<a class="more" href="<?= base_url('potensi/').$p['slug'] ?>"><i class="fa fa-long-arrow-right"></i></a>
								</div>
								<div class="portfolio-content">
									<h4><a href="<?= base_url('potensi/').$p['slug'] ?>"><?= $p['judul'] ?></a></h4>
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
	</div>
</section>
<!--/ End Portfolio -->