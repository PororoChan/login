<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('modal') ?>
<!-- Modal -->
<div class="modal fade" id="modal-kelas-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="dtsiswa" class="needs-validation">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="kelas" type="text" class="form-control" name="kelas" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="batal" class="btn btn-warning">Batal</button>
                        <button id="kelas-add" type="buton" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="ubahsiswa" class="needs-validation">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="edit-kelas" type="text" class="form-control" name="kelas" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                    <input type="hidden" id="idkls">
                    <div class="modal-footer">
                        <button type="button" id="batal" class="btn btn-warning">Batal</button>
                        <button id="update-kelas" type="buton" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<!-- Main-Content -->
<div class="main-content">
    <section class="section">
        <div class="row mt-2">
            <div class="col">
                <h5 class="mt-5">Data Siswa</h5>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mt-auto mb-2 float-right" data-bs-toggle="modal" data-bs-target="#modal-add">
                    Tambah Data
                </button>

                <table class="table" id="datasiswa">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($siswa as $k) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $k['kelas'] ?></td>
                                <td>
                                    <button type="button" id="btn-edit" class="btn btn-warning" data-id="<?= $k['id_kelas'] ?>">Edit</button>
                                    <button type="button" id="btn-delete" class="btn btn-danger" data-id="<?= $k['id_kelas'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>