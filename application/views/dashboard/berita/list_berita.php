<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

  <?= form_error('kategori', '<div class="alert alert-danger">', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>

  <div class="row">

    <div class="col-lg-2 col-md-1 mb-3">
      <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><strong>Semua</strong></a>

        <?php
        foreach ($kategori as $k) {
        ?>
          <a class="nav-link" id="<?= lcfirst($k['kategori']) ?>-tab" data-toggle="pill" href="#<?= lcfirst($k['kategori']) ?>" role="tab" aria-controls="<?= lcfirst($k['kategori']) ?>" aria-selected="false"><?= $k['kategori'] ?></a>
        <?php
        }
        ?>
      </div>

      <div class="d-flex justify-content-end">
        <a href="#" class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#editModal" data-toggle="tooltip" data-placement="bottom" title="Edit kategori berita"><span class="fas fa-fw fa-pen"></span></a>
        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahModal" data-toggle="tooltip" data-placement="bottom" title="Tambah kategori berita"><span class="fas fa-fw fa-plus"></span></a>
      </div>

    </div>


    <div class="col">
      <div class="tab-content" id="v-pills-tabContent">

        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <div class="card">
            <div class="card-header">
              <a href="<?= base_url('admin/berita/tambah') ?>" class="btn btn-primary"><span class="fas fa-fw fa-plus"></span> Tambah Berita</a>
            </div>
            <div class="card-body">
              <table class="table main-table table-hover table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Dipost oleh</th>
                    <th scope="col" style="width: 15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($berita as $b) {
                  ?>
                    <tr>
                      <td><?= $no;
                          $no++; ?></td>
                      <td>
                        <img width="100" src="<?= base_url('assets/img/berita/') . $b['gambar'] ?>">
                      </td>
                      <td><?php echo '<a href=' . base_url('berita/') . $b['slug'] . ' target="_blank">' . $b['judul'] . '</a>';
                          echo ($b['arsipkan'] == 1) ? '<small><span class="badge badge-secondary ml-2">Diarsipkan</span></small>' : '' ?></td>
                      <td><?= $b['kategori'] ?></td>
                      <td><?= $b['tanggal_dibuat'] ?></td>
                      <td><?= $b['posted_by'] ?></td>
                      <td>
                        <a href="<?= base_url('admin/berita/edit/') . $b['slug'] ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fas fa-fw fa-pen"></span></a>
                        <a href="#" data-toggle="modal" data-target="#hapusModal" class="btn btn-sm btn-danger " data-id="<?= $b['id'] ?>" data-judul="<?= $b['judul'] ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"><span class="fas fa-fw fa-trash"></span></a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
          <!-- end card -->
        </div>

        <?php
        foreach ($kategori as $k) {
        ?>
          <div class="tab-pane fade" id="<?= lcfirst($k['kategori']) ?>" role="tabpanel" aria-labelledby="<?= lcfirst($k['kategori']) ?>-tab">
            <div class="card">
              <div class="card-header">
                <a href="<?= base_url('admin/berita/tambah') ?>" class="btn btn-primary"><span class="fas fa-fw fa-plus"></span> Tambah Berita</a>
              </div>
              <div class="card-body">
                <table class="table main-table table-hover table-responsive">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Gambar</th>
                      <th scope="col">Judul</th>
                      <th scope="col">Kategori</th>
                      <th scope="col">Tanggal Dibuat</th>
                      <th scope="col">Dipost oleh</th>
                      <th scope="col" style="width: 15%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($berita as $b) {
                      if ($b['kategori'] == $k['kategori']) {
                    ?>
                        <tr>
                          <td><?= $no;
                              $no++; ?></td>
                          <td>
                            <img width="100" src="<?= base_url('assets/img/berita/') . $b['gambar'] ?>">
                          </td>
                          <td><?= '<a href=' . base_url('berita/') . $b['slug'] . ' target="_blank">' . $b['judul'] . '</a>' ?></td>
                          <td><?= $b['kategori'] ?></td>
                          <td><?= $b['tanggal_dibuat'] ?></td>
                          <td><?= $b['posted_by'] ?></td>
                          <td>
                            <a href="<?= base_url('admin/berita/edit/') . $b['slug'] ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fas fa-fw fa-pen"></span></a>
                            <a href="#" data-toggle="modal" data-target="#hapusModal" class="btn btn-sm btn-danger " data-toggle="tooltip" data-placement="bottom" title="Hapus" data-id="<?= $b['id'] ?>" data-judul="<?= $b['judul'] ?>"><span class="fas fa-fw fa-trash"></span></a>
                          </td>
                        </tr>
                    <?php
                      }
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
            <!-- end card -->
          </div>
        <?php
        }
        ?>

      </div>
    </div>

  </div>

  <!-- MODAL HAPUS STARTS HERE-->
  <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalHapusLabel">Yakin menghapus berita ini?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="<?= base_url() ?>admin/berita/hapus/">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL HAPUS ENDS HERE -->

  <!-- MODAL TAMBAH STARTS HERE-->
  <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Kategori Berita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="<?= base_url() ?>admin/berita">
          <div class="modal-body">
            <div class="form-group">
              <label class="small" for="menu">Nama kategori baru</label>
              <input type="text" class="form-control" name="kategori" id="kategori">
              <small>contoh: Pengumuman, Sosialisasi, dll.</small>
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
          <h5 class="modal-title" id="editModalLabel">Edit Kategori Berita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="<?= base_url() ?>admin/berita/edit_kategori">
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
                      <a href="<?= base_url('admin/berita/hapus_kategori/') . $k['id'] ?>"><span class="fas fa-fw fa-sm fa-trash"></span></a>
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

    $('.main-table').DataTable();

    $('#hapusModal').on('show.bs.modal', function(event) {
      $(this).find('.modal-footer a').attr('href', '<?= base_url('admin/berita/hapus/') ?>')
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id') // Extract info from data-* attributes
      var judul = button.data('judul')

      var modal = $(this)
      modal.find('.modal-body').html('Anda akan menghapus berita ' + '<strong>' + judul + '</strong>')
      modal.find('.modal-footer a').attr('href', function(i, val) {
        return val + id;
      })
    })

  });
</script>