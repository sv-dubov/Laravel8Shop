@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Contact messages</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <div>
                <a href="{{ route('admin.contact.index') }}" class="btn btn-sm btn-success pull-right">All messages</a>
                <a href="{{ route('admin.contact.unread') }}" class="btn btn-sm btn-warning pull-left">Unread messages</a>
            </div>
            <br><h6 class="card-body-title">View message</h6><br>
            <div class="form-layout">
                <div class="row mg-b-25">

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Name: </label><br>
                            <strong>{{ $message->name }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">E-mail: </label><br>
                            <strong>{{ $message->email }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Phone: </label><br>
                            <strong>{{ $message->phone }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Date: </label><br>
                            <strong>{{ $message->created_at }}</strong>
                        </div>
                    </div><!-- col-3 -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Message: </label><br>
                            <p>{!! $message->message !!}</p>
                        </div>
                    </div><!-- col-12 -->

                </div><!-- row -->
            </div><!-- form-layout -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
