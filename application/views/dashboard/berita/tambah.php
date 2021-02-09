

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

      <?= $this->session->flashdata('message'); ?>

      <div class="col-md-8">

      	<form method="post" action="<?= base_url('admin/berita/tambah')?>" enctype="multipart/form-data">
      		
          <div class="form-group mb-3">
      			<label for="judul"><strong>Judul</strong> *</label>
      			<input type="text" class="form-control" name="judul" id="judul">
            <br>
      			<?= form_error('judul', '<small class="text-danger pl-3">', '</small>') ?>
      		</div>

          <label><strong>Pilih Gambar Cover</strong></label>
          <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="gambar" id="gambar" aria-describedby="gambar">
              <label class="custom-file-label gambar-label" for="gambar">Pilih gambar</label>
            </div>
          </div>

          <div class="form-group">
            <label for="kategori_id"><strong>Kategori</strong></label>
            <select class="form-control" name="kategori_id" id="kategori_id">
              <?php
              foreach ($kategori as $k) {
              ?>
              <option value="<?= $k['id'] ?>"><?= $k['kategori'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>

      		<div class="form-group mb-3">
            <label for="konten"><strong>Konten *</strong></label>
      			<textarea name="konten" id="konten">
      			</textarea>
      			<?= form_error('konten', '<small class="text-danger pl-3">', '</small>') ?>
      		</div>

      		<div class="row justify-content-end mt-3 mr-1">
      			<div class="form-group">
      				<a href="<?= base_url('admin/berita') ?>" type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-fw fa-times"></span> Batal</a>
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
  		});

      $('#gambar').on('change',function(){
        //get the file name
        var fileName = $(this).val().replace("C:\\fakepath\\", "");
        //replace the "Choose a file" label
        $(this).next('.gambar-label').html(fileName);
      });
  	});
  </script>