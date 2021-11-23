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
            <h5>Site info</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Site info settings</h6>
            <form method="post" action="{{ route('admin.site.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $info->id }}">
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone One: </label>
                                <input class="form-control" type="text" name="phone_one" value="{{ $info->phone_one }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone Two: </label>
                                <input class="form-control" type="text" name="phone_two" value="{{ $info->phone_two }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">E-mail: </label>
                                <input class="form-control" type="email" name="email" value="{{ $info->email }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Company name: </label>
                                <input class="form-control" type="text" name="company_name" value="{{ $info->company_name }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Company address: </label>
                                <input class="form-control" type="text" name="company_address" value="{{ $info->company_address }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Facebook: </label>
                                <input class="form-control" type="text" name="facebook" value="{{ $info->facebook }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Youtube: </label>
                                <input class="form-control" type="text" name="youtube" value="{{ $info->youtube }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Instagram: </label>
                                <input class="form-control" type="text" name="instagram" value="{{ $info->instagram }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Twitter: </label>
                                <input class="form-control" type="text" name="twitter" value="{{ $info->twitter }}">
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <hr>
                </div><!-- end row -->
                <br><br>
                <div class="form-layout-footer">
                    <button type="submit" class="btn btn-info mg-r-5">Update</button>
                </div><!-- form-layout-footer -->
            </form>
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
