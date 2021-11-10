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
            <h5>Product list</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product list
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-warning" style="float: right;">Add new</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-15p">Product name</th>
                        <th class="wd-8p">Product code</th>
                        <th class="wd-10p">Image</th>
                        <th class="wd-10p">Category</th>
                        <th class="wd-10p">Brand</th>
                        <th class="wd-7p">Quantity</th>
                        <th class="wd-10p">Status</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $row)
                        <tr>
                            <td>{{ $row->product_name }}</td>
                            <td>{{ $row->product_code }}</td>
                            <td><img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"></td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->brand_name }}</td>
                            <td>{{ $row->product_quantity }}</td>
                            <td>
                                @if($row->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($row->status == 1)
                                    <a href="{{ route('products.status', $row->id) }}" class="btn btn-sm btn-danger"
                                       title="Make Inactive"><i class="fa fa-thumbs-down"></i></a>
                                @else
                                    <a href="{{ route('products.status', $row->id) }}" class="btn btn-sm btn-info"
                                       title="Make Active"><i class="fa fa-thumbs-up"></i></a>
                                @endif
                                <a href="{{ route('products.show', $row->id) }}" class="btn btn-sm btn-info"
                                   title="Show"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('products.edit', $row->id) }}" class="btn btn-sm btn-warning"
                                   title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('products.destroy', $row->id) }}" class="btn btn-sm btn-danger"
                                   title="Delete" onclick="return confirm('Are you sure?')" id="delete"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
