@push('scripts')
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("users.data") }}'
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
                    data: 'email'
                },
                {
                    data: 'role'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },

            ]
        });

        
        $('#modal-add-user').on('hidden.bs.modal', function () {
            $('#add-product-form').trigger('reset'); 
            $('.is-invalid').removeClass('is-invalid'); 
            $('.invalid-feedback').remove(); 
        });

        $('#modal-add-user').on('submit', function(e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid'); 
            $('.invalid-feedback').remove(); 
            $.ajax({
                url: $('#add-user-form').attr('action'),
                type: 'post',
                data: $('#add-user-form').serialize(),
                success: function(res) {
                    if (res.status == 'success') {
                        $('#modal-add-user').modal('hide');
                        $('#example3').DataTable().ajax.reload();

                    }
                },
                error: function(err) {
                let error = err.responseJSON;
                if (error.errors) {
                    $.each(error.errors, function(index, value) {
                        $('#add-user-form [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            }
            })

        })
    });

    function addForm(url) {
        $('#modal-add-user').modal('show');
        $('#modal-add-user .addModalLabel').text('Tambah User');

        $('#add-user-form')[0].reset();
        $('#add-user-form').attr('action', url);
        $('#modal-add-user [name=_method]').val('post');
        $('#modal-add-user [name=name]').focus();
       
    }

    function editForm(url) {
        $('#modal-add-user').modal('show');
        $('#modal-add-user .addModalLabel').text('Edit User');

        $('#add-user-form')[0].reset();
        $('#add-user-form').attr('action', url);
        $('#modal-add-user [name=_method]').val('put');
        $('#modal-add-user [name=name]').focus();
         

        $.get(url)
            .done((response) => {
                $('#modal-add-user [name=name]').val(response.name);
                $('#modal-add-user [name=email]').val(response.email);
                $('#role').val('Pilih peran'); 
                $('#role').niceSelect('update');
                $('#role').val(response.role);
                $('#role').niceSelect('update');
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