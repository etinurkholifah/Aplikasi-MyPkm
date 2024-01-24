<?= $this->extend('wadir/layout') ?>
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
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table" width="100%">
                            <thead>
                                <th>No</th>
                                <th>Pengusul</th>
                                <th>Id Belmawa</th>
                                <th>Proposal</th>
                                <th width="20%">Action</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($dataUsulan as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['id_belmawa'] ?></td>
                                        <td>
                                            <?php if (empty($row['proposal'])) : ?>
                                                <span class="badge bg-danger">Belum Upload</span>
                                            <?php else : ?>
                                                <a href="<?= base_url('assets/file/proposal/' . $row['proposal']) ?>" class="btn btn-info btn-sm" target="_blank" download="<?= $row['proposal'] ?>">Unduh Proposal</a> <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="/wadir/usulan/detail/<?= $row['id_usulan'] ?>">Detail</a>
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