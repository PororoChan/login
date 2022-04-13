
var can = document.getElementById('render');
    let signaturePad = new SignaturePad(document.getElementById('signcanva'), {
        maxWidth: 2,
        penColor: 'rgb(25, 25, 25)'
    });

    // RenderPDF
    var pdfDoc = null;
    var pageNum;
    var ctx;
    var home = $('#namaf').val();

    function renderPDF(url) {
        pdfDoc = null;
        pageNum = 1;
        scale = 1.3;
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
    
function cancel() {
    if ($('#signature-frame').html() != '') {
        $('#signature-frame').css('display', 'none');
    } else {
        $('#signature-frame').css('display', 'contents');
    }
    signaturePad.off();
    $('#addsign').html('<i class="fas fa-pencil-alt mr-3"></i> Buat Tanda Tangan');
    $('#sign').html('Simpan');
}

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
        ctx.drawImage(img, ukuran.x - img.width / 2, ukuran.y - img.height / 2);

        // Save Document
        var imgs = canv.toDataURL("image/png", 1.0);
        var width = doc.internal.pageSize.getWidth();
        var height = doc.internal.pageSize.getHeight();
        doc.addImage(imgs, 'PNG', 0, 0, width, height);
        doc.save($('#namaf').val());
        $('#modal-prev').modal('hide');
    } else if ($('#sign').html() == 'Simpan') {
        if (signaturePad.isEmpty()) {
            $.notify('Tanda Tangan Belum Diisi!', 'error');
        } else {
            var signature = signaturePad.toDataURL('image/svg+xml');
            $('#addsign').html('<i class="fas fa-plus mr-3"></i> Tambah Tanda Tangan');
            $('#signature-result').css('display', 'block');
            $('#signature-result').attr('src', signature);
            $('#signcanva').css('display', 'none');
            $('#signature-frame').css('display', 'flex');
            $('#sign').html('Terapkan');
            signaturePad.clear();
        }

    } else {
        alert('Unknown Button Process');
    }
});