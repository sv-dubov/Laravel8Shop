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
            <h5>Category/subcategory create</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Add category/subcategory
                <a href="{{ route('categories.index')}}" class="btn btn-success btn-sm pull-right"> All categories</a>
            </h6>
            <div class="table-wrapper">
                @include('admin.errors')
                <form method="POST"
                      action="{{ route('categories.store', ['parent' => $parent ? $parent->id : null]) }}">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   value="{{old('category_name')}}" name="category_name">
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Create</button>
                    </div>
                </form>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
