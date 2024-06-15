@push('scripts')
<script>
$(document).ready(function() {
    $('.table-transaction').DataTable({
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: '{{ route("transaksi-pemesanan.data", $order_id) }}',
        },
        columns: [
            { data: 'DT_RowIndex', searchable: false, sortable: false },
            { data: 'name_product' },
            { data: 'amount' },
            { data: 'action', searchable: false, sortable: false },
        ],
        dom: 'Brt',
        bSort: false,
    });

    let timeout = null;
    $(document).on('input', '.quantity', function () {
        clearTimeout(timeout); 
        let id = $(this).data('id');
        let amount = $(this).val();
        updateTotalItem();

        timeout = setTimeout(function () {
            $.post(`{{ url('/transaksi-pemesanan') }}/${id}`, {
                _token: $('[name=csrf-token]').attr('content'),
                _method: 'PUT',
                'amount': amount,
            })
            .done(response => {
                $('.table-transaction').DataTable().ajax.reload();
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            })
        }, 1000);
    });
     $('#deadline').pickadate({
        format: 'dd-mm-yyyy',
        selectMonths: true, 
        selectYears: true, 
        min: new Date(), 
        clear: 'Clear', 
        close: 'Apply', 
        today: 'Today', 
        closeOnSelect: true, 
        onSet: function(context) {
            if (context.select) {
                var date = new Date(context.select);
                var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                var months = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                var formattedDate = days[date.getDay()] + ', ' + date.getDate() + ' ' + months[date.getMonth()] + ' ' + date.getFullYear();
                
                $('#deadline').val(formattedDate);
                this.close();
            }
        }
    });
    $('.btn-submit').on('click', function() {
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove(); 
        $.ajax({
            url: $('#form-transaction').attr('action'),
            type: 'post',
            data: $('#form-transaction').serialize(),
            success: function(response) {
                console.log("Response: ", response); 
                Swal.fire({
                    title: 'Pesanan Berhasil Disimpan!',
                    text: 'Apakah Anda ingin mencetak nota Pesanan?',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Cetak Nota',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    console.log("Result: ", result); 
                    if (result.isConfirmed) {
                        window.location.href = '{{ route('transaksi-pemesanan.nota') }}';
                    } else {
                        window.location.href = '{{ route('transaksi-pemesanan.awal') }}';
                    }
                });
            },
            error: function(err) {
                let error = err.responseJSON;
                if (error.errors) {
                    $.each(error.errors, function(index, value) {
                        $('#form-transaction [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            }
        });
    });

    $('#modal-add-detail-size').on('hidden.bs.modal', function () {
        $('#add-detail-size-form').trigger('reset'); 
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove(); 
    });

    $('#modal-add-detail-size').on('submit', function(e) {
        e.preventDefault();
        $('.is-invalid').removeClass('is-invalid'); 
        $('.invalid-feedback').remove();
        $.ajax({
            url: $('#add-detail-size-form').attr('action'),
            type: 'post',
            data: $('#add-detail-size-form').serialize(),
            success: function(res) {
                if (res.status == 'success') {
                    $('#modal-add-detail-size').modal('hide');
                    $('.table-transaction').DataTable().ajax.reload();
                }
            },
            error: function(err) {
                let error = err.responseJSON;
                if (error.errors) {
                    $.each(error.errors, function(index, value) {
                        $('#add-detail-size-form [name="' + index + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            }
        })
    });
});


function updateTotalItem() {
        let totalItem = 0;
        $('.quantity').each(function() {
            totalItem += parseInt($(this).val()) || 0;
        });
        $('#total_item').val(totalItem);
    }

function addForm(url) {
    $('#modal-add-detail-size').modal('show');
    $('#modal-add-detail-size .addModalLabel').text('Tambah Ukuran');

    $('#add-detail-size-form')[0].reset();
    $('#add-detail-size-form').attr('action', url);
    $('#modal-add-detail-size [name=_method]').val('post');
    $('#modal-add-detail-size [name=name_product]').focus();
}

function editForm(url) {
    $('#modal-add-detail-size').modal('show');
    $('#modal-add-detail-size .addModalLabel').text('Edit Ukuran');

    $('#add-detail-size-form')[0].reset();
    $('#add-detail-size-form').attr('action', url);
    $('#modal-add-detail-size [name=_method]').val('put');
    $('#modal-add-detail-size [name=name_product]').focus();

    $.get(url)
        .done((response) => {
            $('#modal-add-detail-size [name=customer]').val(response.customer);
            $('#modal-add-detail-size [name=name_product]').val(response.name_product);
            $('#modal-add-detail-size [name=body]').val(response.body);
            $('#modal-add-detail-size [name=waist]').val(response.waist);
            $('#modal-add-detail-size [name=pelvis]').val(response.pelvis);
            $('#modal-add-detail-size [name=armhole]').val(response.armhole);
            $('#modal-add-detail-size [name=length_shoulder]').val(response.length_shoulder);
            $('#modal-add-detail-size [name=arm_length]').val(response.arm_length);
            $('#modal-add-detail-size [name=length_shirt]').val(response.length_shirt);
            $('#modal-add-detail-size [name=length_face]').val(response.length_face);
            $('#modal-add-detail-size [name=desc]').val(response.desc);
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
                    $('.table-transaction').DataTable().ajax.reload();
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
