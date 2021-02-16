<!-- Blog Single -->
<section class="news-area archive blog-single section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-12">
				<div class="row">
					<div class="col-12">
						<div class="blog-single-main">
							<div class="main-image">
								<img src="<?= base_url('assets/img/potensi/') . $potensi['gambar'] ?>" alt="<?= $potensi['judul'] ?>">
							</div>
							<div class="blog-detail">
								<!-- News meta -->
								<ul class="news-meta">
									<li><i class="fa fa-user"></i><?= $potensi['posted_by'] ?></li>
									<li><i class="fa fa-pencil"></i><?= date('j F Y', strtotime($potensi['tanggal_dibuat']))  ?></li>
									<li><i class="fa fa-folder"></i><?= $potensi['kategori'] ?></li>
								</ul>
								<h2 class="blog-title"><?= $potensi['judul'] ?></h2>
								<div class="row blog-space px-3">
									<?= $potensi['konten'] ?>
								</div>

								<!-- Post Nav -->
								<div class="row">
									<div class="col">
										<a href="<?= base_url('potensi') ?>" class="btn btn-light mr-auto px-3 mb-5 bd-highlight"><span class="fa fa-fw fa-sm fa-arrow-left"></span><small> Kembali</small></a>
									</div>
								</div>

								<div class="row mb-5">
									<div class="col">
										<ul class="list-group list-group-flush">
											<?php
											foreach ($some_potensi as $l) {
											?>
												<li class="list-group-item">
													<div class="row">
														<span class="fa fa-fw fa-sm fa-clipboard mr-2"></span>
														<a href="<?= base_url('berita/') . $l['slug'] ?>"><?= $l['judul'] ?></a>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Services -->