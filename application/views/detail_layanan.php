<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('https://source.unsplash.com/s9wPpQqo3d8/1600x500')">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<!-- Bread Title -->
					<div class="bread-title">
						<h2><?= $title ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- / End Breadcrumb -->

<!-- Konten -->
<div class="container">
	<div class="row">
		<div class="col">
			<div class="card my-5 px-3">
				<div class="card-body">
					<?= $layanan['konten'] ?>
					<?php if ($layanan['file']) {
					?>
						<div class="ml-0">
							<a href="<?= base_url('assets/files/') . $layanan['file'] ?>" class="btn btn-sm btn-primary px-2"><span class="fa fa-sm fa-download mr-2"></span>Download lampiran</a>
							<br>
							<small><?= $layanan['file'] ?></small>
						</div>
					<?php
					} ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<a href="<?= base_url('layanan') ?>" class="btn btn-light mr-auto px-3 mb-5 bd-highlight"><span class="fa fa-fw fa-sm fa-arrow-left"></span><small> Kembali</small></a>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col">
			<p>Layanan lain</p>
			<ul class="list-group list-group-flush">
				<?php
				foreach ($some_layanan as $l) {
				?>
					<li class="list-group-item">
						<div class="row">
							<span class="fa fa-fw fa-sm fa-clipboard mr-2"></span>
							<a href="<?= base_url('layanan/') . $l['slug'] ?>"><?= $l['judul'] ?></a>
						</div>
					</li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>

</div>