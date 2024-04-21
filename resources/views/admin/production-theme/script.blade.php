@push('scripts')
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("tema-produksi.data") }}'
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

        $('#modal-add-production-theme').on('hidden.bs.modal', function () {
            $('#add-product-form').trigger('reset'); 
            $('.is-invalid').removeClass('is-invalid'); 
            $('.invalid-feedback').remove(); 
        });

        $('#modal-add-production-theme').on('submit', function(e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid'); 
            $('.invalid-feedback').remove(); 
            $.ajax({
                url: $('#add-production-theme-form').attr('action'),
                type: 'post',
                data: $('#add-production-theme-form').serialize(),
                success: function(res) {
                    if (res.status == 'success') {
                        $('#modal-add-production-theme').modal('hide');
                        $('#example3').DataTable().ajax.reload();

                    }
                },
                error: function(err) {
                let error = err.responseJSON;
                if (error.errors) {
                    $.each(error.errors, function(index, value) {
                        $('#add-production-theme-form [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            }
            })

        })
    });

    function addForm(url) {
        $('#modal-add-production-theme').modal('show');
        $('#modal-add-production-theme .addModalLabel').text('Tambah Tema Produksi');

        $('#add-production-theme-form')[0].reset();
        $('#add-production-theme-form').attr('action', url);
        $('#modal-add-production-theme [name=_method]').val('post');
        $('#modal-add-production-theme [name=name]').focus();
    }

    function editForm(url) {
        $('#modal-add-production-theme').modal('show');
        $('#modal-add-production-theme .addModalLabel').text('Edit Tema Produksi');

        $('#add-production-theme-form')[0].reset();
        $('#add-production-theme-form').attr('action', url);
        $('#modal-add-production-theme [name=_method]').val('put');
        $('#modal-add-production-theme [name=name]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-production-theme [name=name]').val(response.name);
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