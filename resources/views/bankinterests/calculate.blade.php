@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hitung Bunga Tabungan</h3>
                <div class="card-options">
                    <a href="{{ url('/bankinterests') }}" class="btn btn-sm btn-pill btn-secondary"><i class="fe fe-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table card-table mt-5">
                    <tbody>
                        <tr>
                            <td style="width: 25%;" class="font-weight-bold text-muted">NIK</td>
                            <td>{{ $member->nik }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold text-muted">Nama</td>
                            <td>{{ $member->nama }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold text-muted">Saldo</td>
                            <td>{{ $member->balance ? format_rupiah($member->balance->saldo) : '0' }}</td>
                        </tr>
                    </tbody>
                    <form id="form-check-interest">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold text-muted">Periode</td>
                                <td>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" id="onlmonth" name="month" autocomplete="off" class="form-control" required placeholder="Bulan">
                                        </div>
                                        <div class="col">
                                            <input type="text" id="onlyear" name="year" autocomplete="off" class="form-control" required placeholder="Tahun">
                                        </div>
                                        <div class="col-md-5">
                                            <button id="btn-check-interest" class="btn btn-primary">Cek Bunga</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>

                {{-- Result Calculate Interest --}}
                <div class="result-interest"></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Bunga Tabungan</h3>
                <div class="card-options">
                    <a href="javascript:void(0)" id="reload-table" class="btn btn-sm btn-pill btn-secondary"><i class="fe fe-refresh-cw mr-2"></i>Refresh</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap" id="datatable">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Periode</th>
                            <th>Saldo Terendah</th>
                            <th>Bunga</th>
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
    $(document).ready(function () {

        $('#btn-check-interest').click(function(e) {
            var isValid = $('#form-check-interest')[0].checkValidity();
            if (isValid) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var anggota_id = '{{ $member->id }}';
                var month = $('input[name="month"]').val();
                var year = $('input[name="year"]').val();

                $.ajax({
                    type: "GET",
                    url: "{{ url('bankinterests/check-interest') }}",
                    data: {anggota_id: anggota_id, month: month, year: year},
                    success: function(data) {
                        $('.result-interest').html(data.html);
                    }
                });
            }
        });
    });

    var oTable = $('#datatable').DataTable({
        lengthChange: false,
        serverSide: true,
        ajax: '{{ url('bankinterests/get-history-interests/' . $member->id) }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'periode', name: 'periode' },
            { data: 'saldo_terendah', name: 'saldo_terendah' },
            { data: 'nominal_bunga', name: 'nominal_bunga' },
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
                targets: [3],
                className: "text-right"
            }
        ]
    });
    $("#reload-table").click(function() {
        oTable.ajax.reload(null, false);
    });
});
</script>
@endsection