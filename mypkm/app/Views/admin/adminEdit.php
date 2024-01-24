<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Form Update Data Administator</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/admin/admin/updateProses" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_admin" value="<?= $dataAdmin['id_admin']?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukan nama" value="<?= $dataAdmin['nama']?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Masukan username" value="<?= $dataAdmin['username']?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukan password" autocomplete="off">
                                    <small class="text-danger">Kosongkan jika tidak update password</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Foto Profile</label>
                                    <input type="file" class="form-control" name="foto"  >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h6>Foto Saat ini</h6>
                                <img src="/assets/images/admin/<?= $dataAdmin['foto']?>" alt="" srcset="" width="100">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>