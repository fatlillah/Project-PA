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
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },

            ]
        });

        $('#modal-add-expenses').on('submit', function(e) {
            e.preventDefault();
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
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>');
                    });
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