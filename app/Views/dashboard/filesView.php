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
                        <button type="button" id="batal" class="btn btn-warning">Batal</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formcanva">
                    <input type="hidden" id="ids">
                    <input type="hidden" id="namaf">
                    <div class="row">
                        <div id="frame" class="col">
                            <button type="button" class="btn btn-info" id="prev" onclick="goPrevious()">Prev</button>
                            <button type="button" class="btn btn-info" id="next" onclick="goNext()">Next</button>
                            &nbsp;
                            <span>Page: <input onkeyup="goToPage()" type="text" id="page_num" style="width: 25px; text-align: center;"> / <span id="page_count"></span></span>
                            <br>
                            <br>
                            <canvas class="col" id="render">

                            </canvas>
                        </div>
                        <div id="signframe" class="col-4">
                            <div class="row">
                                <b>Make a Digital Signature</b>
                            </div>
                            <br>
                            <div class="row-2 mt-2">
                                <button type="button" id="addsign" style="width: 100%; height: 50px;" class="btn btn-primary"><b>Buat Tanda Tangan</b></button>
                                <div class="mt-2">
                                    <div id="signature-frame" class="border border-success">
                                        <img draggable="true" src="" class="draggable" id="signature-result" />
                                    </div>
                                    <canvas class="border-secondary mt-2" id="signcanva">

                                    </canvas>
                                </div>
                            </div>
                            <div class="row-2 mt-2">
                                <button id="resetCanva" type="button" style="width: 100%; height: 50px;" class="btn btn-warning"><b>Bersihkan</b></button>
                            </div>
                            <div class="modal-footer">
                                <button onclick="cancel()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button id="sign" type="button" class="btn btn-primary">Simpan</button>
                            </div>
                            <label id="size"></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Sign 2 -->
<div class="modal fade" id="modal-sign" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tanda Tangan Digital</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <input type="hidden" id="idf">
            <input type="hidden" id="nmfile">
            <div class="modal-body">
                <div class="row">
                    <div id="load-pdf" style="width: 1024px; height: 600px;" class="col-9 mt-1">
                        <!-- <div id="rendering">
                            <canvas id="load-pdf" style="width: 100%; height: 100%;">

                            </canvas>
                        </div> -->
                    </div>
                    <div class="col-3 mt-1" id="sidebar-modal">
                        <div class="col mt-2">
                            <button id="btn-buat" class="btn btn-outline-warning"><i class="fas fa-signature mr-3"></i>Tambah Tanda Tangan</button>
                        </div>
                        <div class="col mt-2">
                            <button class="btn btn-primary float-bottom" id="btn-unduh">Simpan & Unduh</button>
                        </div>
                    </div>
                </div>
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
                <button type="button" class="btn btn-primary mt-auto mb-2 float-right" data-bs-toggle="modal" data-bs-target="#modal-tambah">
                    Tambah Data
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

    function lihat(id, files) {
        $('#modal-sign').modal('show');
        $('#idf').val(id);
        $('#nmfile').val(files);

        var file = $('#nmfile').val();
        var link = "<?= base_url('file_upload') ?>" + "/" + file;

        WebViewer({
                path: 'Webviewer/lib',
                initialDoc: link,
            }, document.getElementById('load-pdf'))
            .then(instance => {
                const {
                    documentViewer
                } = instance.Core;

                documentViewer.addEventListener('documentLoaded', () => {

                });
            })
    }

    function deleteDt(id) {
        $('#modal-del').modal('show');
        $('#userid').val(id);
    }

    function preview(id, files) {
        $('#modal-prev').modal('show');
        $('#ids').val(id);
        $('#namaf').val(files);
        var home = $('#namaf').val();

        var link = "<?= base_url('file_upload') ?>" + "/" + home;
        renderPDF(link);
    }

    // READY----------------------------------
    $(document).ready(function() {

        $('#modal-prev').on('hidden.bs.modal', function() {
            $('#signcanva').css('display', 'none');
        });
        // End-Signature-------------------------------------------------------------

        // CRUD-Proccess-------------------------------------------------------------
        $('#batal').click(function() {
            $('#dataf')[0].reset();
        });

        $('#save').click(function() {
            var desc = $('#desc').val();
            var file = $('#upload').prop('files')[0];
            let data = new FormData();
            data.append('type', 1);
            data.append('file_name', file);
            data.append('desc', desc);

            $.ajax({
                url: 'files/add',
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
                success: function(response) {
                    if (response == 1) {
                        $('#modal-del').modal('hide');
                        $.notify('Data telah dihapus', 'success');
                        setTimeout(() => {
                            _table.ajax.reload();
                        }, 300);
                    }
                }
            })
        });
        // End-CRUD-Proccess---------------------------------------------------------   
    });
</script>
<?= $this->endSection(); ?>