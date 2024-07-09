<table class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Deadline</th>
            <th>Status</th>
        </tr>
    </thead>
    <?php $no = ($pendingOrders->currentPage() - 1) * $pendingOrders->perPage() + 1; ?>
    <tbody>
        @foreach ($pendingOrders as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->no_order }}</td>
            <td>{{ $item->customer->name }}</td>
            <td>{{ $item->deadline }}</td>
            <td>
                @if ($item->status == 0)
                    <span class="badge badge-warning">Pending<span class="ms-1 fas fa-stream"></span></span>
                @elseif ($item->status == 1)
                    <span class="badge badge-primary">Processing<span class="ms-1 fa fa-redo"></span></span>
                @elseif ($item->status == 2)
                    <span class="badge badge-success">Completed<span class="ms-1 fa fa-check"></span></span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $pendingOrders->links('layouts.pagination.custom-pagination') }}
</div>
