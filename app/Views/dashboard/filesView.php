<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('modal') ?>
<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="dataf" class="needs-validation">
                    <div class="form-group">
                        <label for="files">Pick Files</label>
                        <input id="upload" type="file" class="form-control-file" name="upload" tabindex="2" required>
                        <div class="invalid-feedback">
                            Memerlukan data file
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi File</label>
                        <input id="desc" type="text" class="form-control" name="desc" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Data deskripsi tidak boleh kosong
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="batal" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                        <button type="button" id="save" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modal-del" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="userid">
                <div class="content">
                    <p>
                        Are you sure to delete this files?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="delete" type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-Sign -->
<div class="modal fade" id="modal-prev" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul">Tanda Tangan Dokumen</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formcanva" method="post">
                    <input type="hidden" id="ids">
                    <input type="hidden" id="namaf">
                    <div class="row">
                        <div id="frame" class="col-8">
                            <button type="button" class="btn btn-info" id="prev" onclick="goPrevious()"><i class="fas fa-arrow-left pr-1"></i>Prev</button>
                            &nbsp;
                            <span>Page: <input onkeyup="goToPage()" type="text" id="page_num" style="width: 25px; text-align: center;"> / <span id="page_count"></span></span>
                            <button type="button" class="btn btn-info" style="margin-left: 10px;" id="next" onclick="goNext()">Next<i class="fas fa-arrow-right pl-1"></i></button>
                            <div title="Drop Signature" id="dropped" class="btn btn-outline-danger float-right"><i id="icons" class="fas fa-trash"></i></div>
                            <div class="float-right" style="margin-right: 10px; position: relative; border-right: 1px solid grey;">
                                <button type="button" class="btn btn-secondary float-right" style="margin-right: 10px;" title="Unduh Dokumen" id="unduh"><i class="fas fa-download"></i></button>
                                <button type="button" class="btn btn-secondary float-right" style="margin-right: 5px;" title="Print" id="print"><i class="fas fa-print"></i></button>
                            </div>
                            <br>
                            <br>
                            <div class="col" id="holder">
                                <div id="wrapper">
                                </div>
                            </div>
                        </div>
                        <div id="signframe" class="col-4 mt-3">
                            <div class="row">
                                <b>Make a Digital Signature</b>
                            </div>
                            <br>
                            <div class="row-2 mt-auto">
                                <button type="button" id="addsign" style="width: 100%; height: 50px;" class="btn btn-primary"><i class="fas fa-pen mr-3"></i><b>Buat Tanda Tangan</b></button>
                                <div class="mt-2">
                                    <div id="signature-frame" class="border border-success">
                                        <img draggable="true" src="" class="draggable" id="signature-result" />
                                    </div>
                                </div>
                                <canvas class="border-secondary mt-2" id="signcanva">

                                </canvas>
                            </div>
                            <div class="row-2 mt-2">
                                <button id="resetCanva" type="button" style="width: 100%; height: 50px;" class="btn btn-warning"><i class="fas fa-eraser mr-3"></i><b>Bersihkan</b></button>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <button onclick="cancel()" type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancel</button>
                                    <button id="sign" type="button" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Files</h1>
        </div>
        <div class="row mt-2">
            <div class="col">
                <input type="hidden" id="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <!-- Button trigger modal -->
                <button type="button" id="plus" class="btn btn-sm btn-round btn-primary mt-auto mb-2 float-right" data-bs-toggle="modal" data-bs-target="#modal-tambah">
                    Tambah Data
                </button>
                <button type="button" id="prints" class="btn btn-primary float-left mr-2">
                    <i class="fas fa-print"></i>
                </button>
                <div class="card mt-5" style="width: 100%;">
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered table-head-fixed" id="dtfile" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Created By</th>
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
<script src="<?= base_url('public/js/proccess.js'); ?>"></script>
<script src="<?= base_url('public/js/drag.js'); ?>"></script>
<script src="https://unpkg.com/trim-canvas-blank@1.0.0/lib/bundle.browser.js"></script>
<script type="text/javascript">
    // GlobalVariable
    var csrfName = '<?= csrf_token() ?>';
    var csrfHash = $('#txt_csrfname').val();

    // DtTable-Load
    var _table = $('#dtfile').DataTable({
        serverSide: true,
        destroy: true,
        ajax: {
            type: 'post',
            url: "<?= base_url('/tbfile') ?>",
            data: function(param) {
                param[csrfName] = csrfHash;
                return param;
            }
        }
    });

    function deleteDt(id) {
        $('#modal-del').modal('show');
        $('#userid').val(id);
    }

    function preview(id, files) {
        signaturePad.on();
        $('#modal-prev').modal('show');
        $('#ids').val(id);
        $('#namaf').val(files);
        var home = $('#namaf').val();
        var links = "<?= base_url('public/file_upload') ?>" + "/" + home;

        renderPDF(links);
    }

    $('#sign').click(function() {
        if ($('#sign').html() == 'Terapkan') {
            if (dragged == true) {
                var id = $('#ids').val(),
                    link = "<?= base_url('files/update') ?>",
                    file = $('#namaf').val(),
                    dtfile = btoa(doc.output());

                let dt = new FormData();
                dt.append('ids', id);
                dt.append('file_name', file);
                dt.append('file_data', dtfile);

                $.ajax({
                    url: link,
                    type: 'post',
                    data: dt,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        setTimeout(() => {
                            _table.ajax.reload();
                        }, 500);
                    }
                });
            } else {
                console.error('Dragged Is False');
            }
        } else if ($('#sign').html() == 'Simpan') {
            $('#sign').html('Terapkan');
        }
    });

    // READY----------------------------------
    $(document).ready(function() {

        $('#modal-prev').on('hidden.bs.modal', function() {
            $('#signcanva').css('display', 'none');
            $('#signature-result').removeData();
        });

        // CRUD-Proccess-------------------------------------------------------------
        $('#batal').click(function() {
            $('#dataf')[0].reset();
        });

        $('#save').click(function() {
            var link = "<?= base_url('files/add') ?>";
            var desc = $('#desc').val();
            var file = $('#upload').prop('files')[0];
            let data = new FormData();
            data.append('type', 1);
            data.append('file_name', file);
            data.append('desc', desc);

            $.ajax({
                url: link,
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function() {
                    $('#modal-tambah').modal('hide');
                    $.notify('Berhasil menambah data', 'success');
                    $('#dataf')[0].reset();
                    setTimeout(() => {
                        _table.ajax.reload();
                    }, 300);
                }
            });
        });

        $('#delete').on('click', function() {
            var id = $('#userid').val();
            var link = "<?= base_url('files/delete') ?>";
            var data = {
                id: id
            }

            $.ajax({
                type: 'post',
                url: link,
                data: data,
                success: function(res) {
                    if (res == 1) {
                        $('#modal-del').modal('hide');
                        $.notify('Data telah dihapus', 'success');
                        setTimeout(() => {
                            _table.ajax.reload();
                        }, 300);
                    }
                }
            });
        });
        // End-CRUD-Proccess---------------------------------------------------------   

        $('#prints').on('click', function() {
            // Generate PDF
            $.ajax({
                url: "<?= base_url('files/print') ?>",
                success: function(dt) {}
            });
        })
    });
</script>
<?= $this->endSection(); ?>