@extends('user._layout')

@section('user')

    <div class="row" style="padding: 25px;">
        <div class="col-md-5">
            <h2>Change password</h2>
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Current password</label>
                    <input id="current_password" type="password" name="current_password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">New password</label>
                    <input id="password" type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Confirm new password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Change</button>
            </form>
        </div>
    </div>

@endsection
