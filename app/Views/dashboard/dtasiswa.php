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
                        <select class="form-control" name="edit-kelas" id="edit-dt-kelas">
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
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
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
                    <a style="padding: 10px; width: 45px; height: 45px;" id="exp-excel" title="Save as Excel" href="<?= base_url('/dtsiswa/excel') ?>" class="btn btn-warning"><i class="fas fa-file-excel"></i></a>
                    <a style="padding: 10px; width: 45px; height: 45px;" id="exp-pdf" title="Save as PDF" href="<?= base_url('/dtsiswa/pdf') ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
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
        <div class="section-header">
            <h1>Data Siswa Advanced</h1>
        </div>
        <div class="row mt-2">
            <div class="col">
                <input type="hidden" id="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mt-auto mb-2 float-right" data-bs-toggle="modal" data-bs-target="#modal-add-siswa">
                    Tambah Data
                </button>
                <div class="card mt-5" style="width: 100%;">
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped table-head-fixed" id="dtsiswa" width="100%">
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
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('javascript') ?>
<script type="text/javascript">
    $(document).ready(function() {
        let data = {};
        let _dtTable = $('#dtsiswa').DataTable({
            "responsive": true,
            "processing": false,
            "serverSide": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "language": {
                "emptyTable": "Tidak ada data tersedia di tabel",
                "zeroRecords": "Data tidak ditemukan",
                "infoEmpty": "Menampilkan 0 dari 0 data",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ total data",
                "infoFiltered": "(dipilih dari _MAX_ data)",
            },
            "order": [],
            "ajax": {
                "url": "<?= base_url('/dtsiswa/view') ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": true,
            }, ],
        });

        $('.search').on('keyup', function() {
            data.search = $(this).val();
            if (data.search == "") {
                delete data.search;
            }

            _dtTable.draw();
        })

        $('#bataldt').click(function() {
            $('#datasis')[0].reset();
        });


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
                url: '<?= base_url('/dtsiswa/add') ?>',
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
                url: '<?= base_url('/dtsiswa/details') ?>',
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
                    $('#id-gambar').attr('src', 'public/images/' + img);
                }
            })
        })

        $(document).on('click', '#dt-edit', function() {
            var ids = $(this).attr('data-id');

            $.ajax({
                url: '<?= base_url('/dtsiswa/edit') ?>',
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
                url: '<?= base_url('/dtsiswa/update') ?>',
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
                                url: '<?= base_url('/dtsiswa/delete') ?>',
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

        $('#exp-excel').click(function() {
            $.ajax({
                url: '<?= base_url('/dtsiswa/excel') ?>',
                type: 'POST',
                data: {},
                success: function() {
                    $('#modal-view').modal('hide');
                    Swal.fire({
                        title: 'Download',
                        text: 'Berhasil download',
                        icon: 'success',
                        timer: 1500,
                    })
                }
            });
        });

        $('#exp-pdf').click(function() {
            $.ajax({
                url: '<?= base_url('/dtsiswa/pdf') ?>',
            })
        })
    })
</script>
<?= $this->endSection(); ?>