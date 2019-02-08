@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Setoran</h3>
                <div class="card-options">
                    <a href="{{ route('deposits.index') }}" class="btn btn-sm btn-pill btn-secondary">Kembali</a>
                </div>
            </div>
            <table class="table card-table">
                <tbody>
                    <tr>
                        <td style="width: 25%;" class="text-muted">Anggota</td>
                        <td>
                            <a href="{{ route('members.show', $deposit->anggota_id) }}" target="_blank">{{ $deposit->member->nama }} - {{ $deposit->member->nik }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jumlah</td>
                        <td>{{ format_rupiah($deposit->jumlah) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Keterangan</td>
                        <td>{{ $deposit->keterangan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td>{{ $deposit->created_at->format('d F Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
