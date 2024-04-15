@push('scripts')
<script>
 $(document).ready(function() {
        $('.table').DataTable({
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("produksi-detail.data", $production_id) }}',
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
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ]
        });
    });
    function productShow() {
        $('#modal-product').modal('show');
        $('#modal-product .modal-title').text('Produk');
    }

    function hideProduct() {
        $('#modal-product').modal('hide');
    }

    function selectProduct(id, name) {
        $('#product_id').val(id);
        $('#name').val(name);
        hideProduct();
        addProduct();
    }

    function addProduct() {
       $.post('{{ route('produksi.store') }}', 
       $('#form-product').serialize()
       )
       .done(response => {
            $('#name').focus();
            $('.table').DataTable().ajax.reload();
       })
       .fail(errors => {
            alert('Tidak dapat menyimpan data');
            return;
       })
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
                        $('.table').DataTable().ajax.reload();
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