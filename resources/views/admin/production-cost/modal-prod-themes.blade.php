<div class="modal fade" id="modal-production-theme">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table-production-themes">
                        <thead>
                            <tr>
                                <th width="15%">No</th>
                                <th>Tema</th>
                                <th width="25%"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        @php
                        $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($themes as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('produksi.create', $item->id) }}" class="btn btn-primary btn-sm" >
                                        <i class="fa fa-check-circle"> Pilih</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
