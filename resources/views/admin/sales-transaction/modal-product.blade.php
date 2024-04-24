<div class="modal fade" id="modal-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="example3" class="display table-product">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Stok</th>
                                <th>Harga Jual</th>
                                <th width="12%"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        @php
                        $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($product as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>{{ format_of_money($item->selling_price) }}</td>
                                <td width="12%">  
                                    <button type="button" class="btn btn-primary light px-3" onclick="selectProduct('{{ $item->id }}', '{{ $item->name }}')"><i class="fa fa-check-circle"></i> Pilih</button>
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
<style>
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
</style>
