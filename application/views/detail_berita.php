<!-- Blog Single -->
<section class="news-area archive blog-single section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-12">
				<div class="row">
					<div class="col-12">
						<div class="blog-single-main">
							<div class="main-image">
								<img src="<?= base_url('assets/img/berita/') . $berita['gambar'] ?>" alt="<?= $berita['judul'] ?>">
							</div>
							<div class="blog-detail">
								<!-- News meta -->
								<ul class="news-meta">
									<li><i class="fa fa-user"></i><?= $berita['posted_by'] ?></li>
									<li><i class="fa fa-pencil"></i><?= date('j F Y', strtotime($berita['tanggal_dibuat']))  ?></li>
									<li><i class="fa fa-folder"></i><?= $berita['kategori'] ?></li>
								</ul>
								<h2 class="blog-title"><?= $berita['judul'] ?></h2>
								<div class="row blog-space px-3">
									<?= $berita['konten'] ?>
								</div>

								<!-- Post Nav -->
								<div class="posts_nav">
									<div class="post-left"><a href="<?= base_url('berita/') . $prev['slug'] ?>"><span class="fa fa-chevron-left"></span> Berita Sebelum</a></div>
									<div class="post-right"><a href="<?= base_url('berita/') . $next['slug'] ?>">Berita Setelah <span class="fa fa-chevron-right"></span></a></div>
								</div>

								<div class="row mb-5">
									<div class="col">
										<ul class="list-group list-group-flush">
											<?php
											foreach ($some_berita as $l) {
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
				<!-- <div class="row">
					<div class="col-12">
						<div class="blog-comments-form">
							<div class="bottom-title">
								<h2>Tinggalkan Komentar</h2>
								<p>Kolom bertanda bintang (*) wajib diisi</p>
							</div>

							<form class="form" method="post" action="mail/mail.php">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-12">
										<div class="form-group">
											<label>Nama<span>*</span></label>
											<input type="text" name="name" required="required">
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-12">
										<div class="form-group">
											<label>Email<span>*</span></label>
											<input type="email" name="email" required="required">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Komentar<span>*</span></label>
											<textarea name="message" rows="6"></textarea>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group button">
											<button type="submit" class="bizwheel-btn primary effect">Kirim<i class="fa fa-paper-plane"></i></button>
										</div>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</section>
<!--/ End Services -->