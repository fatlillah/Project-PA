<div class="modal fade bd-example-modal-lg" id="modal-add-credit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="add-credit-form" action="" method="POST">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="credit_order_id">Data Pesanan</label>
                            <select id="credit_order_id" name="credit_order_id" class="default-select form-control @error('credit_order_id') is-invalid @enderror wide" style="display: none;">
                                <option selected="" disabled>Pilih pesanan</option>
                                @foreach($creditOrder as $item)
                                <option value="{{ $item->id }}"> {{ $item->order->no_order }} | {{ $item->order->customer->name }}</option>
                                @endforeach
                            </select>
                            @error('credit_order_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="tenor_id">Tenor</label>
                            <select id="tenor_id" name="tenor_id" class="default-select form-control @error('tenor_id') is-invalid @enderror wide" style="display: none;">
                                <option selected="" disabled>Pilih Tenor</option>
                                @foreach($tenor as $item)
                                <option value="{{ $item->id }}"> {{ $item->jum_tenor }} Bulan</option>
                                @endforeach
                            </select>
                            @error('tenor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>