@push('scripts')
<script>
     let table1, table2;

$(function () {
     table1 = $('.table-sales-list').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("daftar-penjualan.data") }}'
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
                    data: 'total_item'
                },
                {
                    data: 'total_price'
                },
                {
                    data: 'pay'
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

    function showDetail(url) {
        $('#modal-detail').modal('show');
        $('#modal-detail .modal-title').text('Detail Transaksi Penjualan');
        table2.ajax.url(url);
        table2.ajax.reload();
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
                        $('.table-sales-list').DataTable().ajax.reload();
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