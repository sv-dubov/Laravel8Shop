@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Categories table</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Categories list
                {{--<a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal"
                   data-target="#modaldemo3">Add new</a>--}}
                <a href="{{route('categories.create')}}" class="btn btn-sm btn-warning" style="float: right;">
                    Add new
                </a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-5p">№</th>
                        <th class="wd-25p">Category name</th>
                        <th class="wd-10p">Edit category</th>
                        <th class="wd-10p">Delete category</th>
                    </tr>
                    </thead>
                    <tbody>
                    @include('admin.errors')
                    @foreach($category as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            {{--<td>{{ $row->category_name }}</td>--}}
                            <td><a href="{{ route('categories.show', $row) }}">{{ $row->category_name }}</a></td>
                            <td>
                                <a href="{{ route('categories.edit', $row) }}"
                                   class="btn btn-sm btn-info">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('categories.destroy', $row) }}" method="POST">
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
    </div><!-- sl-pagebody -->

@endsection
