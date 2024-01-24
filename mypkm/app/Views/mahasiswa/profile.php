<?= $this->extend('mahasiswa/layout') ?>
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
                <?php if (!empty(session('success'))) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (!empty(session('error'))) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo session('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <form action="/mahasiswa/profile/updateProses" method="POST">
                        <input type="hidden" name="id" value="<?= $dataMahasiswa['id_mahasiswa'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">NPM</label>
                                    <input type="number" class="form-control" name="npm" placeholder="Masukan npm" value="<?= $dataMahasiswa['npm'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukan nama mahasiswa" value="<?= $dataMahasiswa['nama'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="" cols="20" rows="5" placeholder="Masukan alamat"><?= $dataMahasiswa['alamat'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukan email" value="<?= $dataMahasiswa['email'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">No Handphone</label>
                                    <input type="number" name="nohp" class="form-control" placeholder="Masukan no handphone" value="<?= $dataMahasiswa['no_hp'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $dataMahasiswa['tgl_lahir'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Program Studi</label>
                                    <input type="text" class="form-control" name="prodi" value="<?= $dataMahasiswa['prodi'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Semester</label>
                                    <select class="form-control" name="semester" id="">
                                        <option value="">Pilih Semester</option>
                                        <?php
                                        $selectedSemester = $dataMahasiswa['semester'];
                                        for ($i = 1; $i <= 5; $i++) {
                                            $selected = ($i == $selectedSemester) ? "selected" : "";
                                            echo "<option value='$i' $selected>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                    <span class="text-danger">abaikan jika tidak update password</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>