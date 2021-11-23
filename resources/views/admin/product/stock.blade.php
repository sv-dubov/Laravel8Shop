@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        @if (session('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
            </div>
        @endif
        <div class="sl-page-title">
            <h5>Stock list</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Stock list
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-success" style="float: right;">All products</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-15p">Product name</th>
                        <th class="wd-15p">Product code</th>
                        <th class="wd-15p">Image</th>
                        <th class="wd-15p">Category</th>
                        <th class="wd-15p">Brand</th>
                        <th class="wd-10p">Quantity</th>
                        <th class="wd-15p">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stock as $row)
                        <tr>
                            <td>{{ $row->product_name }}</td>
                            <td>{{ $row->product_code }}</td>
                            <td><img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"></td>
                            <td>{{ $row->getCategoryTitle() }}</td>
                            <td>{{ $row->getBrandTitle() }}</td>
                            <td>{{ $row->product_quantity }}</td>
                            <td>
                                @if($row->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
