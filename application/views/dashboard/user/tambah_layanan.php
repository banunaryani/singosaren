

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

      <?= $this->session->flashdata('message'); ?>

      <div class="col-md-8">
      	<form method="post" action="<?= base_url('admin/layanan/tambah_layanan')?>" enctype="multipart/form-data">
      		<div class="form-group">
      			<label for="judul"><strong>Judul layanan</strong></label>
      			<input type="text" class="form-control" name="judul" id="judul">
      			<small><strong>contoh: </strong>Membuat KTP, Menerbitkan KK, dsb.</small>
            <br>
      			<?= form_error('judul', '<small class="text-danger pl-3">', '</small>') ?>
      		</div>
      		<div class="form-group">
      			<label for="kategori"><strong>Kategori layanan</strong></label>
      			<select id="kategori" name="kategori" class="form-control">
      				<?php foreach ($kategori as $k) {
      				?>
      					<option value="<?= $k['id'] ?>"><?= $k['kategori'] ?></option>			    		
  					<?php
      				} ?>
      			</select>
      			<?= form_error('kategori', '<small class="text-danger pl-3">', '</small>') ?>
      		</div>
      		<div class="form-group mt-2">
      			<label for="konten"><strong>Konten</strong></label>
      			<br>
      			<small>Konten dapat berisi dokumen persyaratan yang dibutuhkan, mekanisme pelayanan, waktu pelayanan, dsb</small>
      			<textarea name="konten" id="konten">
      			</textarea>
      			<?= form_error('konten', '<small class="text-danger pl-3">', '</small>') ?>
      		</div>
          <label><strong>Lampirkan Dokumen/File</strong></label>
          <div class="input-group lampiran mb-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="lampiran" id="lampiran" aria-describedby="lampiran">
              <label class="custom-file-label lampiran-label" for="lampiran">Pilih file</label>
            </div>
          </div>

      		<div class="form-check">
      			<input class="form-check-input" type="checkbox" value="1" id="arsipkan" name="arsipkan" value="1">
      			<label class="form-check-label" for="arsipkan">Arsipkan</label>
      			<br>
      			<small>Jika diarsipkan maka layanan ini tidak akan ditampilkan kepada pengunjung website</small>
      		</div>

      		<div class="row justify-content-end mt-3 mr-1">
      			<div class="form-group">
      				<a href="<?= base_url('admin/layanan') ?>" type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-fw fa-times"></span> Batal</a>
      				<button type="submit" class="btn btn-success ml-2"><span class="fas fa-fw fa-check"></span> Simpan</button>
      			</div>
      		</div>

      	</div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <script type="text/javascript">
  	$(function() {

  		//CK EDITOR
         
  		ClassicEditor
  		.create( document.querySelector( '#konten' ) )
  		.then( editor => {
  			console.log( editor );
  		} )
  		.catch( error => {
  			console.error( error );
  		} );


      $('#lampiran').on('change',function(){
        //get the file name
        var fileName = $(this).val().replace("C:\\fakepath\\", "");
        //replace the "Choose a file" label
        $(this).next('.lampiran-label').html(fileName);
      });
  	});
  </script>