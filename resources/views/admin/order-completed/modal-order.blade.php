<div class="modal fade" id="modal-order">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="example3" class="display table-order">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Order</th>
                                <th>Nama Pemesan</th>
                                <th width="12%"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        @php
                        $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->no_order }}</td>
                                <td>{{ $item->customer->name }}</td>
                                <td width="13%">  
                                    <button type="button" class="btn btn-primary light px-3" onclick="selectOrder('{{ $item->id }}', '{{ $item->customer->name }}')"><i class="fa fa-check-circle"></i> Pilih</button>
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