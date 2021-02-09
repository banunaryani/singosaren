

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <?= $this->session->flashdata('message'); ?>

          <div class="row">
          	<div class="col-2">
          		<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          			<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Sejarah</a>
          			<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Visi & Misi</a>
          			<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Struktur Organisasi</a>
          			<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Pedukuhan</a>
          		</div>
          	</div>
          	<div class="col">
          		<div class="tab-content" id="v-pills-tabContent">

          			<!-- SEJARAH -->
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                  <form method="post" action="<?= base_url('admin/profil/update/sejarah') ?>">
                    <?php //var_dump($profil);die; ?>
                    <div class="col mb-3">
                      <h4 class="mb-2">Sejarah</h4>
                      <textarea name="sejarah" id="sejarah">
                        <?= $profil['sejarah'] ?>
                      </textarea>
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-sm btn-success" name="simpan_sejarah" value="simpan"><span class="fas fa-fw fa-check"></span> Simpan</button>
                    </div>
                  </form>
                </div>
                <!-- SEJARAH ENDS -->

                <!-- VISI MISI -->
          			<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                  <form method="post" action="<?= base_url('admin/profil/update_visi_misi') ?>">
                    <div class="col mb-3">
                      <h4 class="mb-2">Visi</h4>
                      <textarea name="visi" id="visi"><?= $profil['visi'] ?></textarea>
                      <br>
                      <h4 class="mb-2">Misi</h4>
                      <textarea name="misi" id="misi"><?= $profil['misi'] ?></textarea>
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-sm btn-success" name="simpan_visimisi" value="simpan"><span class="fas fa-fw fa-check"></span> Simpan</button>
                    </div>
                  </form>
                </div>
                <!-- VISI MISI ENDS -->

                <!-- STRUKTUR ORGANISASI -->
          			<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                  <form method="post" action="<?= base_url('admin/profil/update_struktur') ?>" enctype="multipart/form-data">
                    <div class="col mb-3">
                      <h4>Struktur Organisasi</h4>
                      <p>Jika struktur organisasi berupa diagram, disarankan untuk upload gambar diagram pada kolom di bawah ini</p>
                      
                      <div class="mb-2">
                        <img src="<?= base_url('assets/img/profil_desa/').$profil['gambar_struktur'] ?>">
                      </div>

                      <input type="hidden" name="gambar_lama" value="<?= $profil['gambar_struktur'] ?>">

                      <label><strong>Pilih Gambar</strong></label>
                      <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="gambar" id="gambar" aria-describedby="gambar">
                          <label class="custom-file-label gambar-label" for="gambar">Pilih gambar</label>
                        </div>
                      </div>

                      <textarea name="struktur" id="struktur"><?= $profil['struktur'] ?></textarea>
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-sm btn-success" name="simpan_struktur" value="simpan"><span class="fas fa-fw fa-check"></span> Simpan</button>   
                    </div>
                  </form>
                </div>
                <!-- STRUKTUR ORGANISASI ENDS -->

                <!-- PEDUKUHAN -->
          			<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                  <form method="post" action="<?= base_url('admin/profil/update_pedukuhan') ?>">

                  <h4 class="ml-2">Pedukuhan</h4>
                  <div class="col mb-3 kolom_pedukuhan">
                    <?php
                      $arr = explode("-", $profil['pedukuhan']);

                      $result = array_filter( $arr, 'strlen' );

                      foreach ($result as $a) {
                        
                    ?>
                    <div class="row input_pedukuhan">
                      <div class="col-4">
                        <!-- keren kalo bisa dikasih map -->
                        <div class="form-group">
                          <input type="text" class="form-control" name="pedukuhan[]" id="pedukuhan[]" placeholder="Nama Pedukuhan" value="<?= $a ?>">
                        </div>
                      </div>  
                      <div class="col-1">
                        <button type="button" class="btn btn-sm btn-danger remove"><span class="fas fa-fw fa-times"></span></button>
                      </div> 
                    </div>

                    <?php } ?>
                  </div>

                  <div class="col-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary add_pedukuhan"><span class="fas fa-fw fa-plus"></span></button>
                  </div>

                  <div class="col-4">
                    <button type="submit" class="btn btn-sm btn-success" name="simpan_pedukuhan" value="simpan"><span class="fas fa-fw fa-check"></span> Simpan</button>
                  </div>

                </form>

                </div>
                <!-- PEDUKUHAN ENDS -->

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
          .create( document.querySelector( '#sejarah' ))
          .then( editor => {
              console.log( editor );
          } )
          .catch( error => {
              console.error( error );
          } );

          ClassicEditor
          .create( document.querySelector( '#visi' ))
          .then( editor => {
              console.log( editor );
          } )
          .catch( error => {
              console.error( error );
          } );

          ClassicEditor
          .create( document.querySelector( '#misi' ))
          .then( editor => {
              console.log( editor );
          } )
          .catch( error => {
              console.error( error );
          } );

          ClassicEditor
          .create( document.querySelector( '#struktur' ))
          .then( editor => {
              console.log( editor );
          } )
          .catch( error => {
              console.error( error );
          } );

          // DYNAMIC INPUT PEDUKUHAN

          $(".add_pedukuhan").click(function() {
            $(".kolom_pedukuhan > :first-child").clone(true).find("input").val("").end().appendTo(".kolom_pedukuhan");
          });

          $(".remove").click(function() {
              $(this).parents("div.input_pedukuhan").remove();
          });


          $('#gambar').on('change',function(){
            //get the file name
            var fileName = $(this).val().replace("C:\\fakepath\\", "");
            //replace the "Choose a file" label
            $(this).next('.gambar-label').html(fileName);
          });

        });
      </script>

      