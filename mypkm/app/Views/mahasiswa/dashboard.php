<?= $this->extend('mahasiswa/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
    <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h2> Selamat datang <?= session('user')['nama']?></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 2: Informasi -->
    <div class="row mt-4">
        <div class="col-md-7 offset-md-3">
            <style>
    .alert p {
        margin-bottom: 10px;
        text-align: left; 
    }
            </style>
            <div class="alert alert-info" role="alert">
                <h3> Informasi </h3>
                <p>&bull; Diharapkan untuk mengupdate profil di menu profil untuk memastikan informasi terkini.</p>
                <p>&bull; Pastikan email yang Anda masukkan di bagian profil adalah email aktif.</p>
                <p>&bull; Petunjuk Penulisan Proposal silakan akses di menu Buku Panduan.</p>
            </div>
            </div>
        </div>
    </div>
    
    <?= $this->endSection() ?>