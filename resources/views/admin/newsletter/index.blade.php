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
            <h5>Subscription table</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Subscription list</h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-5p">№</th>
                        <th class="wd-25p">Email</th>
                        <th class="wd-10p">Subscription time</th>
                        <th class="wd-10p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @include('admin.errors')
                    @foreach($subscriptions as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForhumans() }}</td>
                            <td>
                                <a href="{{ URL::to('admin/newsletters/'.$row->id) }}" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure?')" id="delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
