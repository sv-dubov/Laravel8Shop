@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        @if (session('status'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
            </div>
        @endif
        <div class="sl-page-title">
            <h5>Return orders</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Return orders requests</h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-15%">Payment Type</th>
                        <th class="wd-15%">Transaction ID</th>
                        <th class="wd-10%">SubTotal</th>
                        <th class="wd-10%">Shipping</th>
                        <th class="wd-10%">VAT</th>
                        <th class="wd-10%">Total</th>
                        <th class="wd-10%">Date</th>
                        <th class="wd-10%">Return</th>
                        <th class="wd-10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $row)
                        <tr>
                            <td>{{ $row->payment_type }}</td>
                            <td>{{ $row->balance_transaction }}</td>
                            <td>{{ $row->subtotal }} $</td>
                            <td>{{ $row->shipping }} $</td>
                            <td>{{ $row->vat }} $</td>
                            <td>{{ $row->total }} $</td>
                            <td>{{ $row->date }}</td>
                            <td>
                                @if($row->return_order == 1)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($row->return_order == 2)
                                    <span class="badge badge-success">Success</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL::to('admin/return/approve'.$row->id) }}" class="btn btn-sm btn-info">Approve</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
