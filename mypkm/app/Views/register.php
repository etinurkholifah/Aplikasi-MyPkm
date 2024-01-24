<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="/assets/images/logo.png" />
    <link rel="stylesheet" href="/assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="container">
                                    <div class="d-flex justify-content-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <img src="/assets/images/logo.png" width="70" alt="">
                                            <h1 class="fw-bold ms-2">My PKM</h1>
                                        </div>
                                    </div>
                                    <p class="text-center">Politeknik Negeri Lampung</p>
                                    <form action="/register/processRegister" method="post">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">NPM</label>
                                            <input type="number" class="form-control" name="npm" placeholder="Masukan npm" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama Mahasiswa</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Masukan nama mahasiswa" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">No Handphone</label>
                                            <input type="number" name="nohp" class="form-control" placeholder="Masukan no handphone" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="masukan password" required>
                                        </div>
                                        <?php if (!empty(session('error'))) : ?>
                                            <p style="color: red;"><?php echo session('error'); ?></p>
                                        <?php endif; ?>
                                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar</button>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <p class="fs-4 mb-0 fw-bold">Sudah punya akun?</p>
                                            <a class="text-primary fw-bold ms-2" href="/login">Silakan login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>