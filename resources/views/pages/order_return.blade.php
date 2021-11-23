@extends('layouts.app')

@section('content')

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-8 card">
                    <table class="table table-response">
                        <thead>
                        <tr>
                            <th scope="col">Payment type</th>
                            <th scope="col">Return</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($getOrders as $row)
                            <tr>
                                <td scope="col">{{ $row->payment_type }}</td>
                                <td scope="col">
                                    @if($row->return_order == 0)
                                        <span class="badge badge-warning">No request</span>
                                    @elseif($row->return_order == 1)
                                        <span class="badge badge-info">Pending</span>
                                    @elseif($row->return_order == 2)
                                        <span class="badge badge-warning">Success</span>
                                    @endif
                                </td>
                                <td scope="col">{{ $row->total }}$</td>
                                <td scope="col">{{ $row->date }}</td>
                                <td scope="col">
                                    @if($row->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($row->status == 1)
                                        <span class="badge badge-info">Payment accept</span>
                                    @elseif($row->status == 2)
                                        <span class="badge badge-warning">In process</span>
                                    @elseif($row->status == 3)
                                        <span class="badge badge-success">Delivered</span>
                                    @else
                                        <span class="badge badge-danger">Cancel</span>
                                    @endif
                                </td>
                                <td scope="col">
                                    @if($row->return_order == 0)
                                        <a href="{{ url('user/orders/return/'.$row->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Return</a>
                                    @elseif($row->return_order == 1)
                                        <span class="badge badge-info">Pending</span>
                                    @elseif($row->return_order == 2)
                                        <span class="badge badge-warning">Success</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
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
                                <a href="{{ route('user.orders.success') }}">Return order</a>
                            </li>
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
