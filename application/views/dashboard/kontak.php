

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <!-- =====DESKRIPSI===== -->

    <div class="card">
      <div class="card-body">

        <div class="row ml-1">
          <div class="col-6 mx-2">

            <form method="post" action="<?= base_url('admin/kontak') ?>">

              <section>

                <div class="form-group">
                  <label for="telp">No Telp.</label>
                  <input type="tel" class="form-control" name="telp" id="telp" placeholder="0274xxxxxx" value="<?= $kontak['telp'] ?>">
                  <?= form_error('telp', '<small class="text-danger pl-3">', '</small>') ?>
                </div>

                <div class="form-group">
                  <label for="email">Alamat Email</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="contoh@mail.com" <?= $kontak['email'] ?>>
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>

                <div class="form-group">
                  <label for="telp">Alamat Kantor Desa</label>
                  <textarea class="form-control" name="alamat" id="alamat" rows="3"><?= $kontak['alamat'] ?></textarea>
                </div>
                
              </section>

            </div>

            <div class="col mx-2">

              <section>

                <h4>Sosial Media</h4>

                <div class="input-group mb-3">
                  <!-- <label for="fb">Facebook</label> -->
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fab fa-facebook-f"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="http://facebook.com/contoh" name="fb" aria-describedby="fb" value="<?= prep_url($kontak['facebook']) ?>">
                  <?= form_error('fb', '<small class="text-danger pl-3">', '</small>') ?>
                </div>

                <div class="input-group mb-3">
                  <!-- <label for="ig">Instagram</label> -->
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fab fa-instagram"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="http://instagram.com/contoh" name="ig" aria-describedby="ig" value="<?= prep_url($kontak['instagram']) ?>">
                  <?= form_error('ig', '<small class="text-danger pl-3">', '</small>') ?>
                </div>

                <div class="input-group mb-3">
                  <!-- <label for="twitter">Twitter</label> -->
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fab fa-twitter"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="http://twitter.com/contoh" name="twitter" aria-describedby="twitter" value="<?= prep_url($kontak['twitter']) ?>">
                  <?= form_error('twitter', '<small class="text-danger pl-3">', '</small>') ?>
                </div>


                <div class="row justify-content-end my-3 mr-1">
                  <button type="submit" class="btn btn-success"><span class="fas fa-fw fa-check"></span> Simpan</button>
                </div>

              </section>

            </div>

          </div>
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
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).next('.logo-label').html(fileName);
    });

    $(".addBtn").click(function() {
      $(".card-body.slideshow > .slideshowForm:first-child").clone(true).find("input").val("").end().appendTo(".card-body.slideshow");
    });

    $(".remove").click(function() {
        $(this).parents("div.slideshowForm").remove();
    });
  });
</script>
