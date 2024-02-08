<div class="modal fade" id="add-icon" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="add-icon-form" action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="addModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label" for="name">Icon</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name Icon">
                        <div class="errMsgContainer">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>