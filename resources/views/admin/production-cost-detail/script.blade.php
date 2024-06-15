@push('scripts')
<script>
 $(document).ready(function() {
        $('.table-production').DataTable({
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
            ],
            dom: 'Brt',
            bSort: false,
        })
        .on('draw.dt', function () {
            loadForm();
        });

        let timeout = null;
        $(document).on('input', '.quantity, .net, .selling', function () {
            clearTimeout(timeout); 
            // console.log($(this).val());
            let id = $(this).data('id');
            // console.log(id)
            // return;
            let stock = $(this).closest('tr').find('.quantity').val();
            let net_price = $(this).closest('tr').find('.net').val();
            let selling_price = $(this).closest('tr').find('.selling').val();

            if (stock < 0) {
                $(this).val(0);
                alert('Jumlah stok tidak boleh negatif');
                return;
            }
            timeout = setTimeout(function () {
        $.post(`{{ url('/produksi-detail') }}/${id}`, {
            _token: $('[name=csrf-token]').attr('content'),
            _method: 'PUT',
            'stock': stock,
            'net_price': net_price,
            'selling_price': selling_price,
        })
            .done(response => {
                    $('.table-production').DataTable().ajax.reload();
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            })
        }, 1000);
        });

        $('.btn-submit').on('click', function() {
            $('#form-production').submit();
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
       $.post('{{ route('produksi-detail.store') }}', 
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

    function loadForm() {
        $('#total_item').val($('.total_item').text());
        $('#grand_total').val($('.grand_total').text());

        $.get(`{{ url('/produksi-detail/loadForm') }}/${$('.grand_total').text()}`)
        .done(response => {
            $('.show-grand-total').text(response.grand_totalRp);
        })
        .fail(errors => {
            alert('Tidak dapat menampilkan data');
            return;
        });
    }
</script>
@endpush