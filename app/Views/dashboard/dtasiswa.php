<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('modal') ?>
<!-- Modal Add-->
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

<!-- Modal Edit -->
<div class="modal fade" id="dt-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="edit-siswa" class="needs-validation">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input id="edit-dt-nama" type="text" value="" class="form-control" name="edit-nama" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Data nama tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="edit-dt-kelas" type="text" class="form-control" name="edit-kelas" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data kelas tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <input id="edit-dt-usia" type="text" class="form-control" name="edit-usia" tabindex="2" required>
                        <div class="invalid-feedback">
                            Data usia tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="files">Foto Profil</label>
                        <input id="edit-dt-file" type="file" class="form-control-file" name="edit-gambar" tabindex="2">
                        <div class="invalid-feedback">
                            Memerlukan data foto
                        </div>
                    </div>
                    <input type="hidden" id="edit-ids">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning">Batal</button>
                        <button id="dt-update" type="button" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail View -->
<div class="modal fade" id="modal-view" tabindex="2" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menampilkan Data Siswa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card h-220 w-45 align-items-center">
                            <img id="id-gambar" class="img-fluid" src="" height="200" width="135">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <p><b>Nama : &nbsp;</b></p>
                            <p id="id-nama"></p>
                        </div>
                        <div class="row">
                            <p><b>Kelas : &nbsp;</b></p>
                            <p id="id-kelas"></p>
                        </div>
                        <div class="row">
                            <p><b>Usia : &nbsp;</b></p>
                            <p id="id-usia"></p>
                            <input type="hidden" id="idn">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="width: 45px; height: 45px;" id="exp-excel" title="Save as Excel" class="btn btn-success float-right"><i class="fas fa-file-excel"></i></button>
                    <button style="width: 45px; height: 45px;" id="exp-pdf" title="Save as PDF" class="btn btn-danger float-right"><i class="fas fa-file-pdf"></i></button>
                </div>
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

                <table class="table" id="dtsiswa" width="100%">
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

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('javascript') ?>
<script type="text/javascript">
    $(document).ready(function() {
        let data = {};
        var _dtTable = $('#dtsiswa').DataTable({
            "order": [],
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "info": true,
            "pageLength": 5,
            "search": {
                "caseInsensitive": false,
            },
            "language": {
                "emptyTable": "Tidak ada data tersedia di tabel",
                "zeroRecords": "Data tidak ditemukan",
                "infoEmpty": "Menampilkan 0 dari 0 data",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ total data",
                "infoFiltered": "(dipilih dari _TOTAL_ data)",
                "processing": "Diproses...",
            },
            "ajax": {
                "url": "/dtsiswa/view",
                "type": "POST",
                "data": function(d) {
                    d = data;
                }
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });

        $('#bataldt').click(function() {
            $('#datasis')[0].reset();
        })

        //CRUD-Siswa-Adv
        $('#simpandt').on('click', function() {
            var img = $('#inputfile').prop('files')[0];
            let data = new FormData();
            data.append('type', 1);
            data.append('nama', $('#names').val());
            data.append('kelas', $('#pilihkelas').val());
            data.append('usia', $('#ages').val());
            data.append('gambar', img);

            $.ajax({
                url: '/dtsiswa/add',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function() {
                    $('#datasis')[0].reset();
                    $('#modal-add-siswa').modal('hide');
                    Swal.fire({
                        title: 'Success',
                        text: 'Data berhasil ditambahkan',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    _dtTable.ajax.reload();
                }
            });
        });

        $(document).on('click', '#dt-view', function() {
            var ids = $(this).attr('data-id');

            $("#modal-view").modal('show');

            $.ajax({
                url: '/dtsiswa/details',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    id_data: ids,
                },
                success: function(data) {
                    var img = data.gambar;

                    $('#id-nama').text(data.nama);
                    $('#id-kelas').text(data.kelas);
                    $('#id-usia').text(data.usia);
                    $('#idn').val(ids)
                    $('#id-gambar').attr('src', 'images/' + img);
                }
            })
        })

        $(document).on('click', '#dt-edit', function() {
            var ids = $(this).attr('data-id');

            $.ajax({
                url: '/dtsiswa/edit',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    id_data: ids,
                },
                success: function(data) {
                    $('#dt-edit').modal('show');
                    $('#edit-dt-nama').val(data.nama);
                    $('#edit-dt-kelas').val(data.kelas);
                    $('#edit-dt-usia').val(data.usia);
                    $('#edit-ids').val(ids);
                }
            });
        });

        $(document).on('click', '#dt-update', function() {
            let data = new FormData();

            var id = $('#edit-ids').val();
            var nama = $('#edit-dt-nama').val();
            var kelas = $('#edit-dt-kelas').val();
            var usia = $('#edit-dt-usia').val();
            var files = $('#edit-dt-file').prop('files')[0];

            data.append('id_data', id);
            data.append('nama', nama);
            data.append('kelas', kelas);
            data.append('usia', usia);
            data.append('gambar', files);

            $.ajax({
                url: '/dtsiswa/update',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function() {
                    Swal.fire({
                        title: 'Success',
                        text: 'Data berhasil diubah',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    $('#dt-edit').modal('hide');
                    $('#edit-siswa')[0].reset();
                    _dtTable.ajax.reload();
                }
            })
        });

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
                                url: '/dtsiswa/delete',
                                method: 'GET',
                                data: {
                                    id_data: ids,
                                },
                            })
                            _dtTable.ajax.reload();
                        }
                    })
                }
            })
        });

        $(document).on('click', '#exp-excel', function() {
            var id = $('#idn').val();

            $.ajax({
                url: '/dtsiswa/expExcel',
                method: "POST",
                data: {
                    id_data: id,
                },
                success: function() {
                    $('#modal-view').modal('hide');
                    Swal.fire({
                        title: 'Success',
                        text: 'File telah di unduh',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                }
            })
        });
    })
</script>
<?= $this->endSection(); ?>