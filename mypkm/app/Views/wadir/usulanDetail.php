<?= $this->extend('wadir/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Data Dokumen</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td><label for="" class="form-label">Proposal</label></td>
                                <td>
                                    <?php if (!empty($dataUsulan['proposal'])) : ?>
                                        <a href="/assets/file/proposal/<?= $dataUsulan['proposal'] ?>" download="<?= $dataUsulan['proposal'] ?>" class="btn btn-info btn-sm">Download Proposal</a>
                                    <?php else : ?>
                                        <span class="badge bg-danger">Belum Upload Proposal</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="" class="form-label">ID Belmawa</label></td>
                                <td><input type="text" class="form-control" value="<?= $dataUsulan['id_belmawa'] ?>" disabled></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Data Usualan</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td><label for="" class="form-label">Judul</label></td>
                                <td><input type="text" class="form-control" value="<?= $dataUsulan['judul'] ?>" disabled></td>
                            </tr>
                            <tr>
                                <td><label for="exampleInputEmail1" class="form-label">Pengusul</label></td>
                                <td>
                                    <select class="form-control" name="mahasiswa" id="selectMahasiswa" disabled>
                                        <option value="">PILIH MAHASISWA</option>
                                        <?php
                                        $existingStudentId = $dataUsulan['id_mahasiswa'];
                                        foreach ($dataMahasiswa as $mhs) :
                                            $selected = ($mhs['id_mahasiswa'] == $existingStudentId) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $mhs['id_mahasiswa'] ?>" <?= $selected ?>><?= $mhs['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="" class="form-label">Tahun</label></td>
                                <td><input type="text" class="form-control" value="<?= $dataUsulan['tahun_ajaran'] ?>" disabled></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal upload document-->
<div class="modal fade" id="uploadDocument" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/wadir/usulan/uploadDocument" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_usulan" value="<?= $dataUsulan['id_usulan'] ?>">
                    <input type="hidden" name="id_mahasiswa" value="<?= $dataUsulan['id_mahasiswa'] ?>">
                    <div class="row">
                        <h2>Data Proposal Usulan</h2>
                        <hr>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td><label class="form-label">Judul</label></td>
                                        <td><input type="text" class="form-control" name="judul" placeholder="Masukan judul" value="<?= $dataUsulan['judul'] ?>" autocomplete="off" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><label class="form-label">Laporan</label></td>
                                        <td>
                                            <?php if (!empty($dataUsulan['laporan'])) : ?>
                                                <p><?= $dataUsulan['laporan'] ?></p>
                                                <input type="file" class="form-control" name="laporan" placeholder="Masukan judul" autocomplete="off">
                                            <?php else : ?>
                                                <input type="file" class="form-control" name="laporan" placeholder="Masukan judul" autocomplete="off" required>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload Laporan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>