@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Anggota</h3>
                <div class="card-options">
                    <a href="{{ route('members.index') }}" class="btn btn-sm btn-pill btn-secondary">Kembali</a>
                    <a class="btn btn-sm btn-pill btn-primary ml-2" href="{{ route('members.edit', $member->id) }}">Ubah</a>
                </div>
            </div>
            <table class="table card-table">
                <tbody>
                    <tr>
                        <td style="width: 25%;" class="text-muted">NIK</td>
                        <td>{{ $member->nik }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nama</td>
                        <td>{{ $member->nama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">E-Mail</td>
                        <td>{{ $member->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">No. Telp</td>
                        <td>{{ $member->no_hp }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jenis Kelamin</td>
                        <td>{{ $member->jenkel }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tempat, Tanggal Lahir</td>
                        <td>{{ $member->tempat_lahir }}, {{ $member->tanggal_lahir->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Agama</td>
                        <td>{{ $member->agama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pekerjaan</td>
                        <td>{{ $member->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Alamat</td>
                        <td>{{ $member->alamat }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
