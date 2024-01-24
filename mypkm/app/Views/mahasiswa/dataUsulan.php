<?= $this->extend('mahasiswa/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Data Usulan</h2>
                        </div>
                        <div class="col-md-6 text-end">
                            <?php
                            $id_mahasiswa = session('user')['id_mahasiswa'];

                            // Memeriksa apakah ada data usulan yang sesuai dengan id_mahasiswa dari sesi
                            $usulanExists = false;
                            foreach ($dataUsulan as $usulan) {
                                if ($usulan['id_mahasiswa'] == $id_mahasiswa) {
                                    $usulanExists = true;
                                    break;
                                }
                            }

                            if (!$usulanExists) {
                                echo '<a href="/mahasiswa/usulan/add" class="btn btn-primary">Tambah Data</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
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
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <th>No</th>
                                <th>Data Pengusul</th>
                                <th>Proposal</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($dataUsulan as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>
                                            <span>Nama : </span><?= $row['nama'] ?><br>
                                            <span>Id Belmawa : </span><?= $row['id_belmawa'] ?>
                                        </td>
                                        <td>
                                            <?php if (empty($row['proposal'])) : ?>
                                                <span class="badge bg-danger">Belum Upload</span>
                                            <?php else : ?>
                                                <a href="<?= base_url('assets/file/proposal/' . $row['proposal']) ?>" class="btn btn-info btn-sm" target="_blank" download="<?= $row['proposal'] ?>">Unduh Proposal</a> <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $row['id_usulan']; ?>')">Delete</a>
                                                <a class="btn btn-primary btn-sm" href="/mahasiswa/usulan/update/<?= $row['id_usulan'] ?>">Update</a>
                                                <a class="btn btn-warning btn-sm" href="/mahasiswa/usulan/detail/<?= $row['id_usulan'] ?>">Detail</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(usulanId) {
        if (confirm("Apakah Anda yakin ingin menghapus mahasiswa dengan ID ")) {
            window.location.href = "/mahasiswa/usulan/delete/" + usulanId;
        }
    }
</script>


<?= $this->endSection() ?>