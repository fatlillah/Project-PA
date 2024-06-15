@push('scripts')
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("pengeluaran.data") }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'desc'
                },
                {
                    data: 'nominal'
                },
                @if (auth()->user()->hasRole('admin'))
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
                @endif

            ]
        });

        $('#modal-add-expenses').on('hidden.bs.modal', function () {
            $('#add-expenses-form').trigger('reset'); // Reset form fields
            $('.is-invalid').removeClass('is-invalid'); // Remove error styling
            $('.invalid-feedback').remove(); // Remove error messages
        });

        $('#modal-add-expenses').on('submit', function(e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid'); // Remove previous error styling
            $('.invalid-feedback').remove(); // Remove previous error messages
            $.ajax({
                url: $('#add-expenses-form').attr('action'),
                type: 'post',
                data: $('#add-expenses-form').serialize(),
                success: function(res) {
                    if (res.status == 'success') {
                        $('#modal-add-expenses').modal('hide');
                        $('#example3').DataTable().ajax.reload();

                    }
                },
                error: function(err) {
                let error = err.responseJSON;
                if (error.errors) {
                    $.each(error.errors, function(index, value) {
                        $('#add-expenses-form [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            }
            })

        })
    });

    function addForm(url) {
        $('#modal-add-expenses').modal('show');
        $('#modal-add-expenses .addModalLabel').text('Tambah Pengeluaran');

        $('#add-expenses-form')[0].reset();
        $('#add-expenses-form').attr('action', url);
        $('#modal-add-expenses [name=_method]').val('post');
        $('#modal-add-expenses [name=desc]').focus();
    }

    function editForm(url) {
        $('#modal-add-expenses').modal('show');
        $('#modal-add-expenses .addModalLabel').text('Edit Pengeluaran');

        $('#add-expenses-form')[0].reset();
        $('#add-expenses-form').attr('action', url);
        $('#modal-add-expenses [name=_method]').val('put');
        $('#modal-add-expenses [name=desc]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-expenses [name=desc]').val(response.desc);
                $('#modal-add-expenses [name=nominal]').val(response.nominal);
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