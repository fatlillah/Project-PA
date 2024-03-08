@push('scripts')
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("produk.data") }}'
            },
            columns: [
                {
                    data: 'checkAll',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'kode_product'
                },
                {
                    data: 'category_name'
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

        $('#modal-add-product').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $('#add-product-form').attr('action'),
                type: 'post',
                data: $('#add-product-form').serialize(),
                success: function(res) {
                    if (res.status == 'success') {
                        $('#modal-add-product').modal('hide');
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

        });
        // Select all checkbox functionality
        $('[name=checkAll]').on('change', function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });

    function addForm(url) {
        $('#modal-add-product').modal('show');
        $('#modal-add-product .modal-title').text('Tambah Produk');

        $('#add-product-form')[0].reset();
        $('#add-product-form').attr('action', url);
        $('#modal-add-product [name=_method]').val('post');
        $('#modal-add-product [name=name]').focus();
    }

    function editForm(url) {
        $('#modal-add-product').modal('show');
        $('#modal-add-product .modal-title').text('Edit Produk');

        $('#add-product-form')[0].reset();
        $('#add-product-form').attr('action', url);
        $('#modal-add-product [name=_method]').val('put');
        $('#modal-add-product [name=name]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-add-product [name=kode_product]').val(response.kode_product);
                $('#modal-add-product [name=name]').val(response.name);
                $('#modal-add-product [name=category_id]').val(response.category_id);

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

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.post(url, $('.form-product').serialize())
                .done((response) => {
                    $('#example3').DataTable().ajax.reload();
                    $('[name=checkAll]').prop('checked', false);
                })
                .fail((errors)=>{
                    alert('Tidak dapat menghapus data')
                    return;
                });
            }
        }else{
            alert('Pilih data yang akan dihapus');
            return;
        }
    }
</script>
@endpush