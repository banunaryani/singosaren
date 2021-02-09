

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <div class="col-md-5">
          	<form method="post" action="<?= base_url('superadmin/edit_submenu/').$submenu['id']?>">
          		<input type="hidden" name="id" id="id">
          		<div class="form-group">
          			<label class="small" for="submenu">Nama submenu</label>
          			<input type="text" class="form-control" name="submenu" id="submenu" value="<?= $submenu['title'] ?>">
          		</div>
          		<div class="form-group">
          			<label class="small" for="menuutama">Menu Utama</label>
          			<select id="menuutama" name="menuutama" class="form-control">
          				<?php foreach ($menu as $m) {
          					?>
          					<option value="<?= $m['menu_id'] ?>" <?= ($m['menu_id'] == $submenu['menu_id'])? "selected":""?>><?= $m['menu'] ?></option>			    		
          					<?php
          				} ?>
          			</select>
          		</div>	
          		<div class="form-group">
          			<label class="small" for="menu">URL</label>
          			<div class="form-row">
          				<div class="col-auto py-2">
          					<p><?= base_url()?></p>
          				</div>
          				<div class="col">
          					<input type="text" class="form-control" name="url" id="url" value="<?= $submenu['url'] ?>">
          				</div>
          			</div>
          		</div>
          		<div class="form-group">
          			<label class="small" for="menu">Ikon</label>
          			<div class="row">
	          			<div class="col-auto pt-2">
	          				<i class="<?= $submenu['icon'] ?> fa-lg"></i>
	          			</div>
	          			<div class="col">
		          			<div class="form-row">
		      					<input type="text" class="form-control" name="ikon" id="ikon" value="<?= substr($submenu['icon'],13) ?>">
		          			</div>
	          			</div>
          			</div>
          		</div>
          		<div class="form-check">
          			<input class="form-check-input" type="checkbox" value="1" id="aktif" name="aktif" <?= ($submenu['is_active'])? "checked":""?> >
          			<label class="form-check-label" for="aktif">
          				Aktif?
          			</label>
          		</div>

          		<div class="row justify-content-end mt-3 mr-2">
	          		<div class="form-group">
		          		<a href="<?= base_url('superadmin/submenu') ?>" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
		          		<button type="submit" class="btn btn-success"><span class="fas fa-fw fa-check"></span>  Simpan</button>
	          		</div>
          		</div>

          	</div>
          </div>
      	</form>
          	
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      