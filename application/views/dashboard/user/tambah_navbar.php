<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

	<div class="card col-7 mb-3">
		<div class="card-body">
			<p class="mb-2"><small>* wajib diisi</small></p>

			<form method="post" action="<?= base_url() ?>admin/navbar/tambah" id="form_tambah_navbar">

				<input type="hidden" name="id" id="id">
				<div class="form-group">
					<label class="small" for="navbar_menu">Nama menu *</label>
					<input type="text" class="form-control" name="navbar_menu" id="navbar_menu">
					<?= form_error('navbar_menu', '<small class="text-danger pl-3">', '</small>') ?>
				</div>
				<div class="form-group">
					<label class="small" for="link_menu">Link tujuan *</label>
					<div class="form-row">
						<div class="col">
							<label class="sr-only" for="host">Host</label>
							<input type="text" class="form-control-plaintext" id="host" name="host" value="<?= base_url() ?>">
						</div>
						<div class="col-4">
							<label class="sr-only" for="link_menu">Path</label>
							<div class="input-group">
								<input type="text" class="form-control" id="link_menu" name="link_menu">
							</div>
						</div>
					</div>
					<?= form_error('link_menu', '<small class="text-danger pl-3">', '</small>') ?>
				</div>
				<button class="btn btn-sm btn-primary mb-3" type="button" data-toggle="collapse" data-target="#tambah_submenu" aria-expanded="false" aria-controls="tambah_submenu">
					<span class="fas fa-fw fa-sm fa-plus-square"></span>
					Tambah submenu (opsional)
				</button>
				<div class="collapse" id="tambah_submenu">
					<div class="card">
						<div class="card-header">
							<p class="mb-0"><strong>Submenu</strong></p>
						</div>
						<div class="card-body">

							<ul class="submenu_navbar">
								<li>
									<!-- SUBMENU -->
									<div class="row input_submenu_navbar">

										<div class="col">
											<div class="form-group">
												<label for="nama_submenu[]">Submenu</label>
												<input type="text" class="form-control" name="nama_submenu[]" id="nama_submenu[]" placeholder="Submenu">
											</div>
											<div class="form-group">
												<label for="link[]">Link</label>
												<input type="url" class="form-control" name="link_submenu[]" id="link_submenu[]" placeholder="http://contoh.com">
											</div>
											<hr>
										</div>

										<div class="col-1">
											<i class="btn btn-danger btn-sm remove"><span class="fas fa-fw fa-times"></span></i>
										</div>


									</div>
									<!-- SUBMENU ENDS -->
								</li>
							</ul>

							<div class="row">
								<div class="col d-flex justify-content-end">
									<button type="button" class="btn btn-sm btn-primary btn_tambah_submenu"><span class="fas fa-fw fa-plus"></span></button>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="small" for="urutan">Urutan *</label>
					<select class="form-control" name="urutan" id="urutan">
						<?php
						for ($i = 1; $i <= $jml + 1; $i++) {
						?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php
						}
						?>
					</select>
					<?= form_error('urutan', '<small class="text-danger pl-3">', '</small>') ?>
				</div>

				<br>

				<div class="d-flex justify-content-end">
					<a type="button" href="<?= base_url('admin/navbar') ?>" class="btn btn-secondary card-link"><span class="fas fa-fw fa-times"></span>Batal</a>
					<button type="submit" class="btn btn-success card-link"><span class="fas fa-fw fa-check"></span> Simpan</button>
				</div>

			</form>

		</div>
		<!-- end card body -->
	</div>
	<!-- end card -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript">
	$(function() {
		var str = '<li><div class="row input_submenu_navbar"><div class="col"><div class="form-group"><label for="nama_submenu[]">Submenu</label><input type="text" class="form-control" name="nama_submenu[]" id="nama_submenu[]" placeholder="Submenu"></div><div class="form-group"><label for="link[]">Link</label><input type="url" class="form-control" name="link_submenu[]" id="link_submenu[]" placeholder="http://contoh.com"></div><hr></div><div class="col-1"><i class="btn btn-danger btn-sm remove"><span class="fas fa-fw fa-times"></span></i></div></div></li>';

		// DYNAMIC INPUT SUBMENU NAVBAR
		$(".btn_tambah_submenu").on('click', function() {
			$(".submenu_navbar").append(str);
			// $(".submenu_navbar > :first-child").clone(true).find("input").val("").end().appendTo(".submenu_navbar");
		});


		$(".submenu_navbar").on('click', '.remove', function(n) {

			n.currentTarget.closest('li').remove();

		});




	})
</script>