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
    var can = document.getElementById('render');
    var canvas = document.getElementById('signcanva');

    var signaturePad = new SignaturePad(canvas, {
        maxWidth: 2,
        penColor: "rgb(25, 25, 25)",
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
    var home = $('#namaf').val();

    function renderPDF(url) {
        pdfDoc = null;
        pageNum = 1;
        scale = 1.5;
        ctx = can.getContext('2d');
        pdfjsLib.disableWorker = true;
        var loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function getPdf(_pdfDoc) {
                pdfDoc = _pdfDoc;
                renderPage(pageNum);
            })
            .catch((err) => {
                var ctx = document.getElementById('render').getContext("2d");
                var img = new Image();
                img.src = "<?= base_url('images/canva/null.png') ?>";
                img.onload = () => {
                    ctx.imageSmoothingEnabled = false;
                    ctx.drawImage(img, 0, 0, can.width, can.height);
                }
            })
    }

    pdfjsLib.disableWorker = true;

    function renderPage(num) {
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({
                scale: scale
            });
            can.height = viewport.height;
            can.width = viewport.width;

            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            page.render(renderContext);
        });

        $('#page_num').val(num);
        document.getElementById('page_count').textContent = pdfDoc.numPages;
    }

    function goToPage() {
        let input = document.getElementById('page_num');
        let pageNum = parseInt(input.value);
        if (pageNum) {
            if (pageNum <= pdfDoc.numPages && pageNum >= 1) {
                renderPage(pageNum);
            }
        }
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

    function preview(id, files) {
        $('#modal-prev').modal('show');
        $('#ids').val(id);
        $('#namaf').val(files);
        var home = $('#namaf').val();

        var link = "<?= base_url('file_upload') ?>" + "/" + home;
        renderPDF(link);
    }

    function cancel() {
        if ($('#signature-frame').html() != '') {
            $('#signature-frame').css('display', 'none');
        } else {
            $('#signature-frame').css('display', 'contents');
        }
        $('#sign').html('Simpan');
    }

    // READY----------------------------------
    $(document).ready(function() {

        // Signature-Pad------------------------------------------------------------
        $('#addsign').click(function() {
            var canva = $('#signcanva').css('display');

            if (canva == 'none') {
                $('#signcanva').css('display', 'block');
                $('#sign').html('Simpan');
            } else if (canva == 'block') {
                $('#signcanva').css('display', 'none');
                signaturePad.clear();
            }
        });

        $('#resetCanva').click(function() {
            signaturePad.clear();
        });

        $('#sign').click(function(ev) {

            var doc = new jsPDF();
            var img = document.getElementById('signature-result');

            if ($('#sign').html() == 'Terapkan') {
                var canv = document.getElementById('render');

                var ctx = canv.getContext("2d");

                ctx.drawImage(img, ukuran.x - img.width / 2, ukuran.y - img.height / 2)

                // Save Document
                var imgs = canv.toDataURL("image/png");

                var width = doc.internal.pageSize.getWidth();
                var height = doc.internal.pageSize.getHeight();

                doc.addImage(imgs, 'PNG', 0, 0, width, height);
                doc.save($('#namaf').val());
                $('#modal-prev').modal('hide');

            } else if ($('#sign').html() == 'Simpan') {

                var signature = signaturePad.toDataURL('image/png');
                $('#signature-result').css('display', 'block');
                $('#signature-result').attr('src', signature);
                $('#signcanva').css('display', 'none');
                $('#signature-frame').css('display', 'flex');
                $('#sign').html('Terapkan');
                signaturePad.clear();

            } else {
                alert('Unknown Button Process');
            }
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