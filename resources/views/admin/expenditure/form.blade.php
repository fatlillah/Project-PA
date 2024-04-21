<div class="modal fade" id="modal-add-expenses" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="add-expenses-form" action="" method="POST">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="addModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label" for="desc">Keterangan</label>
                        <input type="text" name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" placeholder="Keterangan">
                        @error('desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="nominal">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control @error('nominal') is-invalid @enderror" placeholder="Nominal">
                        @error('nominal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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