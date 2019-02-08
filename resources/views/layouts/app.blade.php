@extends('layouts.template')

@section('content')
<div class="page">
    <div class="flex-fill">
        @include('shared.header')
        <div class="my-3 my-md-5">
            <div class="container">
                <div class="page-header">
                    <h1 class="page-title">@yield('page-title')</h1>
                </div>
                @yield('content-app')
            </div>
        </div>
    </div>
    @include('shared.footer')
</div>
@endsection
