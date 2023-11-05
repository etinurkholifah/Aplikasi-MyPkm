<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ; ?></h1>

<div class="card">
    <div class="card-body">
            <!-- Button triger modal -->
            <button type ="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambah">
            <i class="fa fa-plus"> Tambah Data </>
            </button>
    <div class="card">
        <div class="card-body">

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Npm</th>
                <th>Semester</th>
            </tr>
        </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($mahasiswa as $row) : ?>
            <tr>
                <td scops="row"><?=$i; ?></td>
                <td><?=$row['nama']; ?></td>
                <td><?=$row['npm'];?></td>
                <td><?=$row['semester'];?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach ; ?>
            </tbody>
    </table>
</div>


<!--Modal-->
<div class="modal fade" id="modalTambah"
aria-hidden="true">
<div class="Modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Body 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
                </div>
                </div>
