<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('result') }}</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>{{ __('date') }}</th>
                        <th>{{ __('note') }}</th>
                        <th class="text-right">{{ __('debit') }}</th>
                        <th class="text-right">{{ __('credit') }}</th>
                        <th class="text-right">{{ __('balance') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($savings_history as $saving_history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $saving_history->tanggal }}</td>
                            <td>{{ $saving_history->keterangan }}</td>
                            <td class="text-right">{{ format_rupiah($saving_history->debet) }}</td>
                            <td class="text-right">{{ format_rupiah($saving_history->kredit) }}</td>
                            <td class="text-right">{{ format_rupiah($saving_history->saldo) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Riwayat Mutasi tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($savings_history->count() > 0)
            <table class="table card-table mt-5">
                <tbody>
                    <tr>
                        <td style="width: 20%;" class="font-weight-bold text-muted">Total {{ __('credit') }}</td>
                        <td>{{ format_rupiah($total_credit) }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-muted">Total {{ __('debit') }}</td>
                        <td>{{ format_rupiah($total_debet) }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-muted">{{ __('balance') }}</td>
                        <td>{{ format_rupiah($balance->saldo) }}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
</div>
