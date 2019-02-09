<div class="card mt-3">
    <div class="card-status bg-green"></div>
    <div class="card-header">
        <h3 class="card-title">Hasil Perhitungan Bunga</h3>
        <div class="card-options">
            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        @if ($greater_than_periode)
            <div class="alert alert-danger" role="alert">
                Periode melebihi waktu sekarang.
            </div>
        @else
            @if ($count_interest == 1)
                <div class="alert alert-info" role="alert">
                    Bunga sudah ditambahkan ke saldo
                </div>
            @endif
            <table class="table card-table">
                <tbody>
                    <tr>
                        <td style="width: 40%;" class="font-weight-bold text-muted">Periode</td>
                        <td>{{ $periode }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-muted">Saldo Terendah</td>
                        <td>{{ format_rupiah($lowest_balance) }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-muted">Suku Bunga/tahun</td>
                        <td>{{ $interest_rate }}%</td>
                    </tr>
                    <tr class="table-success">
                        <td class="font-weight-bold text-muted">Bunga Tabungan</td>
                        <td class="font-weight-bold">{{ format_rupiah($format_calculate_interest) }}</td>
                    </tr>
                    @if ($count_interest == 0)
                        <tr>
                            <td class="font-weight-bold text-muted">&nbsp;</td>
                            <td>
                                <button id="btn-add-to-balance" class="btn btn-secondary"><i class="fe fe-save mr-2"></i>Tambah ke Saldo Tabungan</button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endif
    </div>
</div>

<script>
require(['jquery'], function ($) {
    $(document).ready(function () {
        const DIV_CARD = 'div.card';

        /** Function for remove card */
        $('[data-toggle="card-remove"]').on('click', function(e) {
            let $card = $(this).closest(DIV_CARD);

            $card.remove();

            e.preventDefault();
            return false;
        });

        $('#btn-add-to-balance').click(function(e) {
            var anggota_id = '{{ $anggota_id }}';
            var month = '{{ $month }}';
            var year = '{{ $year }}';
            var lowest_balance = '{{ $lowest_balance }}';
            var interest_rate = '{{ $interest_rate }}';
            var calculate_interest = '{{ $format_calculate_interest }}';

            $.ajax({
                type: "POST",
                url: "{{ url('bankinterests/') }}",
                data: {anggota_id: anggota_id, month: month, year: year, lowest_balance: lowest_balance, interest_rate: interest_rate, calculate_interest: calculate_interest},
                success: function(data) {
                    if (data.status == true) {
                        alert("Bunga berhasil ditambahkan ke Saldo Tabungan");
                        window.location = data.url
                    } else {
                        alert("Terjadi kesalahan");
                    }
                }
            });
        });
    });
});
</script>
