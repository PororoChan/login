<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('modal') ?>
<!-- Modal -->
<div class="modal fade" id="tambahKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="kelasdt" class="needs-validation">
                    <div class="form-group">
                        <label for="class">Kelas</label>
                        <input id="kelas" type="text" class="form-control" name="kelas" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="kelas-batal" type="button" class="btn btn-warning">Batal</button>
                <button id="kelas-add" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit-kelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kelas</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="ubahkelas" class="needs-validation">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="editKelas" type="text" class="form-control" name="kelas" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                    <input type="hidden" id="id_kelas">
                    <div class="modal-footer">
                        <button id="batall" class="btn btn-warning">Batal</button>
                        <button id="updateKelas" type="button" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Main-Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Kelas</h1>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button class="btn btn-primary mt-auto mb-2 float-right" data-bs-toggle="modal" data-bs-target="#tambahKelas">
                    Tambah Kelas
                </button>
                <div class="card mt-5">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="datasiswa">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kelas as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['kelas'] ?></td>
                                        <td>
                                            <button id="btn-edit-kelas" class="btn btn-warning" data-id="<?= $k['id_kelas'] ?>"><i class="fas fa-edit"></i></button>
                                            <button id="btn-delete-kelas" class="btn btn-danger" data-id="<?= $k['id_kelas'] ?>"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('javascript') ?>
<script>
    //CRUD-Kelas-Page
    $('#kelas-add').on('click', function() {

        $('#kelas-batal').click(function() {
            $('#kelasdt')[0].reset();
        });

        var kelas = $('#kelas').val();

        $.ajax({
            url: '<?= base_url('/kelas/add') ?>',
            method: 'POST',
            data: {
                type: 1,
                kelas: kelas,
            },
            success: function() {
                $('#tambahKelas').modal('hide');
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

    $(document).on('click', '#btn-edit-kelas', function() {
        var ids = $(this).attr('data-id');

        $.ajax({
            url: '<?= base_url('/kelas/edit') ?>',
            method: 'GET',
            dataType: 'JSON',
            data: {
                id_kelas: ids,
            },
            success: function(data) {
                $('#modal-edit-kelas').modal('show');
                $('#editKelas').val(data.kelas);
                $('#id_kelas').val(ids);
            }
        });
    });

    $(document).on('click', '#updateKelas', function() {
        var kelas = $('#editKelas').val();
        var id = $('#id_kelas').val();

        $.ajax({
            url: '<?= base_url('/kelas/update') ?>',
            method: 'POST',
            data: {
                kelas: kelas,
                id_kelas: id,
            },
            success: function() {
                $('#modal-edit-kelas').modal('hide');
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

    $(document).on('click', '#btn-delete-kelas', function() {
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
                            url: '<?= base_url('/kelas/delete') ?>',
                            method: 'GET',
                            data: {
                                id_kelas: ids,
                            },
                        })
                        location.reload();
                    }
                })
            } else {
                location.reload
            }
        })
    });
</script>
<?= $this->endSection(); ?>