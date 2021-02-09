

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <div class="col-lg-5">
          	 <?= $this->session->flashdata('message'); ?>
	          <form method="post" action="<?= base_url('user/edit_profile/').$user['id'] ?>">
				  <div class="form-group row">
				    <label for="email" class="col-sm-3 col-form-label">Email</label>
				    <div class="col-sm-9">
				      <input type="email" readonly class="form-control-plaintext" id="email" value="<?= $user['email'] ?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="email" class="col-sm-3 col-form-label">Role</label>
				    <div class="col-sm-9">
				      <input type="email" readonly class="form-control-plaintext" id="email" value="<?= ucfirst($user['role']) ?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="name" class="col-sm-3 col-form-label">Nama</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="name" class="col-sm-3 col-form-label">Password</label>
				    <div class="col-sm-9">
				    	<a href="<?= base_url('user/ubah_password/').$user['id'] ?>" class="btn btn-sm btn-primary"><span class="fa fa-sm fa-fw fa-pen"></span> Ubah Password</a>
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

      