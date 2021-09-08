@extends('user._layout')

@section('user')

    <div class="row" style="padding: 25px;">
        <div class="col-md-12">
            <div class="card mb-3" style="max-width: 740px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img
                            src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg')}}"
                            style="max-width: 200px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Name: {{ $user->name }}</h5>
                            <p class="card-title">Email: {{ $user->email }}</p>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
