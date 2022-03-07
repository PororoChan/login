$(document).ready(function() {
    // $('#datasiswa').dataTable({
    //     "bPaginate": false,
    //     "bInfo": false,
    //     "bFilter": true,
    //     "bLengthChange": false,
    //     "pageLength": 5
    // });

    $('#batal').click(function() {
        $('#dtsiswa')[0].reset();
    });

    $('#simpan').on('click', function() {
        var nama = $('#nama').val();
        var kelas = $('#kelas').val();
        var usia = $('#usia').val();

        $.ajax({
            url: '/siswa/add',
            method: 'POST',
            data: {
                type: 1,
                nama: nama,
                kelas: kelas,
                usia: usia,
            },
            success: function() {
                $('#tambahData').modal('hide');
                Swal.fire(
                    'Success',
                    'Data berhasil ditambahkan',
                    'success',
                );
                window.location = '/siswa';
            }
        });
    });

    $('#btn-edit').on('click', function() {
        var ids = $(this).data('data-id');
        console.log(ids);

        $.ajax({
            url: '/siswa/edit',
            method: 'GET',
            data: {
                id_siswa: ids,
            },
            success: function(response) {
                $('#modal-edit').modal('show');
                $('#idinput').val(response.row.ids);
                $('#edit-nama').val(response.row.nama);
                $('#edit-kelas').val(response.row.kelas);
                $('#edit-usia').val(response.row.usia);
            }
        });
    });
});