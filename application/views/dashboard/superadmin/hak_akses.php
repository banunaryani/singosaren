
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

          <!-- Basic Card Begin -->
              <div class="card shadow mb-4">
               

                <div class="card-body">
                	<?= $this->session->flashdata('message'); ?>
                	<div class="table-responsive">                		 
	                  <table class="table table-hover" id="tabel_menu" width="100%" cellspacing="0">
						    <thead>
						        <tr>
						            <th>#</th>
						            <th>Role</th>
						            <th>Hak Akses</th>
						            <th>Aksi</th>
						        </tr>
						    </thead>
						    <tbody>
						    	<!-- ROW STARTS -->
						    	<?php
						    	$no =1;
						    	foreach ($role as $p) {
						    	?>

						        <tr>
						            <td><?= $no; $no++;?></td>
						        	<td><?= ucfirst($p['role']) ?></td>
						        	<td>
						        		<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editAksesModal-<?= $p['id']?>" value=""><span class="fas fa-sm fa-fw fa-lock"></span> Hak Akses</button>
						        	</td>
						        	<td>
						        		<a href="#" data-toggle="modal" data-target="#editModal-<?= $p['id']?>">Edit</a>
						        		|
						        		<a data-toggle="modal" data-target="#hapusModal-<?= $p['id']?>" href="#">Hapus</a>
						        	</td>

								</tr>


					          <!-- MODAL HAPUS STARTS HERE-->
							  <div class="modal fade" id="hapusModal-<?= $p['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
							    <div class="modal-dialog" role="document">
							      <div class="modal-content">
							        <div class="modal-header">
							          <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus role?</h5>
							          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							            <span aria-hidden="true">×</span>
							          </button>
							        </div>
							        <div class="modal-body">Anda akan menghapus role <strong><?= $p['role'] ?></strong></div>
							        <div class="modal-footer">
							          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							          <a class="btn btn-danger" href="<?= base_url()?>superadmin/hapus_role/<?= $p['id']?>">Hapus</a>
							        </div>
							      </div>
							    </div>
							  </div>
							  <!-- MODAL HAPUS ENDS HERE -->

							  <!-- MODAL EDIT STARTS HERE-->
							  <div class="modal fade" id="editModal-<?= $p['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
							    <div class="modal-dialog" role="document">
							      <div class="modal-content">
							        <div class="modal-header">
							          <h5 class="modal-title" id="modalEditLabel">Edit role</h5>
							          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							            <span aria-hidden="true">×</span>
							          </button>
							        </div>
						        	<form method="post" action="<?= base_url('superadmin/edit_role/').$p['id']?>">
								        <div class="modal-body">
								        	<input type="hidden" name="role_id" id="role_id" value="<?= $p['id']?>">
								        	<div class="form-group">
											    <label class="small" for="role">Nama role</label>
											    <input type="text" class="form-control" name="role" id="role" value="<?= $p['role']?>">
											</div>
								        </div>
								        <div class="modal-footer">
								          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
								          <button type="submit" class="btn btn-success">Edit</button>
								        </div>
							        </form>
							      </div> <!-- /.modal-content -->
							    </div> <!-- /.modal-dialog -->
							  </div> <!-- /.modal -->
							  <!-- MODAL EDIT ENDS HERE -->

							  <!-- MODAL AKSES STARTS HERE-->
							  <div class="modal fade" id="editAksesModal-<?= $p['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalAksesLabel" aria-hidden="true">
							    <div class="modal-dialog" role="document">
							      <div class="modal-content">

							        <div class="modal-header">
							          <h5 class="modal-title" id="modalAksesLabel">Hak Akses - <?= ucfirst($p['role']) ?></h5>
							          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							            <span aria-hidden="true">×</span>
							          </button> 
							        </div>

							        <div class="modal-body pl-4">
							        	<form method="post" action="<?= base_url('superadmin/hak_akses') ?>">
								        	<?php

										      foreach ($menu as $m) {

										      ?>

								        		<div class="form-check">
								        		  <input type="hidden" name="menu_unchecked[]" value="<?= $p['id']."-".$m['menu_id'] ?>">
												  <input class="form-check-input" type="checkbox" id="menu[]" name="menu[]" value="<?= $p['id']."-".$m['menu_id'] ?>"
												  <?php
												  foreach ($akses as $a) {

												  	echo($a['role_id'] == $p['id'] && $a['menu_id'] == $m['menu_id'] ? 'checked' : '');
												   }
												   ?> >
												  <label class="form-check-label"><?= $m['menu'] ?></label>
												</div>

										      <?php
										      
										  	} //foreach menu m
										    ?>

							        </div>
							        <div class="modal-footer">
							          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							          <button type="submit" class="btn btn-success" name="submit_btn" value="simpan">Simpan</button>
							        </form>
							        </div>
							      </div>
							    </div>
							  </div>
							  <!-- MODAL AKSES ENDS HERE -->

					        <?php
					    		} //end foreach role
					    	?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

	


          <!-- Basic Card Ends -->


          <!-- MODAL TAMBAH STARTS HERE-->
		  <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahModalLabel">Tambah role baru</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form method="post" action="<?= base_url()?>admin/kelola_role">
			        	<input type="hidden" name="role_id" id="role_id">
			        	<div class="form-group">
						    <label class="small" for="role">Nama role</label>
						    <input type="text" class="form-control" name="role" id="role">
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