@push('scripts')
<script>
 $(document).ready(function() {
        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("produksi.data") }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name'
                },
                // {
                //     data: 'selectThemes',
                //     searchable: false,
                //     sortable: false
                // },

            ]
        });
    });
    function addForm() {
        $('#modal-production-theme').modal('show');
        $('#modal-production-theme .modal-title').text('Tema Produksi');
    }

    function selectThemes(id) {
    $.post('{{ route('produksi.create', ':themes_id') }}'.replace(':id', themes_id))
        .done(response => {
            
            window.location = '{{ route('produksi-detail.index') }}';
        })
        .fail(errors => {
            alert('Tidak dapat memilih tema. Silakan coba lagi.');
        });
}

</script>
@endpush