@push('scripts')
<script>
 $(document).ready(function() {
    $('#example3').DataTable({
        destroy: true,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: '{{ route("tenor.data") }}'
        },
        columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                sortable: false
            },
            {
                data: 'jum_tenor'
            },
            {
                data: 'action',
                searchable: false,
                sortable: false
            },
        ]
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

    function addForm(url) {
        $('#modal-add-tenor').modal('show');
        $('#modal-add-tenor .addModalLabel').text('Tambah Tenor');

        $('#add-tenor-form')[0].reset();
        $('#add-tenor-form').attr('action', url);
        $('#modal-add-tenor [name=_method]').val('post');
        $('#modal-add-tenor [name=name]').focus();
    }

    function editTenor(url) {
        $('#modal-add-tenor').modal('show');
        $('#modal-add-tenor .addModalLabel').text('Edit Tenor');

        $('#add-tenor-form')[0].reset();
        $('#add-tenor-form').attr('action', url);
        $('#modal-add-tenor [name=_method]').val('put');
        $('#modal-add-tenor [name=name]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-tenor [name=jum_tenor]').val(response.jum_tenor);
            })
            .fail((responseJSON) => {
                alert('Tidak dapat menampilkan data.')
            });
    }

    function deleteTenor(url) {
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