<!-- Breadcrumb -->
		<div class="breadcrumbs overlay" style="background-image:url('https://source.unsplash.com/s9wPpQqo3d8/1600x500')">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<!-- Bread Title -->
							<div class="bread-title"><h2><?= $title ?></h2></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- / End Breadcrumb -->
		
		<!-- Blog Layout -->
		<section class="blog-layout news-default section-space">
			<div class="container">

				<div class="row">
					<div class="col d-flex justify-content-center">
						<div class="col-6 form-group">
							<input class="form-control form-control-lg" type="text" name="search" id="search" placeholder="Cari berita disini..." placeholder=".form-control-lg" style="height: 50px; border-radius: 20px; text-align: center;">
						</div>
						
					</div>
				</div>

				<div class="row">


					<?php
					foreach ($berita as $b) {
					?>

					<div class="col-lg-4 col-md-6 col-12 per-berita">
						<!-- Single Blog -->
						<div class="single-news ">
							<div class="news-head overlay">
								<img src="<?= base_url('assets/img/berita/').$b['gambar'] ?>" alt="<?= $b['judul'] ?>">
								<ul class="news-meta">
									<li class="author"><a href="#"><i class="fa fa-user"></i><?= $b['posted_by'] ?></a></li>
									<li class="date"><i class="fa fa-calendar"></i><?= $b['tanggal_dibuat'] ?></li>
									<li class="view"><i class="fa fa-folder"></i><?= $b['kategori'] ?></li>
								</ul>
							</div>
							<div class="news-body">
								<div class="news-content">
									<h3 class="news-title"><a href="<?= base_url('berita/').$b['slug'] ?>"><?= $b['judul'] ?></a></h3>
									<div class="news-text"><p><?= substr($b['konten'],0,100) ?></p></div>
									<a href="<?= base_url('berita/').$b['slug'] ?>" class="more">Selengkapnya <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
						<!--/ End Single Blog -->
					</div>

					<?php
					}
					?>

					
				</div>
				<div class="row">
					<div class="col-12 d-flex justify-content-end">
						<!-- Pagination -->
						<div class="pagination-plugin">
								<?= $pages ?>
							<!-- <ul class="pagination-list">
								<li class="prev"><a href="#">Prev</a></li>
								<li class="page-numbers"><a href="#">1</a></li>
								<li class="page-numbers current"><a href="#">2</a></li>
								<li class="page-numbers"><a href="#">3</a></li>
								<li class="next"><a href="#">Next</a></li>
							</ul> -->
						</div>
						<!--/ End Pagination -->
					</div>
				</div>
			</div>
		</section>

		<script type="text/javascript">
			$(function(){

				$('#search').on('keyup', function() {
					var value = $(this).val().toLowerCase();
					$(".per-berita").filter(function() {
						$(this).toggle($(this).html().toLowerCase().indexOf(value) > -1)
					});
				});

			});
		</script>