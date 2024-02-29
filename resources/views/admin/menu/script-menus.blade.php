@push('scripts')
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("menu.data") }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name_menu'
                },
                {
                    data: 'kode_menu'
                },
                {
                    data: 'type'
                },
                {
                    data: 'parent'
                },
                {
                    data: 'sort'
                },
                {
                    data: 'name'
                },
                {
                    data: 'url'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },

            ]
        });

        $('#modal-add-menu').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $('#add-menu-form').attr('action'),
                type: 'post',
                data: $('#add-menu-form').serialize(),
                success: function(res) {
                    if (res.status == 'success') {
                        $('#modal-add-menu').modal('hide');
                        $('#example3').DataTable().ajax.reload();

                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    });
                }
            })

        })
    });

    function addForm(url) {
        $('#modal-add-menu').modal('show');
        $('#modal-add-menu .modal-title').text('Tambah Menu');

        $('#add-menu-form')[0].reset();
        $('#add-menu-form').attr('action', url);
        $('#modal-add-menu [name=_method]').val('post');
        $('#modal-add-menu [name=name_menu]').focus();
    }

    function editForm(url) {
        $('#modal-add-menu').modal('show');
        $('#modal-add-menu .modal-title').text('Edit Menu');

        $('#add-menu-form')[0].reset();
        $('#add-menu-form').attr('action', url);
        $('#modal-add-menu [name=_method]').val('put');
        $('#modal-add-menu [name=name_menu]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-menu [name=name_menu]').val(response.name_menu);
                $('#modal-add-menu [name=kode_menu]').val(response.kode_menu);
                $('#modal-add-menu [name=type]').val(response.type);
                $('#modal-add-menu [name=parent]').val(response.parent);
                $('#modal-add-menu [name=sort]').val(response.sort);
                $('#modal-add-menu [name=icon_id]').val(response.icon_id);
                $('#modal-add-menu [name=url]').val(response.url);
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