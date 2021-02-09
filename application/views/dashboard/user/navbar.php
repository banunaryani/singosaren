
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

          <!-- Basic Card Begin -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <div class="row">
                    <div class="ml-4 mx-2">
                  <a href="<?= base_url('admin/navbar/tambah') ?>" class="btn btn-primary px-3"><i class="fas fa-plus mr-2"></i><strong>Tambah Menu</strong></a>
                </div>
                  </div>                  
                </div>

                <div class="card-body">
                  <?= form_error('navbar_menu', '<div class="alert alert-danger">', '</div>'); ?>
                  <?= form_error('link_menu', '<div class="alert alert-danger">', '</div>'); ?>
                  <?= form_error('urutan', '<div class="alert alert-danger">', '</div>'); ?>
                  <?= $this->session->flashdata('message'); ?>
                  <div class="table-responsive">                     
                    <table class="table table-hover" id="tabel_navbar" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Menu</th>
                        <th>Link</th>
                        <th>Submenu</th>
                        <th>Aktif/Nonaktif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  <!-- ROW STARTS -->
                  <?php

                  $jml = count($navbar);

                  foreach ($navbar as $p) {
                    // var_dump($p);

                  ?>

                    <tr>
                      <td><?= $p['urutan'] ?></td>
                      <td><?= $p['menu_nav']?></td>
                      <td><?= $p['link']?></td>
                      <td><?= $p['submenus'] ?></td>
                      <td>
                        <!-- Rounded switch -->
                      <form method="post" action="<?= base_url()?>admin/navbar/aktifkan_navbar/<?= $p['id']."/".$p['is_active']?>">
                        <label class="switch">
                           <input type="checkbox" id="is_active" name="is_active" <?php echo ($p['is_active']) ? 'checked' : ''; ?> onChange="this.form.submit()">
                          <span class="slider round"></span>
                        </label>
                      </form>
                      </td>
                      <td>
                        <a href="<?= base_url()?>admin/navbar/edit_navbar/<?= $p['id'] ?>">Edit</a>
                        |
                        <a data-toggle="modal" data-target="#hapusModal-<?= $p['id']?>" href="#">Hapus</a>
                      </td>               

                </tr>

                      <!-- MODAL HAPUS STARTS HERE-->
                    <div class="modal fade" id="hapusModal-<?= $p['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus menu?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">Anda akan menghapus menu <strong><?= $p['menu_nav'] ?></strong> dan submenu <strong><?= $p['submenus'] ?></strong></div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger" href="<?= base_url()?>admin/navbar/hapus_navbar/<?= $p['id']?>">Hapus</a>
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

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <script type="text/javascript">
        
        $(function() {

          // DYNAMIC INPUT SUBMENU NAVBAR
          $(".btn_tambah_submenu").click(function() {
            $(".submenu_navbar td").append(function(n){
              var str = '<div class="row input_submenu_navbar"><div class="col-1"><span class="fas fa-fw fa-sm fa-plus-square"></span></div><div class="col"><div class="form-group"><label for="nama_submenu[]">Submenu</label><input type="text" class="form-control" name="nama_submenu[]" id="nama_submenu[]" placeholder="Submenu"></div><div class="form-group"><label for="link[]">Link</label><input type="url" class="form-control" name="link_submenu[]" id="link_submenu[]" placeholder="http://contoh.com"></div><hr></div><div class="col-1"><i class="btn btn-danger btn-sm remove"><span class="fas fa-fw fa-times"></span></i></div></div>';

              var str1 = "<p class='remove'>Hai</p>";

              return str1;
            });
            // $(".submenu_navbar > :first-child").clone(true).find("input").val("").end().appendTo(".submenu_navbar");
          });

          
          $(".remove").on('click', function(){
            alert('click');
          });

        });

      </script>