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
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'date'
                },
                {
                    data: 'no_order'
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
                    data: 'user'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
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
        url: url, // Adjust URL according to your route
        type: 'GET',
        success: function(response) {
            // Assuming 'response' contains the HTML to populate the modal body
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
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('[name=csrf-token]').attr('content')
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('.table-orders-list').DataTable().ajax.reload();
                    }
                },
                error: function(err) {
                    alert('Gagal menghapus data.');
                }
            });
        }
    }
</script>
@endpush