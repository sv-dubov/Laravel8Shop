@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        @if (session('status'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
            </div>
        @endif
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Order details</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Order</strong> details</div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name: </th>
                                    <th>{{ $order->user->name }}</th>
                                </tr>
                                <tr>
                                    <th>E-mail: </th>
                                    <th>{{ $order->user->email }}</th>
                                </tr>
                                <tr>
                                    <th>Payment Type: </th>
                                    <th>{{ $order->payment_type }}</th>
                                </tr>
                                <tr>
                                    <th>Payment ID: </th>
                                    <th>{{ $order->payment_id }}</th>
                                </tr>
                                <tr>
                                    <th>Total : </th>
                                    <th>{{ $order->total }} $</th>
                                </tr>
                                <tr>
                                    <th> Date: </th>
                                    <th> {{ $order->date }} </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Shipping</strong> details</div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name: </th>
                                    <th>{{ $shipping->ship_name }}</th>
                                </tr>
                                <tr>
                                    <th>Phone: </th>
                                    <th>{{ $shipping->ship_phone }}</th>
                                </tr>
                                <tr>
                                    <th>Email: </th>
                                    <th>{{ $shipping->ship_email }}</th>
                                </tr>
                                <tr>
                                    <th>Address: </th>
                                    <th>{{ $shipping->ship_address }}</th>
                                </tr>
                                <tr>
                                    <th>City: </th>
                                    <th>{{ $shipping->ship_city }}</th>
                                </tr>
                                <tr>
                                    <th>Status: </th>
                                    <th>
                                        @if($order->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 1)
                                            <span class="badge badge-info">Payment accept</span>
                                        @elseif($order->status == 2)
                                            <span class="badge badge-warning">In process</span>
                                        @elseif($order->status == 3)
                                            <span class="badge badge-success">Delivered</span>
                                        @else
                                            <span class="badge badge-danger">Cancel</span>
                                        @endif
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card pd-20 pd-sm-40 col-lg-12">
                    <h6 class="card-body-title">Product details</h6>
                    <div class="table-wrapper">
                        <table class="table display responsive nowrap">
                            <thead>
                            <tr>
                                <th class="wd-15p">Product ID</th>
                                <th class="wd-15p">Name</th>
                                <th class="wd-15p">Image</th>
                                <th class="wd-15p">Color</th>
                                <th class="wd-15p">Size</th>
                                <th class="wd-15p">Quantity</th>
                                <th class="wd-15p">Unit price</th>
                                <th class="wd-20p">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $detail)
                                <tr>
                                    <td>{{ $detail->product->product_code }}</td>
                                    <td>{{ $detail->product_name }}</td>
                                    <td><img src="{{ URL::to($detail->product->image_one) }}" height="50px;" width="50px;" alt=""></td>
                                    @if($detail->color == null)
                                        <td>No color</td>
                                    @else
                                    <td>{{ $detail->color }}</td>
                                    @endif
                                    @if($detail->size == null)
                                        <td>No sizes</td>
                                    @else
                                        <td>{{ $detail->size }}</td>
                                    @endif
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->single_price }}</td>
                                    <td>{{ $detail->total_price }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div>
            @if($order->status == 0)
                <a href="{{ url('admin/payment/accept/'.$order->id) }}" class="btn btn-info">Payment accept</a>
                <a href="{{ url('admin/payment/cancel/'.$order->id) }}" class="btn btn-danger">Cancel order</a>
            @elseif($order->status == 1)
                <a href="{{ url('admin/delivery/process/'.$order->id) }}" class="btn btn-info">Process delivery</a>
            @elseif($order->status == 2)
                <a href="{{ url('admin/delivery/done/'.$order->id) }}" class="btn btn-success">Delivery done</a>
            @elseif($order->status == 4)
                <strong class="text-danger text-center">This order is not valid</strong>
            @else
                <strong class="text-success text-center">This order was delivered successfully</strong>
            @endif
        </div>
    </div><!-- sl-pagebody -->

@endsection
