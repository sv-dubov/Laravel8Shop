@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        @if (session('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
            </div>
        @endif
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Edit product
                <a href="{{ route('products.index')}}" class="btn btn-success btn-sm pull-right"> All products</a>
            </h6>
            @include('admin.errors')
            <form method="post" action="{{ route('products.update', $product->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name" value="{{$product->product_name}}">
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code" value="{{$product->product_code}}">
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose category" name="category_id">
                                    <option label="Choose category"></option>
                                    @foreach($category as $parent)
                                        @if($parent->parent_id == NULL)
                                            <option
                                                value="{{ $parent->id }}" {{ $parent->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $parent->category_name }}
                                            </option>
                                        @endif
                                        @if($parent->allChildren->count())
                                            @include('admin.product._category-child-edit', ['allChildren' => $parent->allChildren])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose brand" name="brand_id">
                                    <option label="Choose brand"></option>
                                    @foreach($brand as $row)
                                        <option
                                            value="{{ $row->id }}" {{ $row->id == $product->brand_id ? 'selected' : '' }}>
                                            {{ $row->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" name="product_quantity" value="{{$product->product_quantity}}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Discount price: </label>
                                <input class="form-control" type="text" name="discount_price" value="{{$product->discount_price}}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Selling price: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="selling_price" value="{{$product->selling_price}}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product size(-s): </label>
                                <input class="form-control" type="text" name="product_size" id="size" data-role="tagsinput" value="{{ $product->product_size }}">
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product color(-s): </label>
                                <input class="form-control" type="text" name="product_color" id="color" data-role="tagsinput" value="{{ $product->product_color }}">
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product details: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" id="summernote" name="product_details">{{ $product->product_details }}</textarea>
                            </div>
                        </div><!-- col-12 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Video link: </label>
                                <input class="form-control" name="video_link" value="{{$product->video_link}}">
                            </div>
                        </div><!-- col-12 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product created date: </label>
                                <input class="form-control" type="text" name="created_at" value="{{$product->created_at}}" readonly>
                            </div>
                        </div><!-- col-4 -->

                    </div><!-- row -->

                    <hr>
                    <br><br>
                    <div class="row">

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="main_slider" value="1" {{ ($product->main_slider == 1 ? 'checked' : '') }} >
                                <span>Main Slider</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="best_rated" value="1" {{ ($product->best_rated == 1 ? 'checked' : '') }} >
                                <span>Best Rated</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="hot_deal" value="1" {{ ($product->hot_deal == 1 ? 'checked' : '') }} >
                                <span>Hot Deal</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="mid_slider" value="1" {{ ($product->mid_slider == 1 ? 'checked' : '') }} >
                                <span>Mid Slider</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="trend" value="1" {{ ($product->trend == 1 ? 'checked' : '') }} >
                                <span>Trend Product</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="hot_new" value="1" {{ ($product->hot_new == 1 ? 'checked' : '') }} >
                                <span>Hot New</span>
                            </label>
                        </div> <!-- col-4 -->

                    </div><!-- end row -->
                    <br><br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5">Edit product</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
            </form>
        </div><!-- card -->
    </div><!-- sl-pagebody -->

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Edit product images</h6>
            <form method="post" action="{{ route('products.update.images', $product->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <label class="form-control-label">Image One (Main thumbnail): </label><br>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_one"
                                   onchange="readURL1(this);">
                            <span class="custom-file-control"></span>
                            <input type="hidden" name="old_one" value="{{ $product->image_one }}">
                            <img src="#" id="one">
                        </label>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{ URL::to($product->image_one) }}" style="width: 80px; height: 80px;">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <label class="form-control-label">Image Two: </label><br>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_two"
                                   onchange="readURL2(this);">
                            <span class="custom-file-control"></span>
                            <input type="hidden" name="old_two" value="{{ $product->image_two }}">
                            <img src="#" id="two">
                        </label>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{ URL::to($product->image_two) }}" style="width: 80px; height: 80px;">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <label class="form-control-label">Image Three: </label><br>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_three"
                                   onchange="readURL3(this);">
                            <span class="custom-file-control"></span>
                            <input type="hidden" name="old_three" value="{{ $product->image_three }}">
                            <img src="#" id="three">
                        </label>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{ URL::to($product->image_three) }}" style="width: 80px; height: 80px;">
                    </div>
                </div><br>
                <button type="submit" class="btn btn-warning mg-r-5">Update images</button>
            </form>
        </div><!-- card -->
    </div><!-- sl-pagebody -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script type="text/javascript">
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
