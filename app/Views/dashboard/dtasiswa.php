<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('modal') ?>
<!-- Modal -->
<div class="modal fade" id="modal-add-siswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="datasis" class="needs-validation">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input id="names" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Data nama tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelast" id="pilihkelas">
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($dtkelas as $dtk) : ?>
                                <option value="<?= $dtk['kelas'] ?>"><?= $dtk['kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <input id="ages" type="text" class="form-control" name="usia" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data usia tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="files">Foto Profil</label>
                        <input id="inputfile" type="file" class="form-control-file" name="files" tabindex="2" required>
                        <div class="invalid-feedback">
                            Memerlukan data foto
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="bataldt" class="btn btn-warning">Batal</button>
                        <button type="button" id="simpandt" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dt-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="ubahsiswa" class="needs-validation">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input id="dt-nama" type="text" value="" class="form-control" name="nama" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Data nama tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="dt-kelas" type="text" class="form-control" name="kelas" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <input id="dt-usia" type="text" class="form-control" name="usia" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data usia tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="files">Foto Profil</label>
                        <input id="dt-file" type="file" class="form-control-file" name="files" tabindex="2" required>
                        <div class="invalid-feedback">
                            Memerlukan data foto
                        </div>
                    </div>
                    <input type="hidden" id="ids">
                    <div class="modal-footer">
                        <button type="button" id="batal" class="btn btn-warning">Batal</button>
                        <button id="update" type="buton" class="btn btn-primary">Update</button>
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
                <button type="button" class="btn btn-primary mt-auto mb-2 float-right" data-bs-toggle="modal" data-bs-target="#modal-add-siswa">
                    Tambah Data
                </button>

                <table class="table" id="datasiswa">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Usia</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($dtsiswa as $k) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $k['nama'] ?></td>
                                <td><?= $k['kelas'] ?></td>
                                <td><?= $k['usia'] ?></td>
                                <td>
                                    <button type="button" id="dt-edit" class="btn btn-warning" data-id="<?= $k['id_data'] ?>">Edit</button>
                                    <button type="button" id="dt-delete" class="btn btn-danger" data-id="<?= $k['id_data'] ?>">Delete</button>
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