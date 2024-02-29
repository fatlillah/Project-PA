
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ url('assets/js/plugins-init/datatables.init.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            searchable: true,
            serverSide: true,
            responsive: true,
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
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    });
                }
            })

        })
    });

    function addForm(url) {
        $('#modal-add-icon').modal('show');
        $('#modal-add-icon .modal-title').text('Tambah Icon');

        $('#add-icon-form')[0].reset();
        $('#add-icon-form').attr('action', url);
        $('#modal-add-icon [name=_method]').val('post');
        $('#modal-add-icon [name=name]').focus();
    }

    function editForm(url) {
        $('#modal-add-icon').modal('show');
        $('#modal-add-icon .modal-title').text('Edit Icon');

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