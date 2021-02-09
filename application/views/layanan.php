<!-- Portfolio -->
<section class="portfolio section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-12">
				<div class="section-title default text-center">
					<div class="section-top">
						<h1><span><i class="fa fa-clipboard"></i></span><b>Layanan Masyarakat</b></h1>
					</div>
					<div class="section-bottom">
						<div class="text">
							<p>Prosedur dan persyaratan pelayanan administrasi masyarakat</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col d-flex justify-content-center">
				<div class="col-6 form-group">
					<input class="form-control form-control-lg" type="text" name="search" id="search" placeholder="Cari layanan disini..." placeholder=".form-control-lg" style="height: 50px; border-radius: 20px; text-align: center;">
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="portfolio-menu">
					<!-- Portfolio Nav -->
					<ul id="portfolio-nav" class="portfolio-nav tr-list list-inline cbp-l-filters-work">
						<li data-filter="all" class="cbp-filter-item active">Semua</li>
						<?php
						foreach ($kategori as $k) {
						?>
						<li data-filter="<?= strtolower(trim(str_replace(' ', '', $k['kategori']))) ?>"><?= $k['kategori'] ?></li>
						<?php
						}
						?>
					</ul>
					<!--/ End Portfolio Nav -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<ul class="list-group list-group-flush">
						<?php
						foreach ($layanan as $key => $l) {
						?>
						<li class="list-group-item" data-filter="<?= strtolower(trim(str_replace(' ', '', $l['kategori']))) ?>">
							<div class="row">
								<span class="fa fa-fw fa-clipboard mx-3 my-2"></span>
								<a href="<?= base_url('layanan/').$l['slug'] ?>"><span class="badge badge-light mr-3"><?= $l['kategori'] ?></span> <?= $l['judul'] ?></a>
								<?php if ($l['file']) {
								?>
								<a href="<?= base_url('assets/files/').$l['file'] ?>" class='ml-3'><span class="fa fa-download"></span></a>
								<?php
								} ?>

							</div>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Portfolio -->

<script type="text/javascript">

	$(function (){

		$('#portfolio-nav li[data-filter]').on('click', function() {

			$('#portfolio-nav li.active').removeClass('active');

			$('.list-group li').show();

			var kat = $(this).attr('data-filter');
			
			$('.list-group li').not('[data-filter='+kat+']').hide();

			$(this).addClass('active');
		});


		$('#portfolio-nav li[data-filter=all]').on('click', function() {
			$('#portfolio-nav li.active').removeClass('active');
			$('.list-group li').show();
			$(this).addClass('active');
		});


		$('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $(".list-group li").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

	});
</script>