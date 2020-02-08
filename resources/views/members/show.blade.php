@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" id="member_detail_desc">{{ __('detail') }} {{ __('menu.member') }}</h3>
                <div class="card-options">
                    <a href="{{ route('members.index') }}" class="btn btn-sm btn-pill btn-secondary">{{ __('back') }}</a>
                    <a class="btn btn-sm btn-pill btn-primary ml-2" href="{{ route('members.edit', $member->id) }}">{{ __('edit') }}</a>
                </div>
            </div>
            <table class="table card-table" aria-describedby="member_detail_desc">
                <tbody>
                    <tr>
                        <td style="width: 25%;" class="text-muted">{{ __('nin') }}</td>
                        <td>{{ $member->nik }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('full_name') }}</td>
                        <td>{{ $member->nama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td>{{ $member->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('phone') }}</td>
                        <td>{{ $member->no_hp }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('gender') }}</td>
                        <td>{{ $member->jenkel }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('date_of_birth') }}</td>
                        <td>{{ $member->tempat_lahir }}, {{ $member->tanggal_lahir->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('religion') }}</td>
                        <td>{{ $member->agama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('address') }}</td>
                        <td>{{ $member->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ __('employment') }}</td>
                        <td>{{ $member->alamat }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
