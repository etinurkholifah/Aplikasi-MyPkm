<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Data Mahasiswa</h2>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="/admin/mahasiswa/add" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label" for="">Filter Berdasarkan Semester</label>
                            <select class="form-control" name="semester" id="semester">
                                <option value="">Semester</option>
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="">Filter Berdasarkan sudah upload dokumen apa belum</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">status</option>
                                <option value="sudah">Sudah</option>
                                <option value="belum">Belum</option>
                            </select>
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
                    <div class="table-responsive">
                        <table class="table" id="table" width="100%">
                            <thead>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>No Handphone</th>
                                <th>Tanggal Lahir</th>
                                <th>semester</th>
                                <th>Program Studi</th>
                                <th width="10%">Dokumen</th>
                                <th>Status Akun</th>
                                <th width="25%">Action</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($dataMahasiswa as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['npm'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['no_hp'] ?></td>
                                        <td><?= $row['tgl_lahir'] ?></td>
                                        <td><?= $row['semester'] ?></td>
                                        <td><?= $row['prodi'] ?></td>
                                        <td>
                                            <span class="badge <?= ($row['dokumen'] == 'belum') ? 'bg-danger' : 'bg-success' ?>"><?= $row['dokumen'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge <?= ($row['status_akun'] == 'nonaktif') ? 'bg-danger' : 'bg-success' ?>"><?= $row['status_akun'] ?></span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="/admin/mahasiswa/edit/<?= $row['id_mahasiswa'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $row['id_mahasiswa']; ?>')">Delete</a>
                                                <?php if ($row['status_akun'] === 'aktif') : ?>
                                                    <a class="btn btn-primary btn-sm" href="/admin/mahasiswa/deactivateAccount/<?= $row['id_mahasiswa'] ?>">Nonaktifkan Akun</a>
                                                <?php else : ?>
                                                    <a class="btn btn-warning btn-sm" href="/admin/mahasiswa/activateAccount/<?= $row['id_mahasiswa'] ?>">Aktifkan Akun</a>
                                                <?php endif; ?>
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
    $(document).ready(function() {
        $('select').on('change', function() {
            var semester = $('#semester').val();
            var status = $('#status').val();

            $.ajax({
                type: 'POST',
                url: '/admin/mahasiswa/filterData',
                data: {
                    semester: semester,
                    status: status
                },
                success: function(response) {
                    var table = '<thead><tr><th>No</th><th>NPM</th><th>Nama</th><th>No Handphone</th><th>Tanggal Lahir</th><th>Semester</th><th>Program Studi</th><th width="10%">Dokumen</th><th>Status Akun</th><th width="25%">Action</th></tr></thead><tbody>';
                    $.each(response, function(index, row) {
                        table += '<tr>';
                        table += '<td>' + (index + 1) + '</td>';
                        table += '<td>' + row.npm + '</td>';
                        table += '<td>' + row.nama + '</td>';
                        table += '<td>' + row.no_hp + '</td>';
                        table += '<td>' + row.tgl_lahir + '</td>';
                        table += '<td>' + row.semester + '</td>';
                        table += '<td>' + row.prodi + '</td>';
                        table += '<td><span class="badge ' + (row.dokumen == 'belum' ? 'bg-danger' : 'bg-success') + '">' + row.dokumen + '</span></td>';
                        table += '<td><span class="badge ' + (row.status_akun == 'nonaktif' ? 'bg-danger' : 'bg-success') + '">' + row.status_akun + '</span></td>';
                        table += '<td><div class="btn-group">';
                        table += '<a href="/admin/mahasiswa/edit/' + row.id_mahasiswa + '" class="btn btn-primary btn-sm">Edit</a>';
                        table += '<a class="btn btn-danger btn-sm" onclick="confirmDelete(' + row.id_mahasiswa + ')">Delete</a>';
                        if (row.status_akun === 'aktif') {
                            table += '<a class="btn btn-primary btn-sm" href="/admin/mahasiswa/deactivateAccount/' + row.id_mahasiswa + '">Nonaktifkan Akun</a>';
                        } else {
                            table += '<a class="btn btn-warning btn-sm" href="/admin/mahasiswa/activateAccount/' + row.id_mahasiswa + '">Aktifkan Akun</a>';
                        }
                        table += '</div></td>';
                        table += '</tr>';
                    });
                    table += '</tbody>';
                    $('#table').html(table);
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat data.');
                }
            });
        });
    });


    function confirmDelete(mahasiswaId) {
        if (confirm("Apakah Anda yakin ingin menghapus mahasiswa dengan ID ")) {
            window.location.href = "/admin/mahasiswa/delete/" + mahasiswaId;
        }
    }
</script>


<?= $this->endSection() ?>