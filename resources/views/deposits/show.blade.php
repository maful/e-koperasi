@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" id="deposit_detail_desc">{{ __('detail') }} {{ __('menu.deposit') }}</h3>
                <div class="card-options">
                    <a href="{{ route('deposits.index') }}" class="btn btn-sm btn-pill btn-secondary">{{ __('back') }}</a>
                </div>
            </div>
            <table class="table card-table" aria-describedby="deposit_detail_desc">
                <tbody>
                    <tr>
                        <td style="width: 25%;" class="text-muted">{{ __('menu.member') }}</td>
                        <td>
                            <a href="{{ route('members.show', $deposit->anggota_id) }}" target="_blank">{{ $deposit->member->nama }} - {{ $deposit->member->nik }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('amount') }}</td>
                        <td>{{ format_rupiah($deposit->jumlah) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('note') }}</td>
                        <td>{{ $deposit->keterangan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('date') }}</td>
                        <td>{{ $deposit->created_at->format('d F Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
