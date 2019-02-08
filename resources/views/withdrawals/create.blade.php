@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Penarikan</h3>
                <div class="card-options">
                    <a href="{{ route('withdrawals.index') }}" class="btn btn-sm btn-pill btn-secondary">Kembali</a>
                </div>
            </div>
            <form action="{{ route('withdrawals.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-icon alert-danger alert-dismissible" role="alert">
                            <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                            <button type="button" class="close" data-dismiss="alert"></button>
                            {{ session('message') }}
                        </div>
                    @endif

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
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Jumlah Penarikan</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </span>
                                    <input type="number" name="jumlah" autocomplete="off" class="form-control{{ $errors->has('jumlah') ? ' is-invalid' : '' }}" value="{{ old('jumlah') }}">
                                    @if ($errors->has('jumlah'))
                                        <span class="invalid-feedback">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="keterangan" autocomplete="off" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" value="{{ old('keterangan') }}">
                                @if ($errors->has('keterangan'))
                                    <span class="invalid-feedback">{{ $errors->first('keterangan') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Tambah Penarikan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">

<script>
require(['jquery', 'selectize', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/id.js'], function ($, selectize, select2, select2id) {
    $(document).ready(function () {
        $('#select-beast').selectize({});
        $('#select2').select2({
            theme: "bootstrap",
            language: "id"
        });
    });
});
</script>
@endsection