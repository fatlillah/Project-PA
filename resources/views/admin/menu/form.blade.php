                                    <div class="modal fade bd-example-modal-lg" id="modal-add-menu" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                        <form id="add-menu-form" action="" method="POST">
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
                                                                <label class="form-label" for="name_menu">Menu</label>
                                                                <input type="text" name="name_menu" id="name_menu" class="form-control" placeholder="Nama Menu">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="kode_menu">Kode</label>
                                                                <input type="text" name="kode_menu" id="kode_menu" class="form-control" placeholder="Kode Menu">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="type">Tipe</label>
                                                                <input type="text" name="type" id="type" class="form-control" placeholder="Tipe Menu">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="parent">Parent</label>
                                                                <input type="text" name="parent" id="parent" class="form-control" placeholder="Kode Parent">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="sort">Sort</label>
                                                                <input type="text" name="sort" id="sort" class="form-control" placeholder="Letak Menu">
                                                                <div class="errMsgContainer">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="icon_id">Icon</label>
                                                                <select id="icon_id" name="icon_id" class="default-select form-control wide" style="display: none;">
                                                                    <option selected="" disabled>Pilih Icon</option>
                                                                    @foreach($icon as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="url">URL</label>
                                                                <input type="text" name="url" id="url" class="form-control" placeholder="Letak Menu">
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