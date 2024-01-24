<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Form Tambah Data Usulan</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/admin/usulan/addProses" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <h2>Data Proposal Usulan</h2>
                            <hr>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td><label for="exampleInputEmail1" class="form-label">Judul</label></td>
                                            <td><input type="text" class="form-control" name="judul" placeholder="Masukan judul" autocomplete=a"off" required></td>
                                        </tr>
                                        <tr>
                                            <td><label for="exampleInputEmail1" class="form-label">Tahun</label></td>
                                            <td><input type="text" class="form-control" name="tahun_ajaran" placeholder="Masukan tahun" required></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Proposal</label></td>
                                            <td>
                                                <?php if (!empty($dataUsulan['proposal'])) : ?>
                                                    <p><?= $dataUsulan['proposal'] ?></p>
                                                    <input type="file" class="form-control" name="proposal" placeholder="Masukan skema" autocomplete="off">
                                                <?php else : ?>
                                                    <input type="file" class="form-control" name="proposal" placeholder="Masukan skema" autocomplete="off" required>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">ID Belmawa</label></td>
                                            <td><input type="text" class="form-control" name="id_belmawa" placeholder="Masukan id belmawa" autocomplete="off" required></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <h2>Data Mahasiswa</h2>
                            <hr>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td><label for="exampleInputEmail1" class="form-label">Nama</label></td>
                                            <td>
                                                <select class="form-control" name="mahasiswa" id="selectMahasiswa">
                                                    <option value="">PILIH MAHASISWA</option>
                                                    <?php foreach ($dataMahasiswa as $mhs) : ?>
                                                        <option value="<?= $mhs['id_mahasiswa'] ?>"><?= $mhs['nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>