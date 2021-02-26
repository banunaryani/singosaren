<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Slideshow</h1>

	<?php echo $this->session->flashdata('message');
	$jumlah = count($slideshow);
	?>

	<div class="card mt-3">
		<div class="card-header py-3">
			<div class="row">
				<div class="ml-4 mx-2">
					<a href="<?= base_url('user/tambah_slideshow') ?>" class="btn btn-primary px-3"><i class="fas fa-plus mr-2"></i><strong>Tambah Slideshow</strong></a>
				</div>
			</div>
		</div>

		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Gambar</th>
						<th>Judul</th>
						<th>Keterangan</th>
						<th>Tombol</th>
						<th>Aktif/Tidak aktif</th>
						<th>Urutan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$no = 1;

					foreach ($slideshow as $ss) {

					?>

						<tr class="<?= ($ss['urutan'] == 1) ? "table-secondary" : "" ?>">
							<th scope="row"><?= $no;
											$no++; ?></th>
							<td>
								<img width="100" src="<?= base_url('assets/img/slideshow/' . $ss['gambar']) ?>">
							</td>
							<td><?= $ss['judul'] ?></td>
							<td><?= $ss['keterangan'] ?></td>
							<td>
								<?php

								if ($ss['nama_btn1'] !== "") {

								?>
									<div class="col">
										<button type="button" class="btn btn-secondary" disabled><?= $ss['nama_btn1'] ?></button>
										<br>
										<small><strong>Link : </strong><?= $ss['link_btn1'] ?></small>
									</div>
								<?php }
								if ($ss['nama_btn2'] !== "") {

								?>

									<div class="col">
										<button type="button" class="btn btn-secondary" disabled><?= $ss['nama_btn2'] ?></button>
										<br>
										<small><strong>Link : </strong><?= $ss['link_btn2'] ?></small>
									</div>
								<?php }
								?>

							</td>
							<td>
								<!-- Rounded switch -->
								<form method="post" action="<?= base_url() ?>user/toggle_arsipkan_slideshow/<?= $ss['id'] . "/" . $ss['arsipkan'] ?>">
									<label class="switch">
										<input type="checkbox" id="arsipkan" name="arsipkan" <?php echo ($ss['arsipkan'] == 1) ? 'checked' : ''; ?> onChange="this.form.submit()">
										<span class="slider round"></span>
									</label>
								</form>
							</td>
							<td>
								<?= $ss['urutan'] . "/" . $jumlah ?>
							</td>
							<td>
								<div class="row mb-2">
									<a href="<?= base_url('user/edit_slideshow/' . $ss['id']) ?>" class="btn btn-sm btn-primary"><span class="fas fa-fw fa-sm fa-pen"></span></a>
								</div>
								<div class="row mb-2">
									<?php
									if ($ss['urutan'] !== 1) {
									?>
										<button type="button" data-toggle="modal" data-target="#hapusModal-<?= $ss['id'] ?>" class="btn btn-sm remove btn-danger"><span class="fas fa-fw fa-sm fa-trash"></span></button>
									<?php
									}
									?>
								</div>
							</td>
						</tr>

						<!-- MODAL HAPUS STARTS HERE-->
						<div class="modal fade" id="hapusModal-<?= $ss['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalHapusLabel">Yakin?</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Anda yakin akan menghapus slideshow ini?</p>
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
										<a class="btn btn-danger" href="<?= base_url() ?>user/hapus_slideshow/<?= $ss['id'] ?>">Hapus</a>
									</div>
								</div>
							</div>
						</div>
						<!-- MODAL HAPUS ENDS HERE -->

					<?php } ?>

				</tbody>
			</table>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->