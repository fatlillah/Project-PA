@push('scripts')
<script>
     let table1, table2;

$(function () {
     table1 = $('.table-orders-list').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("daftar-pemesanan.data") }}'
            },
            columns: [
                {
                    data: 'action'
                },
                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'no_order'
                },
                {
                    data: 'date'
                },
                {
                    data: 'customer'
                },
                {
                    data: 'total_item'
                },
                {
                    data: 'deadline'
                },
                {
                    data: 'DP'
                },
                {
                    data: 'status'
                },
                {
                    data: 'user'
                },
            ]
        });
     table2 = $('.table-detail').DataTable({
            destroy:true,
            dom: 'Brt',
            bSort: false,
            columns: [
                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'amount'
                },
                {
                    data: 'discount'
                },
                {
                    data: 'selling_price'
                },
                {
                    data: 'subtotal'
                },
            ]
        });
    });

    function editForm(url) {
    $('#modal-add-detail-size').modal('show');
    $('#modal-add-detail-size .addModalLabel').text('Edit Ukuran');

    $('#add-detail-size-form')[0].reset();
    $('#add-detail-size-form').attr('action', url);
    $('#modal-add-detail-size [name=_method]').val('put');
    $('#modal-add-detail-size [name=name_product]').focus();

    $.get(url)
        .done((response) => {
            $('#modal-add-detail-size [name=customer]').val(response.customer);
            $('#modal-add-detail-size [name=name_product]').val(response.name_product);
            $('#modal-add-detail-size [name=body]').val(response.body);
            $('#modal-add-detail-size [name=waist]').val(response.waist);
            $('#modal-add-detail-size [name=pelvis]').val(response.pelvis);
            $('#modal-add-detail-size [name=armhole]').val(response.armhole);
            $('#modal-add-detail-size [name=length_shoulder]').val(response.length_shoulder);
            $('#modal-add-detail-size [name=arm_length]').val(response.arm_length);
            $('#modal-add-detail-size [name=length_shirt]').val(response.length_shirt);
            $('#modal-add-detail-size [name=length_face]').val(response.length_face);
            $('#modal-add-detail-size [name=desc]').val(response.desc);
        })
        .fail((responseJSON) => {
            alert('Tidak dapat menampilkan data.')
        });
}

function showDetail(url) {
    $.ajax({
        url: url, 
        type: 'GET',
        success: function(response) {
            $('#modal-detail-body').html(response);
            $('#modal-detail').modal('show');
        },
        error: function(error) {
            console.log(error);
            alert('Failed to fetch order details. Please try again.');
        }
    });
}

function deleteData(url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data tidak dapat dipulihkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('[name=csrf-token]').attr('content')
                },
                success: function(res) {
                    if (res.status == 'success') {
                        Swal.fire(
                            'Sukses!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                        $('.table-orders-list').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal menghapus data.',
                            'error'
                        );
                    }
                },
                error: function(err) {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan. Silakan coba lagi.',
                        'error'
                    );
                }
            });
        }
    });
}

    function updateStatus(orderId, status) {
    $.ajax({
        url: '{{ route('orders.update-status') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            order_id: orderId,
            status: status
        },
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Status berhasil diperbarui.',
                });
                $('.table-orders-list').DataTable().ajax.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal memperbarui status.',
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan. Silakan coba lagi.',
            });
        }
    });
}

</script>
@endpush