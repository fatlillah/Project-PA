@push('scripts')
<script>
   $(document).ready(function() {
    $('#date_late').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
            }
        });

        $('#date_late').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
        });

        $('#date_late').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("data-kredit.data") }}'
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false, sortable: false },
                { data: 'date' },
                { data: 'customer' },
                { data: 'total_item' },
                { data: 'price' },
                { data: 'tenor' },
                { data: 'action', searchable: false, sortable: false }
            ]
        });

        $('#modal-add-credit').on('hidden.bs.modal', function () {
            $('#add-credit-form').trigger('reset'); 
            $('.is-invalid').removeClass('is-invalid'); 
            $('.invalid-feedback').remove(); 
        });

        $('#modal-add-credit').on('submit', function(e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid'); 
            $('.invalid-feedback').remove();
            $.ajax({
                url: $('#add-credit-form').attr('action'),
                type: 'post',
                data: $('#add-credit-form').serialize(),
                success: function(res) {
                    if (res.status == 'success') {
                        $('#modal-add-credit').modal('hide');
                        $('#example3').DataTable().ajax.reload();
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    if (error.errors) {
                        $.each(error.errors, function(index, value) {
                            $('#add-credit-form [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                        });
                    } else {
                        alert('Terjadi kesalahan saat memproses permintaan.');
                    }
                }
            })
        })
    });

    function addForm(url) {
        $('#modal-add-credit').modal('show');
        $('#modal-add-credit .addModalLabel').text('Tambah Data Kredit');

        $('#add-credit-form')[0].reset();
        $('#add-credit-form').attr('action', url);
        $('#modal-add-credit [name=_method]').val('post');
        $('#modal-add-credit [name=name]').focus();
    }

    function deleteCredit(url) {
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
