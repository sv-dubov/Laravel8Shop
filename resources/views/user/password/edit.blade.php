@extends('layouts.app')

@section('content')

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Change your password') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}" aria-label="{{ __('Update password') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current password') }}</label>
                                    <div class="col-md-6">
                                        <input id="current_password" type="password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" value="{{ $current_password ?? old('current_password') }}" required autofocus>
                                        @if ($errors->has('current_password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm new password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset(Auth::user()->getPhoto()) }}" class="card-img-top" style="height: 90px; width: 110px; margin-left: 34%;">
                            <h3 class="card-title text-center">{{ Auth::user()->name }}</h3>
                            <p class="card-title text-center">E-mail: {{ Auth::user()->email }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('profile.edit') }}">Edit profile</a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <a href="{{ route('dashboard') }}" class="btn btn-info btn-sm btn-block">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
