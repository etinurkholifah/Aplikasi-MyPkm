<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Data Akun Akademik</h2>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="/admin/akademik/add" class="btn btn-primary">Tambah Data</a>
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
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>email</th>
                                <th>username</th>
                                <th>role</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($dataAkademik as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><img src="/assets/images/akademik/<?= $row['foto'] ?>" alt="" srcset="" width="100"></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td>
                                            <?php
                                            $role = $row['role'];
                                            $badgeClass = '';

                                            if ($role == 'WADIR') {
                                                $badgeClass = 'badge rounded-pill bg-primary';
                                            } elseif ($role == 'KABAG') {
                                                $badgeClass = 'badge rounded-pill bg-danger';
                                            } elseif ($role == 'KASUBAG') {
                                                $badgeClass = 'badge rounded-pill bg-success';
                                            }

                                            echo '<span class="' . $badgeClass . '">' . $role . '</span>';
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="/admin/akademik/edit/<?= $row['id_akademik'] ?>" class="btn btn-primary">Edit</a>
                                                <a class="btn btn-danger" onclick="confirmDelete('<?= $row['id_akademik']; ?>')">Delete</a>
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
    function confirmDelete(adminId) {
        if (confirm("Apakah Anda yakin ingin menghapus admin dengan ID ")) {
            window.location.href = "/admin/akademik/delete/" + adminId;
        }
    }
</script>


<?= $this->endSection() ?>