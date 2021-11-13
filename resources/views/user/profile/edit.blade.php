@extends('layouts.app')

@section('content')

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit your profile') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.store') }}" aria-label="{{ __('Update profile') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="profile_photo_path" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>
                                    <div class="col-md-6">
                                        <input id="image" type="file" class="form-control-file" name="profile_photo_path">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update profile') }}
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
                                <a href="{{ route('user.password.view') }}">Change password</a>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
