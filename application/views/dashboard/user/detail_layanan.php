

    <!-- Begin Page Content -->
    <div class="container-fluid">

		<div class="card">
   				<div class="card-header d-flex bd-highlight">
   					<a href="<?= base_url('admin/layanan') ?>" class="btn btn-sm btn-light mr-auto px-2 bd-highlight"><span class="fas fa-fw fa-sm fa-arrow-left"></span><small> Kembali</small></a>
            <?php
              if ($layanan['tampil_beranda'] == 0) {              
              ?>
              <a href="<?= base_url('admin/layanan/tampilkan_depan/').$layanan['layanan_id'].'/1' ?>" type="button" name="arsipkan" class="btn btn-sm btn-info mr-2"><span class="fas fa-sm fa-fw fa-desktop mr-2"></span> Tampilkan di beranda</a>
              <?php
              } else {
              ?>
              <a href="<?= base_url('admin/layanan/tampilkan_depan/').$layanan['layanan_id'].'/0' ?>" type="button" name="arsipkan" class="btn btn-sm btn-dark mr-2"><span class="fas fa-sm fa-fw fa-check mr-2"></span> Ditampilkan di beranda</a>
              <?php
              }
              ?>

   					<?php
   					if ($layanan['arsipkan'] == 0) {              
   						?>
   						<a href="<?= base_url('admin/layanan/arsipkan_layanan/').$layanan['layanan_id'].'/1' ?>" type="button" name="arsipkan" class="btn btn-sm btn-info card-link px-2 bd-highlight"><span class="fas fa-sm fa-fw fa-archive"></span> Arsipkan</a>
   						<?php
   					} else {
   						?>
   						<a href="<?= base_url('admin/layanan/arsipkan_layanan/').$layanan['layanan_id'].'/0' ?>" type="button" name="arsipkan" class="btn btn-sm btn-dark card-link px-2 bd-highlight"><span class="fas fa-sm fa-fw fa-check"></span> Diarsipkan</a>
   						<?php
   					}
   					?>
   					<a href="<?= base_url('admin/layanan/edit_layanan/').$layanan['layanan_id'] ?>" class="btn btn-sm btn-warning card-link px-2 bd-highlight"><span class="fas fa-fw fa-pen mr-1"></span>Edit</a>
	                <a href="#" data-toggle="modal" data-target="#hapusModal-<?= $layanan['layanan_id']?>" class="btn btn-sm btn-danger card-link px-2 bd-highlight"><span class="fas fa-fw fa-trash mr-1"></span>Hapus</a>
   				</div>
   				<div class="card-body px-5 py-5">
            <div class="row">
              <div class="col">
                <span class="badge badge-dark mb-3"><?= $layanan['kategori'] ?></span>
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><strong><?= $title ?></strong></h1>
                <div class="my-3">
                 <?= $layanan['konten'] ?>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <?php if ($layanan['file']) {
                ?>
                <a href="<?= base_url('assets/file/').$layanan['file'] ?>" class="btn btn-sm btn-info"><span class="fas fa-fw fa-download mr-2"></span>Download Lampiran</a>
                <?php
                } ?>
              </div>
            </div>
   		   </div>
   	</div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  