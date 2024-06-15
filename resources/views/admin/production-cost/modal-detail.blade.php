<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table-detail">
                        <thead>
                            <tr>
                                <th width="15%">No</th>
                                <th>Produk</th>
                                <th>Stok</th>
                                <th>Harga Modal</th>
                                <th>Harga Jual</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
{{-- <style>
    /* Custom CSS to adjust modal width */
    @media (min-width: 768px) {
        .modal-dialog {
            max-width: calc(100% - 20px); /* Set the maximum width */
        }
    }

    @media (min-width: 992px) {
        .modal-dialog {
            max-width: calc(70% - 70px); /* Adjust maximum width for larger screens */
        }
    }
</style> --}}
    
@endpush