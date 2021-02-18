<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

  <?= $this->session->flashdata('message'); ?>

  <div class="col-md-8">
    <p class="mb-2"><small>* wajib diisi</small></p>
    <form method="post" action="<?= base_url('admin/layanan/edit_layanan/') . $layanan['id'] ?>" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" value="<?= $layanan['id'] ?>">
      <input type="hidden" name="old_file" value="<?= $layanan['file'] ?>">
      <div class="form-group">
        <label for="judul"><strong>Judul layanan</strong> *</label>
        <input type="text" class="form-control" name="judul" id="judul" value="<?= $layanan['judul'] ?>">
        <small><strong>contoh: </strong>Membuat KTP, Menerbitkan KK, dsb.</small>
        <?= form_error('judul', '<small class="text-danger pl-3">', '</small>') ?>
      </div>
      <div class="form-group">
        <label for="kategori"><strong>Kategori layanan</strong> *</label>
        <select id="kategori" name="kategori" class="form-control">
          <?php foreach ($kategori as $k) {
          ?>
            <option <?= ($layanan['kategori_id'] == $k['id']) ? 'selected' : '' ?> value="<?= $k['id'] ?>"><?= $k['kategori'] ?></option>
          <?php
          } ?>
        </select>
        <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>') ?>
      </div>
      <div class="form-group mt-2">
        <label for="konten"><strong>Konten</strong> *</label>
        <br>
        <small>Konten dapat berisi dokumen persyaratan yang dibutuhkan, mekanisme pelayanan, waktu pelayanan, dsb</small>
        <textarea name="konten" id="konten"><?= $layanan['konten'] ?>
      			</textarea>
        <?= form_error('konten', '<small class="text-danger pl-3">', '</small>') ?>
      </div>

      <label><strong>Lampirkan Dokumen/File</strong> <small><i>(opsional)</i></small></label>
      <div class="input-group lampiran mb-3">
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="lampiran" id="lampiran" aria-describedby="lampiran">
          <label class="custom-file-label lampiran-label" for="lampiran">Pilih file</label>
        </div>
      </div>

      <!-- file yg ada -->
      <?php
      if ($layanan['file']) {
      ?>
        <div class="card mb-3 ">
          <div class="card-body d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
              <a href="<?= base_url('assets/files/') . $layanan['file'] ?>"><span class="fas fa-fw fa-download mr-2"></span> <?= $layanan['file'] ?></a>
            </div>
            <div class="p-2 bd-highlight">
              <a href="<?= base_url('admin/layanan/hapus_file/') . $layanan['id'] ?>" class="fas fa-fw fa-trash"></a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>

      <div class="form-group">
        <?php
        if ($layanan['arsipkan'] == 0) {
        ?>
          <a href="<?= base_url('admin/layanan/arsipkan_layanan/') . $layanan['id'] . '/1' ?>" type="button" name="arsipkan" class="btn btn-sm btn-info mr-2"><span class="fas fa-sm fa-fw fa-archive mr-2"></span> Arsipkan</a>
        <?php
        } else {
        ?>
          <a href="<?= base_url('admin/layanan/arsipkan_layanan/') . $layanan['id'] . '/0' ?>" type="button" name="arsipkan" class="btn btn-sm btn-dark mr-2"><span class="fas fa-sm fa-fw fa-check mr-2"></span> Diarsipkan</a>
        <?php
        }
        ?>

        <?php
        if ($layanan['tampil_beranda'] == 0) {
        ?>
          <a href="<?= base_url('admin/layanan/tampilkan_depan/') . $layanan['id'] . '/1' ?>" type="button" name="arsipkan" class="btn btn-sm btn-info mr-2"><span class="fas fa-sm fa-fw fa-desktop mr-2"></span> Tampilkan di beranda</a>
        <?php
        } else {
        ?>
          <a href="<?= base_url('admin/layanan/tampilkan_depan/') . $layanan['id'] . '/0' ?>" type="button" name="arsipkan" class="btn btn-sm btn-dark mr-2"><span class="fas fa-sm fa-fw fa-check mr-2"></span> Ditampilkan di beranda</a>
        <?php
        }
        ?>

      </div>

      <div class="row justify-content-end mt-5 mr-1">
        <div class="form-group">
          <a href="<?= base_url('admin/layanan') ?>" type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-fw fa-times"></span> Batal</a>
          <button type="submit" class="btn btn-success ml-2"><span class="fas fa-fw fa-check"></span> Simpan</button>
        </div>
      </div>

  </div>

  </form>

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


    $('#lampiran').on('change', function() {
      //get the file name
      var fileName = $(this).val().replace("C:\\fakepath\\", "");
      //replace the "Choose a file" label
      $(this).next('.lampiran-label').html(fileName);
    });
  });
</script>