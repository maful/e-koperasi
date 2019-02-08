@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Penarikan</h3>
                <div class="card-options">
                    <a href="{{ route('withdrawals.index') }}" class="btn btn-sm btn-pill btn-secondary">Kembali</a>
                </div>
            </div>
            <table class="table card-table">
                <tbody>
                    <tr>
                        <td style="width: 25%;" class="text-muted">Anggota</td>
                        <td>
                            <a href="{{ route('members.show', $withdrawal->anggota_id) }}" target="_blank">{{ $withdrawal->member->nama }} - {{ $withdrawal->member->nik }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jumlah Penarikan</td>
                        <td>{{ format_rupiah($withdrawal->jumlah) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Keterangan</td>
                        <td>{{ $withdrawal->keterangan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td>{{ $withdrawal->created_at->format('d F Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
