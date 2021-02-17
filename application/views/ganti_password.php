<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Buat Password Baru</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/dashboard/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/dashboard/') ?>css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="card col-lg-7 o-hidden border-0 shadow-lg mx-auto my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Password Baru</h1>
                            </div>
                            <form class="user" method="post" action="<?= base_url('auth/ganti_password') ?>">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-plaintext text-center" id="email" name="email" value="<?= $email ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password baru">
                                    <small class="ml-3">Password minimal 6 karakter</small>
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi password baru">
                                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Reset Password
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth') ?>">Sudah punya akun? Login disini</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/dashboard/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/dashboard/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/dashboard/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/dashboard/') ?>js/sb-admin-2.min.js"></script>

</body>

</html>