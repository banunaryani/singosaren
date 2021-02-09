

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <?= form_error('kategori', '<div class="alert alert-danger">', '</div>'); ?>
          <?= $this->session->flashdata('message'); ?>


          <div class="row">
            <div class="col-2">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-all-tab" data-toggle="pill" href="#all-tab" role="tab" aria-controls="all-tab' ?>" aria-selected="true"><strong>Semua</strong></a>
                <?php
                foreach ($kategori as $k) {
                ?>
                
                <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#<?= strtolower($k['kategori']).'-tab' ?>" role="tab" aria-controls="<?= strtolower($k['kategori']).'-tab' ?>" aria-selected="true"><?= $k['kategori'] ?></a>

                <?php
                } //end foreach
                ?>


              </div>
              <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-sm btn-warning mt-4 mx-1" data-toggle="modal" data-target="#editModal" data-toggle="tooltip" data-placement="top" title="Edit kategori"><span class="fas fa-fw fa-sm fa-pen"></span></a>
                <a href="#" class="btn btn-sm btn-primary mt-4 mx-1" data-toggle="modal" data-target="#tambahModal" data-toggle="tooltip" data-placement="top" title="Tambah kategori"><span class="fas fa-fw fa-sm fa-plus"></span></a>
              </div>
            </div>
            <div class="col">

            <div class="card">
              <div class="card-header d-flex bd-highlight">
                <div class="mr-auto p-2 bd-highlight">
                  <h5 class="tab_header pt-2"></h5>
                </div>
                
                <div class="input-group p-2 bd-highlight col-4">
                  <input type="text" class="form-control" placeholder="Cari layanan disini..." aria-label="Cari disini..." aria-describedby="button-addon2" id="search">
                </div>

                <div class="p-2 bd-highlight">
                  <a href="<?= base_url('admin/layanan/tambah_layanan') ?>" class="btn btn-primary"><span class="fas fa-fw fa-plus"></span> Tambah Layanan</a>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                  <!-- ALL -->
                  <div class="tab-pane fade" id="all-tab" role="tabpanel" aria-labelledby="v-pills-all-tab">
                    <?php
                      foreach ($layanan as $key => $l) {
                        $no = 1;
                      ?>

                      <div class="card layanan_card mb-2">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-auto">
                                <i class="fas fa-fw fa-file-alt"></i>
                            </div>
                            <div class="col-8"><?php echo $l['judul']; echo ($l['arsipkan'] == 1)? '<small><span class="badge badge-secondary ml-2">Diarsipkan</span></small>':''; echo ($l['tampil_beranda'] == 1)? '<small data-toggle="tooltip" title="Ditampilakan di halaman depan"><span class="badge badge-primary ml-2"><span class="fas fa-fw fa-sm fa-desktop"></span></span></small>':'';echo ($l['file'])? '<small data-toggle="tooltip" title="Lampiran dokumen"><span class="badge badge-success ml-2"><span class="fas fa-fw fa-sm fa-download"></span></span></small>':'' ?></div>
                            <div class="col">
                              <a href="<?= base_url('admin/layanan/edit_layanan/').$l['layanan_id'] ?>" class="btn btn-sm btn-warning card-link"><span class="fas fa-fw fa-pen mr-1"></span>Edit</a>
                              <a href="#" data-toggle="modal" data-target="#hapusModal-<?= $l['layanan_id']?>" class="btn btn-sm btn-danger card-link"><span class="fas fa-fw fa-trash mr-1"></span>Hapus</a>
                              <a href="<?= base_url('admin/layanan/detail/').$l['slug'] ?>" class="card-link"><span class="fas fa-fw fa-eye mr-1"></span> Lihat</a>
                            </div>
                          </div>
                          
                        </div>
                      </div>

                      <!-- MODAL HAPUS STARTS HERE-->
                      <div class="modal fade" id="hapusModal-<?= $l['layanan_id']?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus layanan ini?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Anda akan menghapus layanan <strong><?= $l['judul'] ?></strong></div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                              <a class="btn btn-danger" href="<?= base_url()?>admin/layanan/hapus_layanan/<?= $l['layanan_id']?>">Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- MODAL HAPUS ENDS HERE -->

                      <?php
                      }
                      ?>
                  </div>
                  <!-- END ALL -->
                

                <!-- KATEGORI -->
                <?php
                foreach ($kategori as $k) {
                ?>
                    <div class="tab-pane fade" id="<?= strtolower($k['kategori']).'-tab' ?>" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <?php
                      foreach ($layanan as $key => $l) {
                        $no = 1;
                        if ($l['kategori_id'] == $k['id']) {
                      ?>

                      <div class="card layanan_card mb-2">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-auto">
                                <i class="fas fa-fw fa-file-alt"></i>
                            </div>
                            <div class="col-8"><?php echo $l['judul']; echo ($l['arsipkan'] == 1)? '<small><span class="badge badge-secondary ml-2">Diarsipkan</span></small>':''; echo ($l['tampil_beranda'] == 1)? '<small data-toggle="tooltip" title="Ditampilakan di halaman depan"><span class="badge badge-primary ml-2"><span class="fas fa-fw fa-sm fa-desktop"></span></span></small>':'' ?></div>
                            <div class="col">
                              <a href="<?= base_url('admin/layanan/edit_layanan/').$l['layanan_id'] ?>" class="btn btn-sm btn-warning card-link"><span class="fas fa-fw fa-pen mr-1"></span>Edit</a>
                              <a href="#" data-toggle="modal" data-target="#hapusModal-<?= $l['layanan_id']?>" class="btn btn-sm btn-danger card-link"><span class="fas fa-fw fa-trash mr-1"></span>Hapus</a>
                              <a href="<?= base_url('admin/layanan/detail/').$l['slug'] ?>" class="card-link"><span class="fas fa-fw fa-eye mr-1"></span> Lihat</a>
                            </div>
                          </div>
                          
                        </div>
                      </div>

                      <!-- MODAL HAPUS STARTS HERE-->
                      <div class="modal fade" id="hapusModal-<?= $l['layanan_id']?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus layanan ini?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Anda akan menghapus layanan <strong><?= $l['judul'] ?></strong></div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                              <a class="btn btn-danger" href="<?= base_url()?>admin/layanan/hapus_layanan/<?= $l['layanan_id']?>">Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- MODAL HAPUS ENDS HERE -->

                      <?php
                        }
                      }
                      ?>


                    </div>

                <?php
                } //end foreach
                ?>

                </div>
              </div>
            </div>
          </div>
        </div>

          <!-- MODAL TAMBAH STARTS HERE-->
          <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahModalLabel">Tambah Kategori Layanan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="<?= base_url()?>admin/layanan">
                  <div class="modal-body">
                      <div class="form-group">
                        <label class="small" for="menu">Nama kategori baru</label>
                        <input type="text" class="form-control" name="kategori" id="kategori">
                        <small>contoh: Kependudukan, Pertanahan, Perizinan, Keamanan, dll.</small>
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- MODAL TAMBAH ENDS HERE -->

          <!-- MODAL EDIT STARTS HERE-->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Kategori Layanan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="<?= base_url()?>admin/layanan/edit_kategori">
                  <div class="modal-body">
                    <table class="table">
                      <thead>
                        <th>#</th>
                        <th>Kategori</th>
                        <th>#</th>
                      </thead>
                      <tbody>
                    <?php
                    foreach ($kategori as $k) {
                    ?>
                        <tr>
                          <td><?= $k['id'] ?>
                            <input type="hidden" name="id[]" id="id[]" value="<?= $k['id'] ?>">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="kategori[]" id="kategori[]" value="<?= $k['kategori'] ?>">
                          </td>
                          <td>
                            <a href="<?= base_url('admin/layanan/hapus_kategori/').$k['id']?>"><span class="fas fa-fw fa-sm fa-trash"></span></a>
                          </td>
                        </tr>
                      <?php
                      } //end foreach
                      ?>
                      </tbody>
                    </table>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- MODAL EDIT ENDS HERE -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <script type="text/javascript">

        $(function() {

          function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
          }

          $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $(".tab-content .layanan_card").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

          $('.nav-pills a:first-child').addClass('active');

          $('.tab-pane:first-child').addClass('show active');

          $('.nav-pills a').on('shown.bs.tab', function(e) {
            var current = $(e.target).text();
            $('.tab_header').html(capitalizeFirstLetter(current));
          });

          var activeTab = $('.tab-pane[class~="active"]').attr('id');
          $('.tab_header').html(capitalizeFirstLetter(activeTab.substr(0,activeTab.length-4)));


        });
      </script>

      