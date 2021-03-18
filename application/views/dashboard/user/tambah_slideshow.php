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

					<form method="post" action="<?= base_url('user/tambah_slideshow') ?>" enctype="multipart/form-data">

						<!-- Upload Logo -->
						<label for="gambar" class="mb-0"><strong>Gambar</strong> *</label>

						<div class="row">
							<div class="col">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="gambar" id="gambar" aria-describedby="gambar">
										<label class="custom-file-label logo-label" for="gambar">Pilih gambar</label>
									</div>
								</div>
								<small>Ukuran file disarankan 1700x800</small>
							</div>
						</div>

						<div class="form-group">
							<label for="judul"><strong>Judul</strong> *</label>
							<input type="text" class="form-control" name="judul" id="judul" placeholder="Judul">
						</div>
						<div class="form-group">
							<label for="keterangan"><strong>Keterangan</strong></label>
							<textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
						</div>

						<!-- Tambah Tombol -->
						<div class="card">
							<div class="card-header">
								<p class="mb-0"><span class="fas fa-fw fa-sm fa-plus-square"></span> <strong>Submenu</strong> (opsional)</p>
							</div>
							<div class="card-body">

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
												<input type="text" class="form-control" id="namaBtn1" name="namaBtn1" placeholder="cth: lokasi, kontak, dll">
											</td>
											<td>
												<input type="text" class="form-control" id="linkBtn1" name="linkBtn1" placeholder="http://www.contoh.com/halaman">
											</td>
										</tr>
										<tr>
											<th scope="row">2-kanan</th>
											<td>
												<input type="text" class="form-control" id="namaBtn2" name="namaBtn2" placeholder="cth: lokasi, kontak, dll">
											</td>
											<td>
												<input type="text" class="form-control" id="linkBtn2" name="linkBtn2" placeholder="http://www.contoh.com/halaman">
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
										for ($i = 2; $i <= $jml_slideshow + 1; $i++) {
										?>
											<option value="<?= $i ?>"><?= $i ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-auto">
									<p>dari <?= $jml_slideshow ?> slideshow</p>
								</div>
							</div>
						</div>


						<hr>

				</div>
				<!-- end kolom form -->

			</div>
			<!-- end row -->

		</div>
		<!-- end card body -->
		<!-- 
                    <div class="row">
                         <div class="col-1"></div>
                         <div class="col mb-5 ml-5">
                           <button type="button" class="btn btn-primary addBtn" name="addBtn" id="addBtn"><span class="fas fa-fw fa-plus"></span>Tambah</button>
                         </div>
                         <div class="col-2"></div>
                    </div> -->
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
			$(this).next('.logo-label').html(fileName);
		});

		$(".addBtn").click(function() {
			$(".card-body.slideshow > .slideshowForm:first-child").clone(true).find("input").val("").end().appendTo(".card-body.slideshow");
		});

		$(".remove").click(function() {
			$(this).parents("div.slideshowForm").remove();
		});
	});
</script>