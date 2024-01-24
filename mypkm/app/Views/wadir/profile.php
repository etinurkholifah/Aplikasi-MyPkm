<?= $this->extend('wadir/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>My Profile</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/wadir/profile/updateProses" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_akademik" value="<?= $dataAkademik['id_akademik'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">NIP</label>
                                    <input type="number" class="form-control" name="nip" placeholder="Masukan nip" value="<?= $dataAkademik['nip'] ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukan nama" value="<?= $dataAkademik['nama'] ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Masukan email" value="<?= $dataAkademik['email'] ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Masukan username" value="<?= $dataAkademik['username'] ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukan password" autocomplete="off">
                                    <small class="text-danger">Abaikan jika tidak update password</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Role</label>
                                    <select class="form-control " name="role" id="role" disabled>
                                        <option value="">PILIH ROLE</option>
                                        <option value="KABAG" <?php echo ($dataAkademik['role'] == 'KABAG') ? 'selected' : ''; ?>>KABAG</option>
                                        <option value="KASUBAG" <?php echo ($dataAkademik['role'] == 'KASUBAG') ? 'selected' : ''; ?>>KASUBAG</option>
                                        <option value="WADIR" <?php echo ($dataAkademik['role'] == 'WADIR') ? 'selected' : ''; ?>>WADIR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Foto Profile</label>
                                    <input type="file" class="form-control" name="foto">
                                </div>
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