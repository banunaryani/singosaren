

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <form method="post" action="<?= base_url('superadmin/edit_menu/'.$menu['menu_id']) ?>">
          	<div class="col-md-4">
	          	<input type="hidden" name="menu_id" id="menu_id" value="<?= $menu['menu_id'] ?>">
				<div class="form-group">
					<label class="small" for="menu">Nama menu</label>
					<input type="text" class="form-control" name="menu" id="menu" value="<?= $menu['menu'] ?>">
				</div>
				<div class="row mr-2 justify-content-end">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
          	</div>
          </form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      