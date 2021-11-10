@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title text-center">Product info
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning pull-left">Edit product</a>
                <a href="{{ route('products.index')}}" class="btn btn-sm btn-success pull-right"> All products</a>
            </h6>
            <div class="form-layout">
                <div class="row mg-b-25">

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Product name: </label><br>
                            <strong>{{ $product->product_name }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Product code: </label><br>
                            <strong>{{ $product->product_code }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Category: </label><br>
                            <strong>{{ $product->getCategoryTitle() }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Brand: </label><br>
                            <strong>{{ $product->getBrandTitle() }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Product size(-s): </label><br>
                            @if($product->product_size != null)
                                <strong>{{ $product->product_size }}</strong>
                            @else
                                <strong>The product does not have size description</strong>
                            @endif
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Product color(-s): </label><br>
                            @if($product->product_color != null)
                                <strong>{{ $product->product_color }}</strong>
                            @else
                                <strong>The product does not have color description</strong>
                            @endif
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Quantity: </label><br>
                            <strong>{{ $product->product_quantity }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Selling price: </label><br>
                            <strong>{{ $product->selling_price }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Product details: </label><br>
                            <p>{!! $product->product_details !!}</p>
                        </div>
                    </div><!-- col-12 -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Video link: </label><br>
                            @if($product->video_link != null)
                                <strong>{{ $product->video_link }}</strong>
                            @else
                                <strong>No video link</strong>
                            @endif
                        </div>
                    </div><!-- col-12 -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Product created date: </label><br>
                            <strong>{{ $product->created_at }}</strong>
                        </div>
                    </div><!-- col-6 -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Product updated date: </label><br>
                            <strong>{{ $product->updated_at }}</strong>
                        </div>
                    </div><!-- col-6 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image One (Main Thumbnail): </label><br>
                            <label class="custom-file">
                                <img src="{{ URL::to($product->image_one) }}" style="height: 100px; width: 100px;">
                            </label>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image Two: </label><br>
                            <label class="custom-file">
                                <img src="{{ URL::to($product->image_two) }}" style="height: 100px; width: 100px;">
                            </label>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image Three: </label><br>
                            <label class="custom-file">
                                <img src="{{ URL::to($product->image_three) }}" style="height: 100px; width: 100px;">
                            </label>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->

                <br><br>

                <div class="row">

                    <div class="col-lg-4">
                        <label class="">
                            <span>Main Slider</span>
                            @if($product->main_slider == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </label>
                    </div> <!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            <span>Best Rated</span>
                            @if($product->best_rated == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </label>
                    </div> <!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            <span>Hot Deal</span>
                            @if($product->hot_deal == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </label>
                    </div> <!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            <span>Mid Slider</span>
                            @if($product->mid_slider == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </label>
                    </div> <!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            <span>Trend Product</span>
                            @if($product->trend == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </label>
                    </div> <!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            <span>Hot New</span>
                            @if($product->hot_new == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </label>
                    </div> <!-- col-4 -->
                </div><!-- end row -->
            </div><!-- form-layout -->
        </div><!-- card -->
    </div><!-- row -->

@endsection
