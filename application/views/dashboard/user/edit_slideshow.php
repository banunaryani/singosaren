<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

	<div class="card mt-3">
		<div class="card-body slideshow">
			<div class="row ml-1 mb-5 slideshowForm">

				<!-- kolom span -->
				<div class="col-1 mt-2 mx-2">
					<span class="fas fa-fw fa-lg fa-image"></span>
				</div>

				<!-- kolom form -->
				<div class="col mt-2 mx-2">

					<form method="post" action="<?= base_url('user/edit_slideshow/' . $slideshow['id']) ?>" enctype="multipart/form-data">

						<!-- Upload Logo -->
						<label for="gambar" class="mb-0"><strong>Gambar</strong></label>

						<div class="row my-3">
							<div class="col">
								<img height="300" class="img-fluid" src="<?= base_url('assets/img/slideshow/') . $slideshow['gambar'] ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-8 col-lg-6">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="gambar" id="gambar" aria-describedby="gambar">
										<label class="custom-file-label gambar-label" for="gambar">Pilih gambar</label>
									</div>
								</div>
								<small>Ukuran file disarankan 1700x800</small>
							</div>
						</div>

						<div class="form-group">
							<label for="judul"><strong>Judul</strong></label>
							<input type="text" class="form-control" name="judul" id="judul" value="<?= $slideshow['judul'] ?>" <?= ($slideshow['urutan'] == 1) ? "readonly" : "" ?>>
							<?php
							if ($slideshow['urutan'] == 1) {
							?>
								<small>Anda bisa mengubah kolom ini di menu <a href="<?= base_url('user') ?>">Pengaturan Umum</a></small>
							<?php
							}
							?>
						</div>
						<div class="form-group">
							<label for="keterangan"><strong>Keterangan</strong></label>
							<textarea class="form-control" id="keterangan" name="keterangan" rows="3" <?= ($slideshow['urutan'] == 1) ? "readonly" : "" ?>><?= $slideshow['keterangan'] ?></textarea>
							<?php
							if ($slideshow['urutan'] == 1) {
							?>
								<small>Anda bisa mengubah kolom ini di menu <a href="<?= base_url('user') ?>">Pengaturan Umum</a></small>
							<?php
							}
							?>
						</div>

						<!-- Tambah Tombol -->
						<div class="card">
							<div class="card-header">
								<p class="mb-0"><span class="fas fa-fw fa-sm fa-plus-square"></span> <strong>Tombol (opsional)</strong></p>
							</div>
							<div class="card-body">
								<small>Hanya tersedia 2 tombol yang dapat digunakan. Anda dapat menggunakan satu saja atau keduanya sekaligus atau tidak menggunakannya sama sekali.</small>

								<table class="table table-borderless">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Nama tombol</th>
											<th scope="col">Link</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">1-kiri</th>
											<td>
												<input type="text" class="form-control" id="namaBtn1" name="namaBtn1" value="<?= $slideshow['nama_btn1'] ?>">
											</td>
											<td>
												<input type="text" class="form-control" id="linkBtn1" name="linkBtn1" value="<?= $slideshow['link_btn1'] ?>">
											</td>
										</tr>
										<tr>
											<th scope="row">2-kanan</th>
											<td>
												<input type="text" class="form-control" id="namaBtn2" name="namaBtn2" value="<?= $slideshow['nama_btn2'] ?>">
											</td>
											<td>
												<input type="text" class="form-control" id="linkBtn2" name="linkBtn2" value="<?= $slideshow['link_btn2'] ?>">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- end tambah tombol -->

						<div class="row">
							<div class="form-group">
								<div class="col-auto">
									<label for="urutan" class="col-form-label">Urutan</label>
								</div>
								<div class="col-auto">
									<select class="form-control" name="urutan" id="urutan">
										<?php
										$a = ($slideshow['urutan'] == 1) ? 1 : 2;
										for ($i = $a; $i <= $jml_slideshow; $i++) {
										?>
											<option value="<?= $i ?>" <?= ($i == $slideshow['urutan']) ? "selected" : "" ?>><?= $i ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>


						<hr>

				</div>
				<!-- end kolom form -->


				<!-- kolom aksi -->
				<div class="col-auto mt-2 mx-2">
					<div class="row mb-2">
						<button type="button" data-toggle="modal" data-target="#hapusModal-<?= $slideshow['id'] ?>" class="btn btn-sm btn-danger"><span class="fas fa-fw fa-sm fa-trash"></span>
							<p class="d-sm-none">Hapus</p>
						</button>
					</div>
					<div class="row mb-2">
						<input type="hidden" id="arsipkan" name="arsipkan" value="<?= $slideshow['arsipkan'] ?>">
						<a href="<?= base_url('user/toggle_arsipkan_slideshow/') . $slideshow['id'] . "/" . $slideshow['arsipkan'] ?>" class="btn btn-sm btn-warning" id="btnArsipkan" name="btnArsipkan"><span class="fas fa-fw fa-sm fa-folder-open"></span>
							<p class="d-sm-none">Arsipkan</p>
						</a>
					</div>
				</div>
				<!-- end kolom aksi -->

			</div>
			<!-- end row -->

			<!-- MODAL HAPUS STARTS HERE-->
			<div class="modal fade" id="hapusModal-<?= $slideshow['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalHapusLabel">Yakin menghapus slideshow ini?</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							<a class="btn btn-danger" href="<?= base_url() ?>user/hapus_slideshow/<?= $slideshow['id'] ?>">Hapus</a>
						</div>
					</div>
				</div>
			</div>
			<!-- MODAL HAPUS ENDS HERE -->

		</div>
		<!-- end card body -->

	</div>
	<!-- end card -->

	<div class="row my-4">
		<div class="col d-flex justify-content-end">
			<a href="<?= base_url('user/slideshow') ?>" type="button" class="btn btn-secondary mx-1"><span class="fas fa-fw fa-times"></span> Batal</a>
			<button type="submit" class="btn btn-success mx-1" name="btnSimpanSlideshow" value="simpan"><span class="fas fa-fw fa-check"></span> Simpan</button>
		</div>
	</div>

	</form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript">
	$(document).ready(function() {

		$('#gambar').on('change', function() {
			//get the file name
			var fileName = $(this).val();
			//replace the "Choose a file" label
			$(this).next('.gambar-label').html(fileName);
		});

		$('#btnArsipkan').on('click', function() {
			if ($('#arsipkan').val() == 1) {
				$('#btnArsipkan').attr('class', 'btn btn-sm btn-secondary');
				$('#btnArsipkan span').attr('class', 'fas fa-fw fa-sm fa-check');
				$('#btnArsipkan').html('Diarsipkan');
			} else {
				$('#btnArsipkan').attr('class', 'btn btn-sm btn-warning');
				$('#btnArsipkan span').attr('class', 'fas fa-fw fa-sm fa-folder-open');
				$('#btnArsipkan').html('Arsipkan');
			}
		});

	});
</script>