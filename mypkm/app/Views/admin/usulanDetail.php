<?= $this->extend('admin/layout') ?>
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
                        <div class="col-md-6">
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

<script>
    function confirmDelete(usulan) {
        if (confirm("Apakah Anda yakin ingin menghapus mahasiswa dengan ID ")) {
            window.location.href = "/admin/usulan/delete/" + mahasiswaId;
        }
    }
</script>


<?= $this->endSection() ?>