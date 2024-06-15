@push('scripts')
<script>
 $(document).ready(function() {
    $('#example3').DataTable({
        destroy: true,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: '{{ route("pelanggan.data") }}'
        },
        columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                sortable: false
            },
            {
                data: 'name'
            },
            {
                data: 'phone'
            },
            {
                data: 'address'
            },
            {
                data: 'action',
                searchable: false,
                sortable: false
            },
        ]
    });

    $('#modal-add-customer').on('hidden.bs.modal', function () {
        $('#add-customer-form').trigger('reset'); 
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove(); 
    });

    $('#modal-add-customer').on('submit', function(e) {
        e.preventDefault();
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove();
        $.ajax({
            url: $('#add-customer-form').attr('action'),
            type: 'post',
            data: $('#add-customer-form').serialize(),
            success: function(res) {
                if (res.status == 'success') {
                    $('#modal-add-customer').modal('hide');
                    $('#example3').DataTable().ajax.reload();
                }
            },
            error: function(err) {
                let error = err.responseJSON;
                if (error.errors) {
                    $.each(error.errors, function(index, value) {
                        $('#add-customer-form [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            }
        })

    })
});



    function addCustomer(url) {
        $('#modal-add-customer').modal('show');
        $('#modal-add-customer .addModalLabel').text('Pelanggan Baru');

        $('#add-customer-form')[0].reset();
        $('#add-customer-form').attr('action', url);
        $('#modal-add-customer [name=_method]').val('post');
        $('#modal-add-customer [name=name]').focus();
    }

    function editCustomer(url) {
        $('#modal-add-customer').modal('show');
        $('#modal-add-customer .addModalLabel').text('Edit Pelanggan');

        $('#add-customer-form')[0].reset();
        $('#add-customer-form').attr('action', url);
        $('#modal-add-customer [name=_method]').val('put');
        $('#modal-add-customer [name=name]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-customer [name=name]').val(response.name);
                $('#modal-add-customer [name=phone]').val(response.phone);
                $('#modal-add-customer [name=address]').val(response.address);
            })
            .fail((responseJSON) => {
                alert('Tidak dapat menampilkan data.')
            });
    }

    function deleteCustomer(url) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('[name=csrf-token]').attr('content')
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#example3').DataTable().ajax.reload();
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