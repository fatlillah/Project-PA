@push('scripts')
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("icon.data") }}'
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

        $('#modal-add-icon').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $('#add-icon-form').attr('action'),
                type: 'post',
                data: $('#add-icon-form').serialize(),
                success: function(res) {
                    if (res.status == 'success') {
                        $('#modal-add-icon').modal('hide');
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
        $('#modal-add-icon').modal('show');
        $('#modal-add-icon .addModalLabel').text('Tambah Icon');

        $('#add-icon-form')[0].reset();
        $('#add-icon-form').attr('action', url);
        $('#modal-add-icon [name=_method]').val('post');
        $('#modal-add-icon [name=name]').focus();
    }

    function editForm(url) {
        $('#modal-add-icon').modal('show');
        $('#modal-add-icon .addModalLabel').text('Edit Icon');

        $('#add-icon-form')[0].reset();
        $('#add-icon-form').attr('action', url);
        $('#modal-add-icon [name=_method]').val('put');
        $('#modal-add-icon [name=name]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-icon [name=name]').val(response.name);
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