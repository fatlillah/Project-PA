@push('scripts')
<script>
 $(document).ready(function() {
        $('.table-transaction').DataTable({
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("transaksi-penjualan.data", $sale_id) }}',
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
                    data: 'amount'
                },
                {
                    data: 'selling_price'
                },
                {
                    data: 'discount'
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
             setTimeout(() => {
                $('#accepted').trigger('input');
            }, 300);
        });

        let timeout = null;
        $(document).on('input', '.quantity, .disc', function () {
            clearTimeout(timeout); 
            // console.log($(this).val());
            let id = $(this).data('id');
            // console.log(id)
            // return;
            let amount = $(this).closest('tr').find('.quantity').val();
            let discount = $(this).closest('tr').find('.disc').val();

            timeout = setTimeout(function () {
        $.post(`{{ url('/transaksi-penjualan') }}/${id}`, {
            _token: $('[name=csrf-token]').attr('content'),
            _method: 'PUT',
            'amount': amount,
            'discount': discount
        })
            .done(response => {
                    $('.table-transaction').DataTable().ajax.reload();
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            })
        }, 1000);
        });

        $('.btn-submit').on('click', function() {
            $('#form-transaction').submit();
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
       $.post('{{ route('transaksi-penjualan.store') }}', 
       $('#form-product').serialize()
       )
       .done(response => {
            $('#name').focus();
            $('.table-transaction').DataTable().ajax.reload();
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
                        $('.table-transaction').DataTable().ajax.reload();
                    }
                },
                error: function(err) {
                    alert('Gagal menghapus data.');
                }
            });
        }
    }

    $('#accepted').on('input', function () {
            if ($(this).val() == "") {
                $(this).val(0).select();
            }

            loadForm($(this).val());
        }).focus(function () {
            $(this).select();
        });

    function loadForm(accepted = 0) {
        $('#total').val($('.total').text());
        $('#total_item').val($('.total_item').text());

        $.get(`{{ url('/transaksi-penjualan/loadForm') }}/${$('.total').text()}/${accepted}`)
        .done(response => {
            $('#totalRp').val(response.totalRp);
            $('#payRp').val(response.payRp);
            $('#pay').val(response.pay);
            $('.show-pay').text('Bayar: ' + response.payRp);

            $('#money_changes').val(response.money_changesRp);
                if ($('#accepted').val() != 0) {
                    $('.show-pay').text('Kembali: ' + response.money_changesRp);
                }
        })
        .fail(errors => {
            alert('Tidak dapat menampilkan data');
            return;
        });
    }
</script>
@endpush