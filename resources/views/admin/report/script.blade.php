@push('scripts')
<script>
    $(document).ready(function() {
        var startDate = "{{ $start_date }}";
        var lastDate = "{{ $last_date }}";

        $('#example3').DataTable({
            destroy: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route("laporan.data", ["awal" => $start_date, "akhir" => $last_date]) }}',
                data: function(d) {
                    d.start_date = startDate;
                    d.last_date = lastDate;
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'date'
                },
                {
                    data: 'production_cost'
                },
                {
                    data: 'sales'
                },
                {
                    data: 'expenditure'
                },
                {
                    data: 'income'
                },
            ],
            dom: 'Brt',
            bSort: false,
            bPaginate: false,
        });

        $('.input-daterange-datepicker').daterangepicker({
            startDate: startDate,
            endDate: lastDate,
            opens: 'right',
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD', 
                cancelLabel: 'Clear'
            }
                });

        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            startDate = picker.startDate.format('YYYY-MM-DD');
            lastDate = picker.endDate.format('YYYY-MM-DD');
            $(this).val(startDate + ' - ' + lastDate);

            $('#example3').DataTable().ajax.reload();
        });

        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            startDate = '';
            lastDate = '';
            $(this).val('');
            $('#example3').DataTable().ajax.reload();
        });
    });
</script>
@endpush
