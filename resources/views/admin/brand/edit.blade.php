@extends('admin._layout')

@section('admin')

    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Brand edit</h5>
            </div><!-- sl-page-title -->
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit Brand</h6>
                <div class="table-wrapper">
                    @include('admin.errors')
                    <form method="post" action="{{ route('brands.update', $brand->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" value="{{ $brand->brand_name }}" name="brand_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand logo</label>
                                <input type="file" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" value="{{ $brand->brand_name }}" name="brand_logo">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old logo</label>
                                <img src="{{$brand->getLogo()}}" height="70px;" width="90px;">
                                <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
                            </div>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <a href="{{route('brands.index')}}" class="btn btn-default">Back</a>
                            <button type="submit" class="btn btn-info pd-x-20">Update</button>
                        </div>
                    </form>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-mainpanel -->

@endsection
