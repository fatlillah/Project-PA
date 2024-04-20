                                    <div class="modal fade bd-example-modal-lg" id="modal-add-product" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form id="add-product-form" action="" method="POST">
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
                                                                <label class="form-label" for="name">Produk</label>
                                                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Produk">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="category_id">Kategori</label>
                                                                <select id="category_id" name="category_id" class="default-select form-control wide" style="display: none;">
                                                                    <option selected="" disabled>Pilih Kategori</option>
                                                                    @foreach($category as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="stock">Stok</label>
                                                                <input type="number" name="stock" id="stock" class="form-control" placeholder="Stok Produk" value="0">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="net_price">Harga Bersih</label>
                                                                <input type="text" name="net_price" id="net_price" class="form-control" placeholder="Harga Bersih" value="0">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="selling_price">Harga Jual</label>
                                                                <input type="text" name="selling_price" id="selling_price" class="form-control" placeholder="Harga Jual" value="0">
                                                                <div class="errMsgContainer">
                                                                </div>
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