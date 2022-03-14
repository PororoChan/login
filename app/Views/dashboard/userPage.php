<?= $this->extend('/dashboard/layout/template'); ?>
<?= $this->section('modal') ?>
<div class="modal fade" id="modal-upt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="kelas">Username</label>
                        <input id="edit-usern" type="text" class="form-control" name="uname" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data username tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usia">Password</label>
                        <input id="edit-pass" type="text" placeholder="Create new Password" class="form-control" name="pass" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data password tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usia">Confirm Password</label>
                        <input id="confirm" type="text" placeholder="Confirm your new Password" class="form-control" name="confirm" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data password tidak boleh kosong
                        </div>
                    </div>
                    <input type="hidden" name="id" id="ids">
                    <div class="modal-footer">
                        <button type="button" id="batal" class="btn btn-warning">Batal</button>
                        <button id="btn-update" type="button" class="btn btn-primary">Update</button>
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
        <div class="row mt-2">
            <div class="col">
                <h5 class="mt-5">Data Users</h5>
                <br><br>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="datauser">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
    $(document).ready(function() {
        var _table = $('#datauser').DataTable({
            "order": [],
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "filter": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "searching": true,
            "language": {
                "emptyTable": "Tidak ada data tersedia di tabel",
                "zeroRecords": "Data tidak ditemukan",
                "infoEmpty": "Menampilkan 0 dari 0 data",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ total data",
                "infoFiltered": "(dipilih dari _MAX_ data)",
            },
            "ajax": {
                "url": '/Users/data',
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });

        $(document).on('click', '#dt-edit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/users/edit',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    id_user: id,
                },
                success: function(data) {
                    $('#modal-upt').modal('show');
                    $('#edit-nama').val(data.nama);
                    $('#edit-usern').val(data.username);
                    $('#ids').val(id);
                }
            })

        });

        $(document).on('click', '#btn-update', function() {
            var nama = $('#edit-nama').val();
            var uname = $('#edit-usern').val();
            var pass = $('#edit-pass').val();
            var id = $('#ids').val();

            Swal.fire({
                title: 'Yakin ingin ubah data?',
                text: "Data akan diubah!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Data berhasil diubah.',
                        icon: 'success',
                        confirmButtonText: 'Okay'
                    }).then((hapus) => {
                        if (hapus.isConfirmed) {
                            $.ajax({
                                url: '/users/update',
                                method: 'POST',
                                data: {
                                    id_user: id,
                                    nama: nama,
                                    username: uname,
                                    password: pass,
                                },
                                success: function() {
                                    $('#modal-upt').modal('hide');

                                    _table.ajax.reload();
                                }
                            })
                        }
                    })
                }
            })


        })

        $(document).on('click', '#dt-delete', function() {
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
                                url: '/users/delete',
                                method: 'GET',
                                data: {
                                    id_user: ids,
                                },
                                success: function(data) {
                                    _table.ajax.reload();
                                }
                            })
                        }
                    })
                }
            })
        })
    });
</script>
<?= $this->endSection() ?>