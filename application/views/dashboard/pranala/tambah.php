<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

  <?= $this->session->flashdata('message'); ?>

  <div class="col-md-8">

    <form method="post" action="<?= base_url('admin/pranala/tambah') ?>" enctype="multipart/form-data">

      <label><strong>Pilih Gambar Logo</strong></label>
      <div class="input-group mb-3">
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="logo" id="logo" aria-describedby="logo">
          <label class="custom-file-label logo-label" for="logo">Pilih logo</label>
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="judul"><strong>Judul</strong> *</label>
        <input type="text" class="form-control" name="judul" id="judul">
        <br>
        <?= form_error('judul', '<small class="text-danger pl-3">', '</small>') ?>
      </div>

      <div class="form-group mb-3">
        <label for="alamat"><strong>Alamat</strong></label>
        <textarea class="form-control" name="alamat" id="alamat" rows="2"></textarea>
        <br>
        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
      </div>

      <div class="form-group mb-3">
        <label for="telp"><strong>Telp.</strong></label>
        <input type="tel" class="form-control" name="telp" id="telp" placeholder="contoh: 08123456xxx">
        <br>
        <?= form_error('telp', '<small class="text-danger pl-3">', '</small>') ?>
      </div>

      <div class="form-group mb-3">
        <label for="web"><strong>Website</strong></label>
        <input type="text" class="form-control" name="web" id="web" placeholder="http://www.contoh.com/">
        <br>
        <?= form_error('web', '<small class="text-danger pl-3">', '</small>') ?>
      </div>

      <label for="web"><strong>Sosial Media</strong></label>

      <div class="input-group mb-3">
        <!-- <label for="fb">Facebook</label> -->
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fab fa-facebook-f"></i>
          </div>
        </div>
        <input type="text" class="form-control" placeholder="http://facebook.com/contoh" name="fb" aria-describedby="fb">
        <?= form_error('fb', '<small class="text-danger pl-3">', '</small>') ?>
      </div>

      <div class="input-group mb-3">
        <!-- <label for="ig">Instagram</label> -->
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fab fa-instagram"></i>
          </div>
        </div>
        <input type="text" class="form-control" placeholder="http://instagram.com/contoh" name="ig" aria-describedby="ig">
        <?= form_error('ig', '<small class="text-danger pl-3">', '</small>') ?>
      </div>

      <div class="input-group mb-3">
        <!-- <label for="twitter">Twitter</label> -->
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fab fa-twitter"></i>
          </div>
        </div>
        <input type="text" class="form-control" placeholder="http://twitter.com/contoh" name="twitter" aria-describedby="twitter">
        <?= form_error('twitter', '<small class="text-danger pl-3">', '</small>') ?>
      </div>

      <div class="row justify-content-end mt-3 mr-1">
        <div class="form-group">
          <a href="<?= base_url('admin/pranala') ?>" type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-fw fa-times"></span> Batal</a>
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
      .create(document.querySelector('#konten'))
      .then(editor => {
        console.log(editor);
      })
      .catch(error => {
        console.error(error);
      });

    $('#logo').on('change', function() {
      //get the file name
      var fileName = $(this).val().replace("C:\\fakepath\\", "");
      //replace the "Choose a file" label
      $(this).next('.logo-label').html(fileName);
    });
  });
</script>