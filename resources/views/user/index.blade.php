@extends('layouts.app')

@section('content')

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-8 card">
                    <table class="table table-response">
                        <thead>
                        <tr>
                            <th scope="col">1 </th>
                            <th scope="col">2 </th>
                            <th scope="col">3 </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col">1 </td>
                                <td scope="col">2 </td>
                                <td scope="col">3 </td>
                            </tr>
                            <tr>
                                <td scope="col">1 </td>
                                <td scope="col">2 </td>
                                <td scope="col">3 </td>
                            </tr>
                            <tr>
                                <td scope="col">1 </td>
                                <td scope="col">2 </td>
                                <td scope="col">3 </td>
                            </tr>
                        </tbody>
                    </table>
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
                            <li class="list-group-item">
                                <a href="{{ route('user.password.view') }}">Change password</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
