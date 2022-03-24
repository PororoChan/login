<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('modal') ?>
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
<div class="modal fade" id="modal-prev" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formcanva">
                    <input type="hidden" id="ids">
                    <div class="row">
                        <div id="frame" class="col-8">
                            <button type="button" class="btn btn-info" id="prev" onclick="goPrevious()">Prev</button>
                            <button type="button" class="btn btn-info" id="next" onclick="goNext()">Next</button>
                            <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                            <br>
                            <br>
                            &nbsp;
                            <canvas class="col-10 border border-secondary" id="render">

                            </canvas>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <b>Make a Digital Signature</b>
                            </div>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="cancel" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button id="sign" type="button" class="btn btn-primary">Simpan</button>
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
        <div class="row mt-2">
            <div class="col">
                <h5 class="mt-5">Data Files</h5>
                <input type="hidden" id="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mt-auto mb-2 float-right" data-bs-toggle="modal" data-bs-target="#modal-tambah">
                    Tambah Data
                </button>
                <div class="card mt-5" style="width: 100%;">
                    <div class="card-body">
                        <table class="table table-bordered" id="dtfile" width="100%">
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
    var canvas = document.getElementById('signcanva');
    var signaturePad = new SignaturePad(canvas, {
        minWidth: 1,
        maxWidth: 2,
        penColor: "rgb(25, 25, 25)"
    });

    // DtTable-Load
    var _table = $('#dtfile').DataTable({
        serverSide: true,
        destroy: true,
        ajax: {
            type: 'post',
            url: '<?= base_url('/tbfile') ?>',
            data: function(param) {
                param[csrfName] = csrfHash;
                return param;
            }
        }
    });

    // RenderPDF
    var pdfDoc = null;
    var pageNum;
    var ctx;

    window.onload = function() {
        var url = 'file_upload/contoh.pdf';
        renderPDF(url);
    }

    function renderPDF(url) {
        pdfDoc = null;
        pageNum = 1;
        scale = 1.5;
        canvas = document.getElementById('render');
        ctx = canvas.getContext('2d');
        pdfjsLib.disableWorker = true;
        pdfjsLib.getDocument(url).then(function getPdf(_pdfDoc) {
            pdfDoc = _pdfDoc;
            renderPage(pageNum);
        })
    }

    pdfjsLib.disableWorker = true;

    function renderPage(num) {
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport(scale);
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            page.render(renderContext);
        });

        document.getElementById('page_num').textContent = pageNum;
        document.getElementById('page_count').textContent = pdfDoc.numPages;
    }

    function goPrevious() {
        if (pageNum <= 1)
            return;
        pageNum--;
        renderPage(pageNum);
    }

    function goNext() {
        if (pageNum >= pdfDoc.numPages)
            return;
        pageNum++;
        renderPage(pageNum);
    }

    function deleteDt(id) {
        $('#modal-del').modal('show');
        $('#userid').val(id);
    }

    function preview(id) {
        $('#modal-prev').modal('show');
        $('#ids').val(id);
    }

    // READY----------------------------------
    $(document).ready(function() {

        // Signature-Pad------------------------------------------------------------
        $('#addsign').click(function() {
            var canva = $('#signcanva').css('display');

            if (canva == 'none') {
                $('#signcanva').css('display', 'block');

            } else if (canva == 'block') {
                $('#signcanva').css('display', 'none');
                signaturePad.clear();
            }
        });

        $('#resetCanva').click(function() {
            signaturePad.clear();
        });

        $('#cancel').click(function() {
            $('#signcanva').css('display', 'none');
            $('#signature-result').css('display', 'none');
            signaturePad.clear();
        });

        $('#sign').click(function() {
            var signature = signaturePad.toDataURL('image/png');
            $('#signature-result').css('display', 'block');
            $('#signature-result').attr('src', signature);
            $('#signcanva').css('display', 'none');
            $('#signature-frame').css('display', 'flex');
            $('#sign').html('Terapkan');
            signaturePad.clear();
        });

        $('#modal-prev').on('hidden.bs.modal', function() {
            $('#signcanva').css('display', 'none');
        });
        // End-Signature-------------------------------------------------------------

        // CRUD-Proccess-------------------------------------------------------------
        $('#batal').click(function() {
            $('#dataf')[0].reset();
        });

        $('#save').click(function() {
            var pub = $('#person').val();
            var file = $('#upload').prop('files')[0];
            let data = new FormData();
            data.append('type', 1);
            data.append('file_name', file);
            data.append('desc', $('#desc').val());

            $.ajax({
                url: '/files/add',
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function() {
                    $('#modal-tambah').modal('hide');
                    $('#dataf')[0].reset();
                    _table.ajax.reload();
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
                        }, 500);
                        console.log(response);
                    }
                }
            })
        });
        // End-CRUD-Proccess---------------------------------------------------------

    });
</script>
<?= $this->endSection(); ?>