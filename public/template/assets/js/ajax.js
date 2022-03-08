$(document).ready(function() {
    let table = $('#datasiswa').dataTable({
        "bPaginate": false,
        "bInfo": false,
        "bFilter": false,
        "bLengthChange": false,
        "pageLength": 5
    });
    
    $('#batal').click(function() {
        $('#dtsiswa')[0].reset();
    });

    $('#kelas-batal').click(function () {
        $('#kelasdt')[0].reset();
    });

    
    $('#bataldt').click(function () {
        $('#datasis')[0].reset();
    })

    //Siswa-Page
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
            success: function () {
                $('#tambahData').modal('hide');
                location.reload();
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success',
                    showConfirmButton: false,
                })
            }
        });
    });

    $(document).on('click', '#btn-edit', function () {
        var ids = $(this).attr('data-id');

        $.ajax({
            url: '/siswa/edit',
            method: 'GET',
            dataType: 'JSON',
            data: {
                id_siswa: ids,
            },
            success: function (data) {
                $('#modal-edit').modal('show');
                $('#edit-nama').val(data.nama);
                $('#edit-kelas').val(data.kelas);
                $('#edit-usia').val(data.usia);
                $('#ids').val(ids);
            }
        });
    });

    $(document).on('click', '#update', function () {
        var nama = $('#edit-nama').val();
        var kelas = $('#edit-kelas').val();
        var usia = $('#edit-usia').val();
        var id = $('#ids').val();

        $.ajax({
            url: '/siswa/update',
            method: 'POST',
            data: {
                nama: nama,
                kelas: kelas,
                usia: usia,
                id_siswa: id,
            },
            success: function () {
                $('#modal-edit').modal('hide');
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil diubah',
                    icon: 'success',
                    showConfirmButton: false,
                })
                location.reload();
            }
        })
    });

    $(document).on('click', '#btn-delete', function () {
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
                            url: '/siswa/delete',
                            method: 'GET',
                            data: {
                                id_siswa: ids,
                            },
                            success: function (data) {
                                location.reload();
                            }
                        })
                    }
                })
            }
        })
    });

    //Kelas-Page
    $('#kelas-add').on('click', function() {
        var kelas = $('#kelas').val();

        $.ajax({
            url: '/kelas/add',
            method: 'POST',
            data: {
                type: 1,
                kelas: kelas,
            },
            success: function () {
                $('#tambahKelas').modal('hide');
                location.reload();
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success',
                    showConfirmButton: false,
                })
            }
        });
    });

    $(document).on('click', '#btn-edit-kelas', function () {
        var ids = $(this).attr('data-id');

        $.ajax({
            url: '/kelas/edit',
            method: 'GET',
            dataType: 'JSON',
            data: {
                id_kelas: ids,
            },
            success: function (data) {
                $('#modal-edit-kelas').modal('show');
                $('#editKelas').val(data.kelas);
                $('#id_kelas').val(ids);
            }
        });
    });

    $(document).on('click', '#updateKelas', function () {
        var kelas = $('#editKelas').val();
        var id = $('#id_kelas').val();

        $.ajax({
            url: '/kelas/update',
            method: 'POST',
            data: {
                kelas: kelas,
                id_kelas: id,
            },
            success: function () {
                $('#modal-edit-kelas').modal('hide');
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil diubah',
                    icon: 'success',
                    showConfirmButton: false,
                })
                location.reload();
            }
        })

        // Swal.fire({
        //     title: 'Yakin ingin ubah data?',
        //     text: "Data akan diubah!",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Ya'
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         Swal.fire({
        //             title: 'Success!',
        //             text: 'Data berhasil diubah.',
        //             icon: 'success',
        //             confirmButtonText: 'Okay'
        //         }).then((hapus) => {
        //             if (hapus.isConfirmed) {
        //                 $.ajax({
        //                     url: '/kelas/update',
        //                     method: 'POST',
        //                     data: {
        //                         kelas: kelas,
        //                         id_kelas: id,
        //                     },  
        //                     success: function () {
        //                         $('#modal-edit-kelas').modal('hide');
        //                         Swal.fire({
        //                             title: 'Success',
        //                             text: 'Data berhasil diubah',
        //                             icon: 'success',
        //                             showConfirmButton: false,
        //                         })
        //                         location.reload();
        //                     }
        //                 })
        //                 location.reload();
        //             }
        //         })
        //     } else {
        //         location.reload();
        //     }
        // })
    });

    $(document).on('click', '#btn-delete-kelas', function () {
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
                            url: '/kelas/delete',
                            method: 'GET',
                            data: {
                                id_kelas: ids,
                            },
                        })
                        location.reload();
                    }
                })
            } else {
                location.reload
            }
        })
    });

    //Siswa-Adv
    $('#simpandt').on('click', function () {
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
            success: function () {
                $('#modal-add-siswa').modal('hide');
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success',
                    showConfirmButton: false,
                });

                table.clear().draw();
            }
        });
    });

    $(document).on('click', '#dt-edit', function () {
        var ids = $(this).attr('data-id');

        $.ajax({
            url: '/dtsiswa/edit',
            method: 'GET',
            dataType: 'JSON',
            data: {
                id_data: ids,
            },
            success: function (data) {
                $('#dt-edit').modal('show');
                $('#dt-nama').val(data.nama);
                $('#dt-kelas').val(data.kelas);
                $('#dt-usia').val(data.usia);
                // $('#dt-file').val(data.gambar);
                $('#idt').val(ids);
            }
        });
    });

    $('#dt-delete').on('click', function () {
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
                        location.reload();
                    }
                })
            } else {
                location.reload();
            }
        })
    })
});