
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

          <!-- Basic Card Begin -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                	<div class="row">
                		<div class="ml-4 mx-2">
                			<a href="<?= base_url() ?>auth/registrasi" class="btn btn-primary px-3" class="btnTambahUser"><i class="fas fa-plus mr-2"></i><strong>Daftarkan User</strong></a>
                		</div>
 
                	</div>                  
                </div>

                <div class="card-body">
                	<?= $this->session->flashdata('message'); ?>
                	<div class="table-responsive">                		 
	                  <table class="table table-hover" id="tabel_submenu" width="100%" cellspacing="0">
						    <thead>
						        <tr>
						            <th>#</th>
						            <th>Nama</th>
						            <th>Role</th>
						            <th>Email</th>
						            <th>Aktif/Nonaktif</th>
						            <th>Dibuat</th>
						            <th>Aksi</th>
						        </tr>
						    </thead>
						    <tbody>
						    	<!-- ROW STARTS -->
						    	<?php
						    	$no =1;

						    	foreach ($userdata as $p) {
						    		// var_dump($p);

						    	?>

						        <tr>
						            <td><?= $no; $no++;?></td>
						        	<td><?= $p['name']?></td>
						        	<td><?= ucfirst($p['role'])?></td>
						        	<td><?= $p['email']?></td>
						        	<td>
						        		<!-- Rounded switch -->
										<form method="post" action="<?= base_url()?>superadmin/toggle_active_user/<?= $p['user_id']."/".$p['is_active']?>">
											<label class="switch">
											 	 <input type="checkbox" id="is_active" name="is_active" <?php echo ($p['is_active']) ? 'checked' : ''; ?> onChange="this.form.submit()">
											  <span class="slider round"></span>
											</label>
									  	</form>
						        	</td>
						        	<td><?= $p['date_created']?></td>
						        	<td>
						        		<a href="<?= base_url() ?>user/edit_profile/<?= $p['user_id']?>">Edit</a>
						        		|
						        		<a data-toggle="modal" data-target="#hapusModal-<?= $p['user_id']?>" href="#">Hapus</a>
						        	</td>				        

								</tr>

						        <!-- MODAL HAPUS STARTS HERE-->
								  <div class="modal fade" id="hapusModal-<?= $p['user_id']?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
								    <div class="modal-dialog" role="document">
								      <div class="modal-content">
								        <div class="modal-header">
								          <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus user?</h5>
								          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
								            <span aria-hidden="true">×</span>
								          </button>
								        </div>
								        <div class="modal-body">Anda akan menghapus user <strong><?= $p['name'] ?></strong></div>
								        <div class="modal-footer">
								          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
								          <a class="btn btn-danger" href="<?= base_url()?>superadmin/hapus_user/<?= $p['user_id']?>">Hapus</a>
								        </div>
								      </div>
								    </div>
								  </div>
								  <!-- MODAL HAPUS ENDS HERE -->
						        <?php 
						    	} //end foreach
						    	?>
						        <!-- ROW ENDS -->
						    </tbody>
						</table>
					</div>

					

                </div>
              </div>
          <!-- Basic Card Ends -->

         
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->