@push('scripts')
<script>
 $(document).ready(function() {
    $('#example3').DataTable({
        destroy: true,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: '{{ route("kategori.data") }}'
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
                data: 'action',
                searchable: false,
                sortable: false
            },
        ]
    });

    $('#modal-add-category').on('hidden.bs.modal', function () {
        $('#add-category-form').trigger('reset'); 
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove(); 
    });

    $('#modal-add-category').on('submit', function(e) {
        e.preventDefault();
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove();
        $.ajax({
            url: $('#add-category-form').attr('action'),
            type: 'post',
            data: $('#add-category-form').serialize(),
            success: function(res) {
                if (res.status == 'success') {
                    $('#modal-add-category').modal('hide');
                    $('#example3').DataTable().ajax.reload();
                }
            },
            error: function(err) {
                let error = err.responseJSON;
                if (error.errors) {
                    $.each(error.errors, function(index, value) {
                        $('#add-category-form [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            }
        })

    })
});



    function addForm(url) {
        $('#modal-add-category').modal('show');
        $('#modal-add-category .addModalLabel').text('Tambah Kategori');

        $('#add-category-form')[0].reset();
        $('#add-category-form').attr('action', url);
        $('#modal-add-category [name=_method]').val('post');
        $('#modal-add-category [name=name]').focus();
    }

    function editForm(url) {
        $('#modal-add-category').modal('show');
        $('#modal-add-category .addModalLabel').text('Edit Kategori');

        $('#add-category-form')[0].reset();
        $('#add-category-form').attr('action', url);
        $('#modal-add-category [name=_method]').val('put');
        $('#modal-add-category [name=name]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-category [name=name]').val(response.name);
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