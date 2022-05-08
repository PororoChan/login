    const doc = new jsPDF("p", "mm", "a4");   
    var can = document.getElementById('render');
    let signaturePad = new SignaturePad(document.getElementById('signcanva'), {
        maxWidth: 2,
        penColor: 'rgb(62, 62, 62)'
    });

    // RenderPDF
    var pdfDoc = null,
        pageNum,
        ctx,
        home = $('#namaf').val();

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
            .catch((er) => {
                ctx.clearRect(0, 0, can.width, can.height);
                $.notify('Unsupported Document Rendering', 'error');
            })
    }

    function renderPage(num) {
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({
                scale: scale,
            });
            can.height = viewport.height;
            can.width = viewport.width;
            can.style.width = viewport.width;
            can.style.height = viewport.height;

            var renderContext = {
                canvasContext: ctx,
                viewport: viewport,
            };

            page.render(renderContext);
        });

        document.getElementById('page_num').value = pageNum;
        document.getElementById('page_count').textContent = pdfDoc.numPages;
    }

    function goToPage() {
        let input = document.getElementById('page_num'),
        numPage = parseInt(input.value);
        if (numPage) {
            if (numPage <= pdfDoc.numPages && numPage >= 1) {
                renderPage(numPage);
                pageNum = numPage;
                document.getElementById('page_num').value = numPage;
                return;
            }
        }
    }
    
    function goPrevious() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        renderPage(pageNum);
    }

    function goNext() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        renderPage(pageNum);
    }

    function cancel() {
        if ($('#signature-frame').html() != '') {
            $('#signature-frame').css('display', 'none');
        } else if($('#signature-frame').html() == '') {
            $('#signature-frame').css('display', 'block');
        }
        signaturePad.clear();
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

    var img = document.getElementById('signature-result'),
        home = $('#namaf').val();
    
    if ($('#sign').html() == 'Terapkan') {
        if (dragged == true) {
            var canv = document.getElementById('render'),
                ctx = canv.getContext("2d");
            ctx.drawImage(img, ukuran.x - img.width / 2, ukuran.y - img.height / 2);

            // Save Document
            var imgs = canv.toDataURL("image/png", 1.0);
            doc.addImage(imgs, 'PNG', 0, 0, 210, 297);

            // doc.save(home.split('.').slice(0, -1).join() + '_ditandatangani');
            $('#modal-prev').modal('hide');
            $.notify('Document Saved', 'success');
        } else if (dragged == false) {
            $.notify('Tanda Tangan Belum Diisi', 'error');
        }
    } else if ($('#sign').html() == 'Simpan') {
        if (signaturePad.isEmpty()) {
            $.notify('Tanda Tangan Belum Diisi!', 'error');
        } else {
            var signature = trimCanvas(document.getElementById('signcanva')),
                src = signature.toDataURL('image/png'); 
                
            $('#namaf').val(home.split('.').slice(0, -1).join() + '_ditandatangani.pdf');
            $('#addsign').html('<i class="fas fa-plus mr-3"></i> Tambah Tanda Tangan');
            $('#signature-result').css('display', 'block');
            $('#signature-result').attr('src', src);
            $('#signcanva').css('display', 'none');
            $('#signature-frame').css('display', 'flex');
            $('#sign').html('Terapkan');
            $.notify('Tanda Tangan Berhasil Disimpan', 'success');
            signaturePad.clear();
        }
    } else {
        $.notify('Unknown Button Process', 'error');
    }
});