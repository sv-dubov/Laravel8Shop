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
            <h5>SEO</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">SEO settings</h6>
            <form method="post" action="{{ route('admin.seo.update')}}">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Title: </label>
                                <input class="form-control" type="text" name="meta_title" value="{{ $seo->meta_title }}">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Author: </label>
                                <input class="form-control" type="text" name="meta_author" value="{{ $seo->meta_author }}">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Tag: </label>
                                <input class="form-control" type="text" name="meta_tag" value="{{ $seo->meta_tag }}">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Meta Description: </label>
                                <textarea class="form-control" name="meta_description">{{ $seo->meta_description }}</textarea>
                            </div>
                        </div><!-- col-12 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Google Analytics: </label>
                                <textarea class="form-control" name="google_analytics">{{ $seo->google_analytics }}</textarea>
                                <input type="hidden" name="id" value="{{ $seo->id }}">
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- row -->
                    <br><br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Update SEO</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
            </form>
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
