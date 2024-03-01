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
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label" for="kode_product">Kode</label>
                                                                <input type="text" name="kode_product" id="kode_product" class="form-control" placeholder="Kode Produk">
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
                                                                <label class="form-label" for="name">Produk</label>
                                                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Produk">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>