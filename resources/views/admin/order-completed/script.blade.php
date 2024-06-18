@push('scripts')
<script>
 $(document).ready(function() {
    $('.table-index').DataTable({
        destroy: true,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: '{{ route("pesanan-selesai.data") }}'
        },
        columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                sortable: false
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
                data: 'price'
            },
            {
                data: 'action',
                searchable: false,
                sortable: false
            },
        ]
    });

    let timeout = null;
        $(document).on('input', '.price', function () {
            clearTimeout(timeout); 
            // console.log($(this).val());
            let id = $(this).data('id');
            // console.log(id)
            // return;
            let price = $(this).closest('tr').find('.price').val();

            if (price < 0) {
                $(this).val(0);
                alert('Jumlah harga tidak boleh negatif');
                return;
            }
            timeout = setTimeout(function () {
        $.post(`{{ url('/pesanan-selesai') }}/${id}`, {
            _token: $('[name=csrf-token]').attr('content'),
            _method: 'PUT',
            'price': price
        })
            .done(response => {
                    $('.table-index').DataTable().ajax.reload();
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            })
        }, 1000);
        });

    $('#modal-add-tenor').on('hidden.bs.modal', function () {
        $('#add-tenor-form').trigger('reset'); 
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove(); 
    });

    $('#modal-add-tenor').on('submit', function(e) {
        e.preventDefault();
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove();
        $.ajax({
            url: $('#add-tenor-form').attr('action'),
            type: 'post',
            data: $('#add-tenor-form').serialize(),
            success: function(res) {
                if (res.status == 'success') {
                    $('#modal-add-tenor').modal('hide');
                    $('#example3').DataTable().ajax.reload();
                }
            },
            error: function(err) {
                let error = err.responseJSON;
                if (error.errors) {
                    $.each(error.errors, function(index, value) {
                        $('#add-tenor-form [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            }
        })

    })
});

    function editForm(url) {
        $('#modal-add-tenor').modal('show');
        $('#modal-add-tenor .addModalLabel').text('Edit Tenor');

        $('#add-tenor-form')[0].reset();
        $('#add-tenor-form').attr('action', url);
        $('#modal-add-tenor [name=_method]').val('put');
        $('#modal-add-tenor [name=name]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-tenor [name=name]').val(response.name);
            })
            .fail((responseJSON) => {
                alert('Tidak dapat menampilkan data.')
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
                        $('.table-index').DataTable().ajax.reload();
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