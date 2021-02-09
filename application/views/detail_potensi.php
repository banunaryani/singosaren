<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('https://via.placeholder.com/1600x500')">
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

<!-- Konten -->
<div class="container">
	<div class="row">
		<div class="col">
			<div class="mt-3">
			</div>
			<div class="card my-5">
				<div class="card-body">
					<small class="mb-5" ><strong> Kategori: </strong><span class="fa fa-fw fa-folder fa-sm"></span> <?= $potensi['kategori'] ?> | <strong>Dipost oleh: </strong><span class="fa fa-fw fa-user  fa-sm"></span> <?= $potensi['posted_by'] ?></small>
					<img class="img-fluid mx-auto d-block mt-4 mb-5" src="<?= base_url('assets/img/potensi/').$potensi['gambar'] ?>">
					<?= $potensi['konten'] ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<a href="<?= base_url('potensi') ?>" class="btn btn-light mr-auto px-3 mb-5 bd-highlight"><span class="fa fa-fw fa-sm fa-arrow-left"></span><small> Kembali</small></a>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col">
			<p>Potensi lainnya</p>
			<ul class="list-group list-group-flush">
				<?php
				foreach($some_potensi as $l) { 
				?>
				<li class="list-group-item">
					<div class="row">
						<span class="fa fa-fw fa-sm fa-clipboard mr-2"></span>
						<a target="_blank" href="<?= base_url('potensi/').$l['slug'] ?>"><?= $l['judul'] ?></a>
					</div>
				</li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>
	
</div>