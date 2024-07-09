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
                    row.find('td:eq(6)').html(`
                        <button class="btn btn-danger btn-sm cancel-payment sharp me-1" data-url="${response.cancel_url}">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button class="btn btn-info btn-sm print-receipt" data-url="${response.receipt_url}">
                            <i class="fa fa-print"></i> Cetak
                        </button>
                    `);
                    // Update status text and classes
                    row.find('td').removeClass('text-danger').addClass('text-dark');
                    row.find('td:eq(4)').text('Sudah bayar');
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

        // Cancel Payment
        $(document).on('click', '.cancel-payment', function(e) {
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
                    row.find('td:eq(6)').html(`
                        <button class="btn btn-primary btn-sm update-status" data-url="${response.update_url}">
                            <i class="fas fa-money-bill-wave"></i> Bayar
                        </button>
                    `);
                    // Update status text and classes
                    row.find('td').addClass('text-danger').removeClass('text-dark');
                    row.find('td:eq(4)').text('Belum bayar');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Status pembayaran berhasil dibatalkan.'
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal membatalkan status pembayaran.'
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
