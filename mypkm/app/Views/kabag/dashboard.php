<?= $this->extend('kabag/layout') ?>
<?= $this->section('content') ?>

<style>
    .border-red {
        border: 2px solid red;
    }

    .border-green {
        border: 2px solid green;
    }
</style>


<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2> Selamat datang <?= session('user')['nama'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-red">
                <div class="card-body">
                    <h4>Mahasiswa yang Belum Upload</h4>
                    <p><?= $DokumenBelum ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-green">
                <div class="card-body">
                    <h4>Mahasiswa yang sudah Upload</h4>
                    <p><?= $DokumenSudah ?></p>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>