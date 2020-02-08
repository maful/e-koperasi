@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" id="member_desc">Data {{ __('menu.member') }}</h3>
                <div class="card-options">
                    <a href="{{ route('members.create') }}" class="btn btn-sm btn-pill btn-primary">{{ __('add') }} {{ __('menu.member') }}</a>
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
                    <table class="table card-table table-vcenter text-nowrap" id="datatable" aria-describedby="member_desc">
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
</div>
@endsection

@section('js')
<script>
require(['datatables', 'jquery'], function(datatable, $) {
    $('#datatable').DataTable({
        lengthChange: false,
        serverSide: true,
        ajax: '{{ url('members/get-json') }}',
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
            "url": '{{ lang_url() }}'
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
