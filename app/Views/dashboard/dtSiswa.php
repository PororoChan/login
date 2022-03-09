<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('modal') ?>
<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="dtsiswa" class="needs-validation">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input id="nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Data nama tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="kelas" type="text" class="form-control" name="kelas" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <input id="usia" type="text" class="form-control" name="usia" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data usia tidak boleh kosong
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="batal" class="btn btn-warning">Batal</button>
                        <button id="simpan" type="buton" class="btn btn-primary">Simpan</button>
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
                        <label for="nama">Nama</label>
                        <input id="edit-nama" type="text" value="" class="form-control" name="nama" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Data nama tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="edit-kelas" type="text" class="form-control" name="kelas" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <input id="edit-usia" type="text" class="form-control" name="usia" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data usia tidak boleh kosong
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
                <button type="button" class="btn btn-primary mt-auto mb-2 float-right" data-bs-toggle="modal" data-bs-target="#modal-add">
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
                        <?php foreach ($siswa as $k) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $k['nama'] ?></td>
                                <td><?= $k['kelas'] ?></td>
                                <td><?= $k['usia'] ?></td>
                                <td>
                                    <button type="button" id="btn-edit" class="btn btn-warning" data-id="<?= $k['id_siswa'] ?>"><i class="fas fa-edit"></i></button>
                                    <button type="button" id="btn-delete" class="btn btn-danger" data-id="<?= $k['id_siswa'] ?>"><i class="fas fa-trash"></i></button>
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

<?= $this->section('javascript') ?>
<script>
    //CRUD-Siswa-Page
    $('#simpan').on('click', function() {

        $('#batal').click(function() {
            $('#dtsiswa')[0].reset();
        });

        var nama = $('#nama').val();
        var kelas = $('#kelas').val();
        var usia = $('#usia').val();

        $.ajax({
            url: '/siswa/add',
            method: 'POST',
            data: {
                type: 1,
                nama: nama,
                kelas: kelas,
                usia: usia,
            },
            success: function() {
                $('#tambahData').modal('hide');
                location.reload();
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success',
                    showConfirmButton: false,
                })
            }
        });
    });

    $(document).on('click', '#btn-edit', function() {
        var ids = $(this).attr('data-id');

        $.ajax({
            url: '/siswa/edit',
            method: 'GET',
            dataType: 'JSON',
            data: {
                id_siswa: ids,
            },
            success: function(data) {
                $('#modal-edit').modal('show');
                $('#edit-nama').val(data.nama);
                $('#edit-kelas').val(data.kelas);
                $('#edit-usia').val(data.usia);
                $('#ids').val(ids);
            }
        });
    });

    $(document).on('click', '#update', function() {
        var nama = $('#edit-nama').val();
        var kelas = $('#edit-kelas').val();
        var usia = $('#edit-usia').val();
        var id = $('#ids').val();

        $.ajax({
            url: '/siswa/update',
            method: 'POST',
            data: {
                nama: nama,
                kelas: kelas,
                usia: usia,
                id_siswa: id,
            },
            success: function() {
                $('#modal-edit').modal('hide');
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil diubah',
                    icon: 'success',
                    showConfirmButton: false,
                })
                location.reload();
            }
        })
    });

    $(document).on('click', '#btn-delete', function() {
        var ids = $(this).attr('data-id');

        Swal.fire({
            title: 'Yakin ingin hapus data?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Data berhasil dihapus.',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                }).then((hapus) => {
                    if (hapus.isConfirmed) {
                        $.ajax({
                            url: '/siswa/delete',
                            method: 'GET',
                            data: {
                                id_siswa: ids,
                            },
                            success: function(data) {
                                location.reload();
                            }
                        })
                    }
                })
            }
        })
    });
</script>
<?= $this->endSection(); ?>