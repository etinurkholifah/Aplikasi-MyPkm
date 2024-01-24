<?= $this->extend('kabag/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Data Laporan</h2>
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
                        <table class="table" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Laporan</th>
                                    <th>Validasi Kabag</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($dataLaporan as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['tanggal'] ?></td>
                                        <td>
                                            <a href="<?= base_url('assets/file/laporan/' . $row['laporan']) ?>" class="btn btn-info btn-sm" target="_blank" download="<?= $row['laporan'] ?>">Unduh Laporan</a>
                                        </td>
                                        <td>
                                            <span class="badge <?= ($row['val_kabag'] == 'Sudah') ? 'bg-success' : 'bg-danger' ?>"><?= $row['val_kabag'] ?></span>
                                        </td>
                                        <td>
                                            <?php if ($row['val_kabag'] == 'Sudah') : ?>
                                                <a class="btn btn-danger btn-sm" href="/kabag/laporan/batalValidasi/<?= $row['id_laporan'] ?>">Batalkan Validasi</a>
                                            <?php else : ?>
                                                <a class="btn btn-primary btn-sm" href="/kabag/laporan/validasi/<?= $row['id_laporan'] ?>">Validasi</a>
                                            <?php endif; ?>
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

<?= $this->endSection() ?>