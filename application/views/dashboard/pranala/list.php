

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <?= form_error('kategori', '<div class="alert alert-danger">', '</div>'); ?>
          <?= $this->session->flashdata('message'); ?>


          <div class="card">
            <div class="card-header">
              <a href="<?= base_url('admin/pranala/tambah') ?>" class="btn btn-primary"><span class="fas fa-fw fa-plus"></span> Tambah Pranala</a>
            </div>
            <!-- end card header -->
            <div class="card-body">

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($pranala as $p) {
                  ?>
                  <tr>
                    <th scope="row"><?= $no;$no++ ?></th>
                    <td>
                      <img src="<?= base_url('assets/img/pranala/').$p['logo'] ?>" width="150">
                    </td>
                    <td><?= $p['judul'] ?></td>
                    <td>
                      <strong><span class="fas fa-fw fa-home mr-2"></span></strong><?= $p['alamat'] ?>
                      <br>
                      <strong><span class="fas fa-fw fa-phone mr-2"></span></strong><?= $p['telp'] ?>
                      <br>
                      <strong><span class="fas fa-fw fa-globe mr-2"></span></strong><?= $p['website'] ?>
                      <br>
                      <strong><span class="fab fa-fw fa-facebook-f mr-2"></span></strong><?= $p['fb'] ?>
                      <br>
                      <strong><span class="fab fa-fw fa-twitter mr-2"></span></strong><?= $p['twitter'] ?>
                      <br>
                      <strong><span class="fab fa-fw fa-instagram mr-2"></span></strong><?= $p['ig'] ?>
                    </td>
                    <td>
                      <a href="<?= base_url('admin/pranala/edit/').$p['id'] ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fas fa-fw fa-pen"></span></a>
                      <a href="#" data-toggle="modal" data-target="#hapusModal" class="btn btn-sm btn-danger " data-id="<?= $p['id'] ?>" data-judul="<?= $p['judul'] ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"><span class="fas fa-fw fa-trash"></span></a>
                    </td>
                  </tr>
                  <?php
                  } ?>
                </tbody>
              </table>

            </div>
            <!-- end card body -->
          </div>

          <!-- MODAL HAPUS STARTS HERE-->
          <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus pranala ini?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger" href="<?= base_url()?>admin/berita/hapus/">Hapus</a>
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

          $('#hapusModal').on('show.bs.modal', function (event) {
            $(this).find('.modal-footer a').attr('href', '<?= base_url('admin/pranala/hapus/') ?>')
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var judul = button.data('judul')

            var modal = $(this)
            modal.find('.modal-body').html('Anda akan menghapus pranala ' + '<strong>'+judul+'</strong>')
            modal.find('.modal-footer a').attr('href', function(i, val) {
              return val+id;
            })
          })


        });
      </script>

      