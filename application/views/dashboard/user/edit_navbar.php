

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <?= $this->session->flashdata('message'); ?>

          <form method="post" action="<?= base_url()?>admin/navbar/edit_navbar/<?= $menu['id'] ?>" id="form_tambah_navbar">

            <div class="col-7">
              
              <input type="hidden" name="id" id="id" value="<?= $menu['id'] ?>">

              <div class="form-group">
                <label class="small" for="navbar_menu">Nama menu</label>
                <input type="text" class="form-control" name="navbar_menu" id="navbar_menu" value="<?= $menu['menu_nav'] ?>">
              </div>

              <div class="form-group">
                <label class="small" for="link_menu">Link tujuan</label>
                <input type="url" class="form-control" name="link_menu" id="link_menu" value="<?= $menu['link'] ?>">
              </div>


                <div class="card">
                  <div class="card-header">
                    <p class="mb-0"><strong>Submenu</strong></p> 
                  </div>
                  <div class="card-body">

                    <ul class="submenu_navbar">
                        <?php
                        // var_dump($submenu);die;
                        foreach ($submenu as $s) {
                        ?>
                        <!-- SUBMENU -->
                        <li>
                          <div class="row input_submenu_navbar">

                            <div class="col-1">
                              <span class="fas fa-fw fa-sm fa-plus-square"></span>
                            </div>

                            <div class="col">
                              <input type="hidden" name="id_submenu[]" value="<?= $s['id_submenu'] ?>">
                              <div class="form-group">
                                <label for="nama_submenu[]">Submenu</label>
                                <input type="text" class="form-control" name="nama_submenu[]" id="nama_submenu[]" placeholder="Submenu" value="<?= $s['submenu'] ?>">
                              </div>
                              <div class="form-group">
                                <label for="link[]">Link</label>
                                <input type="url" class="form-control" name="link_submenu[]" id="link_submenu[]" placeholder="http://contoh.com" value="<?= $s['link_submenu'] ?>">
                              </div>
                              <hr>
                            </div>

                            <div class="col-1">
                              <i class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal" data_menuid="$menu['id']" data-id="<?= $s['id_submenu'] ?>" data-submenu="<?= $s['submenu'] ?>"><span class="fas fa-fw fa-trash"></span></i>
                            </div>

                          </div>
                        </li>
                        <!-- SUBMENU ENDS -->
                        <?php
                        } if ($submenu == '') {
                          echo "<p id='kosong'>Tidak ada submenu</p>";
                        } ?>
                    </ul>

                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-primary btn_tambah_submenu"><span class="fas fa-fw fa-plus"></span></button>
                      </div>
                    </div>

                  </div>
                </div>

              <div class="form-group">
                <label class="small" for="urutan">Urutan</label>
                <select class="form-control" name="urutan" id="urutan">
                  <?php 
                  for ($i=1; $i <= $jml+1; $i++) { 
                    ?>
                    <option value="<?= $i ?>" <?= ($i == $menu['urutan'])? "selected":"" ?>><?= $i ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="aktif" name="aktif" <?= ($menu["is_active"] == 1)? "checked":"" ?>>
                <label class="form-check-label" for="aktif">
                  Aktif?
                </label>
              </div>

              <div class="row justify-content-end mt-3 mr-2">
                <div class="form-group">
                  <a href="<?= base_url('admin/navbar') ?>" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                  <button type="submit" class="btn btn-success">Simpan</button>                
                </div>
              </div>

            </div>

        </form>

        <!-- MODAL HAPUS STARTS HERE-->
        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus menu?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="#">Hapus</a>
              </div>
            </div>
          </div>
        </div>
        <!-- MODAL HAPUS ENDS HERE -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <script type="text/javascript">
        $(function() {

          var str = '<li><div class="row input_submenu_navbar"><div class="col"><div class="form-group"><label for="nama_submenu[]">Submenu</label><input type="text" class="form-control" name="nama_submenu[]" id="nama_submenu[]" placeholder="Submenu"></div><div class="form-group"><label for="link[]">Link</label><input type="url" class="form-control" name="link_submenu[]" id="link_submenu[]" placeholder="http://contoh.com"></div><hr></div><div class="col-1"><i class="btn btn-warning btn-sm remove"><span class="fas fa-fw fa-minus"></span></i></div></div></li>';

          // DYNAMIC INPUT SUBMENU NAVBAR
          $(".btn_tambah_submenu").on('click',function() {
            $("#kosong").remove();
            $(".submenu_navbar").append(str);
            // $(".submenu_navbar > :first-child").clone(true).find("input").val("").end().appendTo(".submenu_navbar");
          });


          $(".submenu_navbar").on('click', '.remove', function(n){

            n.currentTarget.closest('li').remove();
                  
          });



          $('#hapusModal').on('show.bs.modal', function (event) {
            $(this).find('.modal-footer a').attr('href', '<?= base_url('admin/navbar/hapus_submenu/') ?>')
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var judul = button.data('submenu')
            var menuid = button.data('menuid')

            var modal = $(this)
            modal.find('.modal-body').html('Anda akan menghapus submenu ' + '<strong>'+judul+'</strong>')
            modal.find('.modal-footer a').attr('href', function(i, val) {
              return val+id+'/'+menuid;
            })
          })
        });
      </script>

      