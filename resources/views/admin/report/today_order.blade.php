@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Orders report</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Today's orders report</h6>
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
                        <th class="wd-10%">Status</th>
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
                                @if($row->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($row->status == 1)
                                    <span class="badge badge-info">Payment accept</span>
                                @elseif($row->status == 2)
                                    <span class="badge badge-warning">In progress</span>
                                @elseif($row->status == 3)
                                    <span class="badge badge-success">Delivered</span>
                                @else
                                    <span class="badge badge-danger">Cancel</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL::to('admin/order/view/'.$row->id) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
