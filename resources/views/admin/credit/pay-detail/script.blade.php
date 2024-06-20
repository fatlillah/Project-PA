@push('scripts')
<script>
    $(document).ready(function() {
        // Update Status
        $(document).on('click', '.update-status', function(e) {
            e.preventDefault();
            var button = $(this);
            var url = button.data('url');
            var row = button.closest('tr');

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update row content
                    if (response.status === 'Sudah bayar') {
                        row.find('td').removeClass('text-danger');
                        row.find('td:eq(5)').text('Sudah bayar');
                        button.replaceWith('<button class="btn btn-danger btn-sm delete-payment sharp me-1" data-url="' + response.delete_url + '"><i class="fa fa-trash"></i> Hapus</button>' +
                            '<button class="btn btn-success btn-sm print-receipt" data-url="' + response.receipt_url + '"><i class="fa fa-print"></i> Cetak</button>');
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Status pembayaran berhasil diupdate.'
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengupdate status pembayaran.'
                    });
                }
            });
        });

        // Delete Payment
        $(document).on('click', '.delete-payment', function(e) {
            e.preventDefault();
            var button = $(this);
            var url = button.data('url');
            var row = button.closest('tr');

            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dihapus tidak dapat dipulihkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                row.remove();
                                Swal.fire(
                                    'Terhapus!',
                                    'Pembayaran telah berhasil dihapus.',
                                    'success'
                                );
                            }
                        }
                    });
                }
            });
        });

        // Print Receipt
        $(document).on('click', '.print-receipt', function(e) {
            e.preventDefault();
            var url = $(this).data('url');
            if (url) {
                window.open(url, '_blank');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'URL cetak tidak ditemukan.'
                });
            }
        });

        $(document).on('click', '.print-all', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        if (url) {
            window.open(url, '_blank');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'URL cetak tidak ditemukan.'
            });
        }
});

    });
</script>



@endpush
