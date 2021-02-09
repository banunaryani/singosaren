

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <!-- =====DESKRIPSI===== -->

      <div class="row ml-1">
        <div class="col-6">

          <form method="post" action="<?= base_url('user') ?>" enctype="multipart/form-data">

          <!-- Upload Favicon -->
          <label for="inputFavicon" class="mb-0 mt-3"><strong>Favicon</strong></label>
          <br>
          <small class="mb-3">Favicon adalah ikon kecil pada tab browser di samping judul halaman web.</small>
          <div class="row mt-3 mb-4">
            <div class="col-1">
              <img width="30" src="<?= base_url('assets/img/').$deskripsi['favicon'] ?>">
            </div>
            <div class="col">
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="inputFavicon" id="inputFavicon" aria-describedby="inputFavicon">
                  <label class="custom-file-label favicon-label" for="inputFavicon">Pilih file .ICO</label>
                </div>
              </div>
              <small>Ukuran file max 2 MB</small>
            </div>
          </div>
          
          <!-- Upload Logo -->
          <label for="inputLogo" class="mb-0"><strong>Logo</strong></label>
          <br>
          <small class="mb-3">Logo ditampilkan pada halaman di pojok kiri atas</small>
          <div class="row mb-4 mt-3">
            <div class="col-auto">
              <img height="70" src="<?= base_url('assets/img/').$deskripsi['logo'] ?>">
            </div>
            <div class="col">
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="inputLogo" id="inputLogo" aria-describedby="inputLogo">
                  <label class="custom-file-label logo-label" for="inputLogo">Pilih file .PNG</label>
                </div>
              </div>
              <small>Ukuran file max 2 MB</small>
            </div>
          </div>


          <div class="form-group">
            <label for="inputDesa">Nama Desa</label>
            <input type="text" class="form-control form-control-lg" name="inputDesa" id="inputDesa" placeholder="Desa" value="<?= $deskripsi['desa'] ?>">
          </div>

          <div class="form-row">
            <div class="col">
              <label for="inputKab">Kabupaten/Kota</label>
              <input type="text" class="form-control" name="inputKab" placeholder="Kab/Kota" value="<?= $deskripsi['kabkota'] ?>">
            </div>
            <div class="col">
              <label for="inputProv">Provinsi</label>
              <input type="text" class="form-control" name="inputProv" placeholder="Provinsi" value="<?= $deskripsi['provinsi'] ?>">
            </div>
          </div>


          <div class="row justify-content-end my-3 mr-1">
            <button type="submit" class="btn btn-success"><span class="fas fa-fw fa-check"></span> Simpan</button>
          </div>

          </form>

        </div>



  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript">

  $(document).ready(function(){

    $('#inputLogo').on('change',function(){
      //get the file name
      var fileName = $(this).val().replace("C:\\fakepath\\", "");
      //replace the "Choose a file" label
      $(this).next('.logo-label').html(fileName);
    });

    $('#inputFavicon').on('change',function(){
      //get the file name
      var fileName = $(this).val().replace("C:\\fakepath\\", "");
      //replace the "Choose a file" label
      $(this).next('.favicon-label').html(fileName);
    });

    $(".addBtn").click(function() {
      $(".card-body.slideshow > .slideshowForm:first-child").clone(true).find("input").val("").end().appendTo(".card-body.slideshow");
    });

    $(".remove").click(function() {
        $(this).parents("div.slideshowForm").remove();
    });
  });
</script>
