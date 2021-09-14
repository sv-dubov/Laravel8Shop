@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Coupon edit</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Edit coupon</h6>
            <div class="table-wrapper">
                @include('admin.errors')
                <form method="POST" action="{{ route('coupons.update', $coupon->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Coupon code</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" value="{{ $coupon->coupon }}" name="coupon">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Coupon discount (%)</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" value="{{ $coupon->discount }}" name="discount">
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <a href="{{route('coupons.index')}}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    </div>
                </form>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
