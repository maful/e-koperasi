@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Penarikan</h3>
                <div class="card-options">
                    <a href="{{ route('withdrawals.create') }}" class="btn btn-sm btn-pill btn-primary">Tambah Penarikan</a>
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
                    <table class="table card-table table-vcenter text-nowrap" id="datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Anggota</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th></th>
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
        ajax: '{{ url('withdrawals/get-json') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'anggota', name: 'anggota' },
            { data: 'jumlah', name: 'jumlah' },
            { data: 'keterangan', name: 'keterangan', orderable: false },
            { data: 'tanggal', name: 'tanggal' },
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