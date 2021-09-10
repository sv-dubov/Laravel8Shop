@extends('admin._layout')

@section('admin')

    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Brand list</h5>
            </div><!-- sl-page-title -->
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Brand list
                    <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal"
                       data-target="#modaldemo3">Add new</a>
                </h6>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-5p">№</th>
                            <th class="wd-15p">Brand name</th>
                            <th class="wd-20p">Brand logo</th>
                            <th class="wd-15p">Edit brand</th>
                            <th class="wd-15p">Delete brand</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brand as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->brand_name }}</td>
                                <td><img src="{{$row->getLogo()}}" height="70px;" width="80px;"></td>
                                <td>
                                    <a href="{{ route('brands.edit', $row->id) }}"
                                       class="btn btn-sm btn-info">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('brands.destroy', $row->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                                type="submit">Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-mainpanel -->
        <!-- LARGE MODAL -->
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Brand Add</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @include('admin.errors')
                    <form method="post" action="{{ route('brands.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Brand name" name="brand_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand logo</label>
                                <input type="file" class="form-control" aria-describedby="emailHelp"
                                       placeholder="Brand logo" name="brand_logo">
                            </div>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info pd-x-20">Add</button>
                            <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->

@endsection
