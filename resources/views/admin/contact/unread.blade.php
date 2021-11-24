@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        @if (session('status'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
            </div>
        @endif
        <div class="sl-page-title">
            <h5>Contact messages</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <div>
                <a href="{{ route('admin.contact.index') }}" class="btn btn-sm btn-success pull-left">All messages</a>
            </div>
            <br><h6 class="card-body-title">Unread messages list</h6><br>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-20p">Name</th>
                        <th class="wd-20p">E-mail</th>
                        <th class="wd-20p">Phone</th>
                        <th class="wd-20p">Status</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>
                                @if($row->phone == null)
                                    No phone number
                                @else
                                    {{ $row->phone }}
                                @endif
                            </td>
                            <td>
                                @if($row->status == 0)
                                    <span class="badge badge-warning">Unread</span>
                                @else
                                    <span class="badge badge-success">Read</span>
                                @endif
                            </td>
                            <td>
                                @if($row->status == 1)
                                    <a href="{{ route('admin.contact.status', $row->id) }}" class="btn btn-sm btn-warning"
                                       title="Mark as Unread"><i class="fa fa-envelope-open"></i></a>
                                @else
                                    <a href="{{ route('admin.contact.status', $row->id) }}" class="btn btn-sm btn-info"
                                       title="Mark as Read"><i class="fa fa-envelope-o"></i></a>
                                @endif
                                <a href="{{ route('admin.contact.show', $row->id) }}" class="btn btn-sm btn-info"
                                   title="View"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.contact.destroy', $row->id) }}" class="btn btn-sm btn-danger"
                                   title="Delete" onclick="return confirm('Are you sure?')" id="delete"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

@endsection
