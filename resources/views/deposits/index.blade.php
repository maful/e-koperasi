@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" id="deposit_desc">Data {{ __('menu.deposit') }}</h3>
                <div class="card-options">
                    <a href="{{ route('deposits.create') }}" class="btn btn-sm btn-pill btn-primary">{{ __('add') }} {{ __('menu.deposit') }}</a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                        <button type="button" class="close" data-dismiss="alert"></button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="datatable" aria-describedby="deposit_desc">
                        <thead>
                            <tr>
                                <th scope="col" class="w-1">No.</th>
                                <th scope="col">{{ __('menu.member') }}</th>
                                <th scope="col">{{ __('amount') }}</th>
                                <th scope="col">{{ __('note') }}</th>
                                <th scope="col">{{ __('date') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
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
        ajax: '{{ url('deposits/get-json') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'anggota', name: 'anggota' },
            { data: 'jumlah', name: 'jumlah' },
            { data: 'keterangan', name: 'keterangan', orderable: false },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        language: {
            "url": '{{ lang_url() }}'
        },
        columnDefs: [
            {
                targets: [0],
                className: "text-center"
            },
            {
                targets: [2],
                className: "text-right"
            },
            {
                targets: [5],
                className: "text-center"
            }
        ]
    });
});
</script>
@endsection
