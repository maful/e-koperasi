@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Anggota</h3>
                <div class="card-options">
                    <a href="{{ route('members.index') }}" class="btn btn-sm btn-pill btn-secondary">Kembali</a>
                </div>
            </div>
            <form action="{{ route('members.update', $member->id) }}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}" value="{{ old('nik', $member->nik) }}">
                        @if ($errors->has('nik'))
                            <span class="invalid-feedback">{{ $errors->first('nik') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" value="{{ old('nama', $member->nama) }}">
                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $member->email) }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" value="{{ old('tempat_lahir', $member->tempat_lahir) }}">
                                @if ($errors->has('tempat_lahir'))
                                    <span class="invalid-feedback">{{ $errors->first('tempat_lahir') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="text" name="tanggal_lahir" id="datepicker" autocomplete="off" class="form-control{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" value="{{ old('tanggal_lahir', $member->tanggal_lahir) }}">
                                @if ($errors->has('tanggal_lahir'))
                                    <span class="invalid-feedback">{{ $errors->first('tanggal_lahir') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">No Telepon</label>
                                <input type="text" name="no_hp" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" value="{{ old('no_hp', $member->no_hp) }}">
                                @if ($errors->has('no_hp'))
                                    <span class="invalid-feedback">{{ $errors->first('no_hp') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input{{ $errors->has('jenkel') ? ' is-invalid' : '' }}" name="jenkel" value="L"{!! old('jenkel', $member->jenkel) == 'L' ? ' checked=""' : '' !!}>
                                        <span class="custom-control-label">Laki-laki</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input{{ $errors->has('jenkel') ? ' is-invalid' : '' }}" name="jenkel" value="P"{!! old('jenkel', $member->jenkel) == 'L' ? '' : ' checked=""' !!}>
                                        <span class="custom-control-label">Perempuan</span>
                                    </label>
                                </div>
                                @if ($errors->has('jenkel'))
                                    <span class="invalid-feedback">{{ $errors->first('jenkel') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Agama</label>
                                <select class="form-control{{ $errors->has('agama') ? ' is-invalid' : '' }}" name="agama">
                                    <option value="">-- Pilih --</option>
                                    @foreach (religions() as $religion)
                                        <option value="{{ $religion }}" {!! (old('agama', $member->agama) == $religion ? "selected=\"selected\"" : "") !!}>{{ $religion }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('agama'))
                                    <span class="invalid-feedback">{{ $errors->first('agama') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control{{ $errors->has('pekerjaan') ? ' is-invalid' : '' }}" value="{{ old('pekerjaan', $member->pekerjaan) }}">
                                @if ($errors->has('pekerjaan'))
                                    <span class="invalid-feedback">{{ $errors->first('pekerjaan') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea rows="2" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat">{{ old('alamat', $member->alamat) }}</textarea>
                        @if ($errors->has('alamat'))
                            <span class="invalid-feedback">{{ $errors->first('alamat') }}</span>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
