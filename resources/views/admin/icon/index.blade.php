@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Icon
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#add-icon">Tambah Icon</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Icon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.icon.create')
@include('admin.icon.edit')
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("icon.data") }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },

            ]
        });
        $('#add-icon-form').on('submit', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            // console.log(name);
            $.ajax({
                url: "{{ route('icon.store') }}",
                method: "post",
                data: {
                    name: name
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#add-icon').modal('hide');
                        $('#example3').DataTable().ajax.reload();
                        $('#add-icon-form')[0].reset();

                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>');
                    });
                }
            });

        });


    });
</script>

@endpush