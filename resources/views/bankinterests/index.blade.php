@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" id="savings_interest_calculate_desc">{{ __('calculate') }} {{ __('savings_interest') }}</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap" id="datatable" aria-describedby="savings_interest_calculate_desc">
                    <thead>
                        <tr>
                            <th scope="col" class="w-1">No.</th>
                            <th scope="col">{{ __('nin') }}</th>
                            <th scope="col">{{ __('full_name') }}</th>
                            <th scope="col">{{ __('profession') }}</th>
                            <th scope="col">{{ __('phone') }}</th>
                            <th scope="col">{{ __('balance') }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
require(['datatables', 'jquery'], function(datatable, $) {
    $('#datatable').DataTable({
        lengthChange: false,
        serverSide: true,
        ajax: '{{ url('bankinterests/get-members') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nik', name: 'nik' },
            { data: 'nama', name: 'nama' },
            { data: 'pekerjaan', name: 'pekerjaan' },
            { data: 'no_hp', name: 'no_hp' },
            { data: 'saldo', name: 'saldo' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        language: {
            "url": 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
        },
        columnDefs: [
            {
                targets: [0],
                className: "text-center"
            },
            {
                targets: [5],
                className: "text-right"
            },
            {
                targets: [6],
                className: "text-right"
            }
        ]
    });
});
</script>
@endsection
