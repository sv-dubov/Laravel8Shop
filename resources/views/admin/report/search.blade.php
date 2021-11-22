@extends('admin._layout')

@section('admin')

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Search report</h5>
        </div><!-- sl-page-title -->

        <div class="row">
            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form action="{{ route('admin.search.by-date') }}" method="post">
                            @csrf
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Search by date</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="date">
                                </div>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">See</button>
                            </div>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div>

            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form action="{{ route('admin.search.by-month') }}" method="post">
                            @csrf
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Search by month</label>
                                    <select class="form-control" name="month">
                                        <option value="january">January</option>
                                        <option value="february">February</option>
                                        <option value="march">March</option>
                                        <option value="april">April</option>
                                        <option value="may">May</option>
                                        <option value="jun">Jun</option>
                                        <option value="july">July</option>
                                        <option value="august">August</option>
                                        <option value="september">September</option>
                                        <option value="october">October</option>
                                        <option value="november">November</option>
                                        <option value="december">December</option>
                                    </select>
                                </div>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">See</button>
                            </div>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div>

            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form action="{{ route('admin.search.by-year') }}" method="post">
                            @csrf
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Search by year</label>
                                    <select class="form-control" name="year">
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">See</button>
                            </div>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div>
        </div>
    </div><!-- sl-pagebody -->

@endsection
