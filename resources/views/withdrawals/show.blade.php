@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" id="withdrawal_detail_desc">{{ __('detail') }} {{ __('menu.withdrawal') }}</h3>
                <div class="card-options">
                    <a href="{{ route('withdrawals.index') }}" class="btn btn-sm btn-pill btn-secondary">{{ __('back') }}</a>
                </div>
            </div>
            <table class="table card-table" aria-describedby="withdrawal_detail_desc">
                <tbody>
                    <tr>
                        <td style="width: 25%;" class="text-muted">{{ __('menu.member') }}</td>
                        <td>
                            <a href="{{ route('members.show', $withdrawal->anggota_id) }}" target="_blank">{{ $withdrawal->member->nama }} - {{ $withdrawal->member->nik }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('amount') }}</td>
                        <td>{{ format_rupiah($withdrawal->jumlah) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('note') }}</td>
                        <td>{{ $withdrawal->keterangan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('date') }}</td>
                        <td>{{ $withdrawal->created_at->format('d F Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
