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
            <h6 class="card-body-title">Add new product
                <a href="{{ route('products.index')}}" class="btn btn-success btn-sm pull-right"> All products</a>
            </h6>
            @include('admin.errors')
            <form method="post" action="{{ route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name" value="{{old('product_name')}}">
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code" value="{{old('product_code')}}">
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose category" name="category_id">
                                    <option label="Choose category"></option>
                                    @foreach($category as $parent)
                                        @if($parent->parent_id == NULL)
                                            <option value="{{ $parent->id }}" @if(old('category_id') == $parent->id) selected="selected" @endif>
                                                {{ $parent->category_name }}
                                            </option>
                                        @endif
                                        @if($parent->allChildren->count())
                                            @include('admin.product._category-child', ['allChildren' => $parent->allChildren])
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
                                        <option value="{{ $row->id }}" @if(old('brand_id') == $row->id) selected="selected" @endif>{{ $row->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_quantity" value="{{old('product_quantity')}}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Discount price: </label>
                                <input class="form-control" type="text" name="discount_price" value="{{old('discount_price')}}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Selling price: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="selling_price" value="{{old('selling_price')}}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product size(-s): </label>
                                <input class="form-control" type="text" name="product_size" id="size" data-role="tagsinput" value="{{old('product_size')}}">
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product color(-s): </label>
                                <input class="form-control" type="text" name="product_color" id="color" data-role="tagsinput" value="{{old('product_color')}}">
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product details: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" id="summernote" name="product_details">{{ old('product_details') }}</textarea>
                            </div>
                        </div><!-- col-12 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Video link: </label>
                                <input class="form-control" name="video_link" value="{{old('video_link')}}">
                            </div>
                        </div><!-- col-12 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image One (Main thumbnail): <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL1(this);" required>
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="one">
                                </label>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_two" onchange="readURL2(this);" required>
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="two">
                                </label>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_three" onchange="readURL3(this);" required>
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="three">
                                </label>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <hr>
                    <br><br>
                    <div class="row">

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="main_slider" value="1" {{ old('main_slider') == '1' ? 'checked' : '' }}>
                                <span>Main Slider</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="best_rated" value="1" {{ old('best_rated') == '1' ? 'checked' : '' }}>
                                <span>Best Rated</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="hot_deal" value="1" {{ old('hot_deal') == '1' ? 'checked' : '' }}>
                                <span>Hot Deal</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="mid_slider" value="1" {{ old('mid_slider') == '1' ? 'checked' : '' }}>
                                <span>Mid Slider</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="trend" value="1" {{ old('trend') == '1' ? 'checked' : '' }}>
                                <span>Trend Product</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="hot_new" value="1" {{ old('hot_new') == '1' ? 'checked' : '' }}>
                                <span>Hot New</span>
                            </label>
                        </div> <!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="buyone_getone" value="1" {{ old('buyone_getone') == '1' ? 'checked' : '' }}>
                                <span>Buy One Get One</span>
                            </label>
                        </div> <!-- col-4 -->

                    </div><!-- end row -->
                    <br><br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5">Add product</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
            </form>
        </div><!-- card -->
    </div><!-- row -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

        <script type="text/javascript">
            function readURL1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#one')
                            .attr('src', e.target.result)
                            .width(100)
                            .height(100);
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
                            .width(100)
                            .height(100);
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
                            .width(100)
                            .height(100);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

@endsection
