<!-- Breadcrumb -->
		<div class="breadcrumbs overlay" style="background-image:url('https://source.unsplash.com/s9wPpQqo3d8/1600x500')">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<!-- Bread Menu -->
							<div class="bread-menu">
							</div>
							<!-- Bread Title -->
							<div class="bread-title"><h2>Profil Desa</h2></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- / End Breadcrumb -->
		
		<!-- About Us -->
		<section class="about-us section-space">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-6 col-12">
						<div class="about-content section-title default text-left">
							<!-- VISI -->
							<div class="section-top">
								<h1><span>Visi & Misi</span><b>Visi</b></h1>
							</div>
							<div class="section-bottom">
								<div class="text">
									<?= $profil['visi'] ?>
								</div>
							</div>

							<!-- MISI -->
							<div class="about-content section-title default text-left">
								<div class="section-top">
									<h1><b>Misi</b></h1>
								</div>
								<div class="section-bottom">
									<div class="text">
										<?= $profil['misi'] ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-6 col-12">
						<div class="about-content section-title default text-left">
							<!-- VISI -->
							<div class="section-top">
								<h1><span>Sejarah</span><b>Sejarah</b></h1>
							</div>
							<div class="section-bottom">
								<div class="text">
									<?= $profil['sejarah'] ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-6 col-12">
						<div class="about-content section-title default text-left">
							<!-- VISI -->
							<div class="section-top">
								<h1><span>Organisasi</span><b>Struktur Organisasi</b></h1>
							</div>
							<div class="section-bottom">
								<img src="<?= base_url('assets/img/profil_desa/').$profil['gambar_struktur'] ?>">
								<div class="text">
									<?= $profil['struktur'] ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-6 col-12">
						<div class="about-content section-title default text-left">
							<!-- VISI -->
							<div class="section-top">
								<h1><span>Organisasi</span><b>Pedukuhan</b></h1>
							</div>
							<div class="section-bottom">
								<div class="text col-4">
									<table class="table">
										<thead>
											<th>#</th>
											<th>Pedukuhan</th>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$pedukuhan = array_filter(explode('-',$profil['pedukuhan']),'strlen');
											foreach ($pedukuhan as $p) {
											?>
											<tr>
												<td><?= $no; $no++; ?></td>
												<td><?= $p ?></td>
											</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>	
		<!--/ End About Us -->

