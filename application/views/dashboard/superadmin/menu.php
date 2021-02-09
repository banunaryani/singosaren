
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

	<!-- Basic Card Begin -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
        	<div class="row">
        		<div class="ml-4 mx-2">
        			<a href="#" class="btn btn-primary px-3" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus mr-2"></i><strong>Tambah Menu</strong></a>
        		</div>

        	</div>                  
        </div>

		<div class="card-body">
			<?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>
			<?= $this->session->flashdata('message'); ?>
			<div class="table-responsive">                		 
				<table class="table table-hover" id="tabel_menu" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Menu</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!-- ROW STARTS -->
						<?php
						$no =1;

						foreach ($menu as $p) {
						    		// var_dump($p);

							?>

							<tr>
								<td><?= $no; $no++;?></td>
								<td><?= $p['menu']?></td>
								<td>
									<a href="<?= base_url('superadmin/edit_menu/'.$p['menu_id']) ?>">Edit</a>
									|
									<a data-toggle="modal" data-target="#hapusModal-<?= $p['menu_id']?>" href="#">Hapus</a>
								</td>				        

							</tr>

							<!-- MODAL HAPUS STARTS HERE-->
							<div class="modal fade" id="hapusModal-<?= $p['menu_id']?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalHapusLabel">Yakin menghapus menu?</h5>
											<button class="close" type="button" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
										<div class="modal-body">Anda akan menghapus menu <strong><?= $p['menu'] ?></strong></div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
											<a class="btn btn-danger" href="<?= base_url()?>superadmin/hapus_menu/<?= $p['menu_id']?>">Hapus</a>
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

			<!-- MODAL TAMBAH STARTS HERE-->
			<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="tambahModalLabel">Tambah menu baru</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="post" action="<?= base_url()?>superadmin/menu">
							<div class="modal-body">
									<input type="hidden" name="menu_id" id="menu_id">
									<div class="form-group">
										<label class="small" for="menu">Nama menu</label>
										<input type="text" class="form-control" name="menu" id="menu">
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- MODAL TAMBAH ENDS HERE -->

		</div>
		<!-- /.container-fluid -->

	</div>
      <!-- End of Main Content -->

      <script type="text/javascript">

      	$(function() {
      		$('.btnTambah').on('click', function() {
      			$("#tambahModalLabel").html('Tambah Menu Baru');
      		});

      		$('.showEditModal').on('click', function() {
      			$("#tambahModalLabel").html('Edit Menu');
      			$('.modal-body form').attr('action', 'http://localhost/sipdk/admin/edit_menu')

      			const id = $(this).data('id');

      			$.ajax({
      				url: 'http://localhost/sipdk/admin/get_menu',
      				data: {id : id},
      				method: 'post',
      				dataType: 'json',
      				success: function(data) {
      					$('#menu_id').val(data.menu_id);
      					$('#menu').val(data.menu);
      				}
      			});
      		});
      	});

      </script>