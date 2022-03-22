
    function submitModal(link, data, process) {
        $.ajax({
            type: 'post',
            url: link,
            data: data,
            success: function(response) {
                if (response == '1') {
                    $.notify('Data Berhasil Di' + process, 'success');
                    setTimeout(function() {
                        window.location.href = e.redirect;
                    }, 100);
                    $('#modalcrud').modal('toggle');
                    $('#datatabel').DataTable().ajax.reload();
                } else {
                    $.notify('Data Gagal Di' + process, 'error');
                    setTimeout(function() {
                        window.location.href = e.redirect;
                    }, 100);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    }
    function submitModaldelete(link, data, process) {
        
    }