<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <!-- =====DESKRIPSI===== -->

    <div class="card">
        <form method="post" action="<?= base_url('admin/jargon') ?>">
            <div class="card-body mx-3">

                <h5><strong>Jargon 1</strong></h5>
                <div class="form-group">
                    <label for="jargon1">Jargon</label>
                    <input type="text" class="form-control" name="jargon1" id="jargon1" value="<?= $jargon['jargon1'] ?>">
                    <?= form_error('jargon1', '<small class="text-danger pl-3">', '</small>') ?>
                </div>

                <div class="form-group">
                    <label for="subjargon1">Sub-jargon <small><i>(opsional)</i></small></label>
                    <input type="text" class="form-control" name="subjargon1" id="subjargon1" value="<?= $jargon['subjargon1'] ?>">
                </div>

                <hr>

                <h5><strong>Jargon 2</strong></h5>
                <div class=" form-group">
                    <label for="jargon2">Jargon</label>
                    <input type="text" class="form-control" name="jargon2" id="jargon2" value="<?= $jargon['jargon2'] ?>">
                    <?= form_error('jargon2', '<small class="text-danger pl-3">', '</small>') ?>
                </div>

                <div class="form-group">
                    <label for="subjargon2">Sub-jargon <small><i>(opsional)</i></small></label>
                    <input type="text" class="form-control" name="subjargon2" id="subjargon2" value="<?= $jargon['subjargon2'] ?>">
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success ml-2 float-right"><span class="fas fa-fw fa-check"></span> Simpan</button>
            </div>
        </form>


    </div>





</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->