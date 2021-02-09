
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

          <!-- Basic Card Begin -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                	<div class="row">
                		<div class="ml-4 mx-2">
		        			<a href="#" class="btn btn-primary px-3" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus mr-2"></i><strong>Tambah Submenu</strong></a>
		        		</div>
                	</div>                  
                </div>

                <div class="card-body">
                	<?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>
                	<?= $this->session->flashdata('message'); ?>
                	<?php
                	foreach ($menu as $m) {
                	?>
                	<h5><strong>Menu <?= $m['menu'] ?></strong></h5>
                	<div class="table-responsive mb-4">                		 
	                  <table class="table table-hover" id="tabel_submenu" width="100%" cellspacing="0">
						    <thead>
						        <tr>
						            <th>#</th>
						            <th>Judul</th>
						            <th>Menu Utama</th>
						            <th>URL</th>
						            <th>Ikon</th>
						            <th>Aktif</th>
						            <th>Aksi</th>
						        </tr>
						    </thead>
						    <tbody>
						    	<!-- ROW STARTS -->
						    	<?php
						    	$no =1;

						    	foreach ($submenu as $p) {
						    		
					    		if ($p['menu'] == $m['menu']) {

						    	?>

						        <tr>
						            <td><?= $no; $no++;?></td>
						        	<td><?= $p['title']?></td>
						        	<td><?= $p['menu']?></td>
						        	<td><?= $p['url']?></td>
						        	<td><span class="<?= $p['icon'] ?> mr-3"></span><?= $p['icon']?></td>
						        	<td>
						        		<!-- Rounded switch -->
										<form method="post" action="<?= base_url()?>superadmin/aktifkan_submenu/<?= $p['id']."/".$p['is_active']?>">
											<label class="switch">
											 	 <input type="checkbox" id="is_active" name="is_active" <?php echo ($p['is_active']) ? 'checked' : ''; ?> onChange="this.form.submit()">
											  <span class="slider round"></span>
											</label>
									  	</form>
						        	</td>
						        	<td>
						        		<a href="<?= base_url()?>superadmin/edit_submenu/<?= $p['id'] ?>">Edit</a>
						        		|
						        		<a data-toggle="modal" data-target="#hapusModal-<?= $p['id']?>" href="#">Hapus</a>
						        	</td>				        

								</tr>

							        <!-- MODAL HAPUS STARTS HERE-->
									  <div class="modal fade" id="hapusModal-<?= $p['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
									    <div class="modal-dialog" role="document">
									      <div class="modal-content">
									        <div class="modal-header">
									          <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus submenu?</h5>
									          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
									            <span aria-hidden="true">×</span>
									          </button>
									        </div>
									        <div class="modal-body">Anda akan menghapus submenu <strong><?= $p['title'] ?></strong></div>
									        <div class="modal-footer">
									          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
									          <a class="btn btn-danger" href="<?= base_url()?>superadmin/hapus_submenu/<?= $p['id']?>">Hapus</a>
									        </div>
									      </div>
									    </div>
									  </div>
									  <!-- MODAL HAPUS ENDS HERE -->
						        <?php 
						    		} //end if
						    	} //end foreach
						    	?>
						        <!-- ROW ENDS -->
						    </tbody>
						</table>
					</div>

                	<?php
                	}
                	?>

					

                </div>
              </div>
          <!-- Basic Card Ends -->

          <!-- MODAL TAMBAH STARTS HERE-->
		  <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahSubmenuModalLabel">Tambah submenu baru</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body px-4">
			        <form method="post" action="<?= base_url()?>superadmin/submenu">
			        	<input type="hidden" name="id" id="id">
			        	<div class="form-group">
						    <label class="small" for="submenu">Nama submenu</label>
						    <input type="text" class="form-control" name="submenu" id="submenu">
						</div>
						<div class="form-group">
							<label class="small" for="menuutama">Menu Utama</label>
					    	<select id="menuutama" name="menuutama" class="form-control">
					    		<?php foreach ($menu as $m) {
					    		?>
					        	<option value="<?= $m['menu_id'] ?>"><?= $m['menu'] ?></option>			    		
					    		<?php
					    		} ?>
					    	</select>
						</div>	
						<div class="form-group mb-0">
						    <label class="small" for="menu">URL</label>
							<div class="form-row">
							    <div class="col-auto py-2">
							      <p><?= base_url()?></p>
							    </div>
							    <div class="col">
								    <input type="text" class="form-control" name="url" id="url">
							    </div>
							</div>
						</div>
						<div class="form-group mb-0">
						    <label class="small" for="menu">Ikon</label>
							<div class="form-row">
							    <div class="col-auto py-2">
							      <p>fas fa-fw fa-</p>
							    </div>
							    <div class="col">
								    <input type="text" class="form-control" name="ikon" id="ikon">
							    </div>
							</div>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" value="1" id="aktif" name="aktif">
						  <label class="form-check-label" for="aktif">
						    Aktif?
						  </label>
						</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Simpan</button>
			      </div>
			    </div>
			    </form>
			  </div>
			</div>
		  <!-- MODAL TAMBAH ENDS HERE -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->