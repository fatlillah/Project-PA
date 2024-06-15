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
                        button.replaceWith('<button class="btn btn-danger btn-sm delete-payment" data-url="' + url + '"><i class="fa fa-trash"></i> Hapus</button>');
                    } else {
                        row.find('td').addClass('text-danger');
                        row.find('td:eq(5)').text('Belum bayar');
                        button.replaceWith('<button class="btn btn-success btn-sm update-status" data-url="' + url + '"><i class="fas fa-money-bill-wave"></i> Bayar</button>');
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Status pembayaran berhasil diupdate.'
                    });
                },
                error: function() {
                    // Show error message
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

        // Tampilkan SweetAlert untuk konfirmasi penghapusan
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
                // Lakukan AJAX request untuk menghapus data
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Hapus baris dari tabel setelah penghapusan berhasil
                            row.remove();
                            // Tampilkan SweetAlert untuk pemberitahuan penghapusan berhasil
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
    });
</script>
@endpush
