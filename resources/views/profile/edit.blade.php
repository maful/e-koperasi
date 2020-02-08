@extends('layouts.app')

@section('content-app')
<div class="row row-cards">
        <div class="col-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('edit') }} {{ __('menu.profile') }}</h3>
                <div class="card-options">
                    <a href="{{ url('/profile') }}" class="btn btn-sm btn-pill btn-secondary">{{ __('back') }}</a>
                </div>
            </div>
            <form action="{{ url('/profile/' . $user->id) }}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-3">{{ __('full_name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" autocomplete="off" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name) }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-3">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" autocomplete="off" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email) }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-3">{{ __('password') }}</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" autocomplete="off" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" aria-describedby="passwordHelpBlock">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    {{ __('leave_empty_by_default') }}
                                </small>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">{{ __('save') }} {{ __('menu.profile') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
