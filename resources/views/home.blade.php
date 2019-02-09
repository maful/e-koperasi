@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content-app')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">5 Mutasi Terbaru Hari Ini</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Anggota</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th class="text-right">Debet</th>
                            <th class="text-right">Kredit</th>
                            <th class="text-right">Saldo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mutations as $mutation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div>{{ $mutation->member->nama }}</div>
                                    <div class="small text-muted">
                                        NIK: {{ $mutation->member->nik }}
                                    </div>
                                </td>
                                <td>{{ $mutation->tanggal }}</td>
                                <td>{{ $mutation->keterangan }}</td>
                                <td class="text-right">{{ format_rupiah($mutation->debet) }}</td>
                                <td class="text-right">{{ format_rupiah($mutation->kredit) }}</td>
                                <td class="text-right">{{ format_rupiah($mutation->saldo) }}</td>
                                <td class="text-muted">{{ $mutation->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
