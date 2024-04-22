@push('scripts')
<script>
    let table1, table2;
$(document).ready(function() {
     table1 = $('.table-production-cost').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("produksi.data") }}'
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
                    data: 'production_theme'
                },
                {
                    data: 'user'
                },
                {
                    data: 'total_item'
                },
                {
                    data: 'grand_total'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ]
        });
     table2 = $('.table-detail').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            dom: 'Brt',
            bSort: false,
            ajax: {
                url: '{{ route("produksi.show") }}',
            },
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
                    data: 'stock'
                },
                {
                    data: 'net_price'
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

    function addForm() {
        $('#modal-production-theme').modal('show');
        $('#modal-production-theme .modal-title').text('Tema Produksi');
    }

    function showDetail(url) {
        $('#modal-detail').modal('show');
        $('#modal-detail .modal-title').text('Detail Transaksi Biaya Produksi');
        table2.DataTable().ajax.url(url);
        table2.DataTable().ajax.reload();
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
                        $('.table-production-cost').DataTable().ajax.reload();
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