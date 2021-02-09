

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <div class="col-lg-7">
          	 <?= $this->session->flashdata('message'); ?>
	          <form method="post" action="<?= base_url('user/ubah_password/').$user['id'] ?>">
				  <div class="form-group row">
				    <label for="name" class="col-sm-3 col-form-label">Nama</label>
				    <div class="col-sm-9">
				      <input type="text" readonly class="form-control-plaintext" id="name" name="name" value="<?= $user['name'] ?>">
				    </div>
				</div>
				<div class="form-group row">
				    <label for="password1" class="col-sm-3 col-form-label">Password baru</label>
				    <div class="col-sm-9">
				      <input type="password" class="form-control" id="password1" name="password1">
				      <small>Password minimal 6 karakter</small>
				      <br>
				      <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
				    </div>
				</div>
				<div class="form-group row">
				    <label for="password2" class="col-sm-3 col-form-label">Ulangi password baru</label>
				    <div class="col-sm-9">
				      <input type="password" class="form-control" id="password2" name="password2">
				      <?= form_error('password2', '<small class="text-danger">', '</small>') ?>
				    </div>
				</div>
				  <div class="row justify-content-end">
					  <button type="submit" class="btn btn-success"><span class="fa fa-fw fa-check"></span> Simpan</button>
				  </div>
				</form>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      