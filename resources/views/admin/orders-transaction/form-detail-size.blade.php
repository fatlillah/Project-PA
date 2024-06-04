<div class="modal fade" id="modal-add-detail-size" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="add-detail-size-form" action="" method="POST">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="addModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label" for="customer"><strong>Pemilik</strong></label>
                        <div class="col-sm-9">
                            <input type="text" name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror">
                        @error('customer')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label" for="name_product"><strong>Nama Produk</strong></label>
                        <div class="col-sm-9">
                            <input type="text" name="name_product" id="name_product" class="form-control @error('name_product') is-invalid @enderror">
                            @error('name_product')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <table class="table table-bordered verticle-middle table-responsive-sm">
                                <tr>
                                    <td> <label class="form-label" for="body"><strong>Lingkar Badan</strong></label></td>
                                    <td> <input type="number" name="body" id="body" class="form-control @error('body') is-invalid @enderror">
                                        @error('body')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror</td>
                                    <td><label class="form-label" for="waist"><strong>Lingkar Pinggang</strong></label></td>
                                    <td> <input type="number" name="waist" id="waist" class="form-control @error('waist') is-invalid @enderror">
                                        @error('waist')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror</td>
                                </tr>
                                <tr>
                                    <td><label class="form-label" for="pelvis"><strong>Lingkar Panggul</strong></label></td>
                                    <td> <input type="number" name="pelvis" id="pelvis" class="form-control @error('pelvis') is-invalid @enderror">
                                        @error('pelvis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror</td>
                                    <td><label class="form-label" for="armhole"><strong>Lingkar Armhole</strong></label></td>
                                    <td> <input type="number" name="armhole" id="armhole" class="form-control @error('armhole') is-invalid @enderror">
                                        @error('armhole')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror</td>
                                </tr>
                                <tr>
                                    <td><label class="form-label" for="length_shoulder"><strong>Panjang Bahu</strong></label></td>
                                    <td><input type="number" name="length_shoulder" id="length_shoulder" class="form-control @error('length_shoulder') is-invalid @enderror">
                                        @error('length_shoulder')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror</td>
                                    <td> <label class="form-label" for="arm_length"><strong>Panjang Lengan</strong></label></td>
                                    <td><input type="number" name="arm_length" id="arm_length" class="form-control @error('arm_length') is-invalid @enderror">
                                        @error('arm_length')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror</td>
                                </tr>
                                <tr>
                                    <td><label class="form-label" for="length_shirt"><strong>Panjang Baju</strong></label></td>
                                    <td> <input type="number" name="length_shirt" id="length_shirt" class="form-control @error('length_shirt') is-invalid @enderror">
                                        @error('length_shirt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror</td>
                                    <td>  <label class="form-label" for="length_face"><strong>Panjang Muka</strong></label></td>
                                    <td><input type="number" name="length_face" id="length_face" class="form-control @error('length_face') is-invalid @enderror">
                                        @error('length_face')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div class="form-floating">
                                            <textarea class="form-control @error('length_face') is-invalid @enderror" placeholder="Leave a comment here" id="desc" name="desc" style="height: 100px"></textarea>
                                            <label for="desc">Catatan</label>
                                            @error('desc')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div>
                                    </td>
                                </tr>
                          
                        </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
