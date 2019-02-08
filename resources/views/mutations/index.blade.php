@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cek Mutasi</h3>
            </div>
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Anggota</label>
                            <div class="col-sm-10">
                                <select class="form-control{{ $errors->has('anggota') ? ' is-invalid' : '' }}" id="select2" name="anggota">
                                    <option value="">-- Pilih Anggota --</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}" {!! (old('anggota') == $member->id ? "selected=\"selected\"" : "") !!}>{{ $member->nama }} - {{ $member->nik }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('anggota'))
                                    <span class="invalid-feedback">{{ $errors->first('anggota') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button id="btn-check-mutations" class="btn btn-primary">Cek Mutasi</button>
                </div>
            </form>
        </div>
        <div class="result"></div>
    </div>
</div>
@endsection

@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">

<script>
require(['jquery', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js'], function ($, select2) {
    $(document).ready(function () {
        $('#select2').select2({
            theme: "bootstrap",
        });

        $('#btn-check-mutations').click(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var anggota_id = $('select[name="anggota"]').val();
            if (anggota_id == "") {
                console.log('Clicked null');
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ url('mutations/check-mutations') }}",
                    data: {anggota_id: anggota_id},
                    success: function(data) {
                        $('.result').html(data.html);
                    }
                });
            }

        });
    });
});
</script>
@endsection