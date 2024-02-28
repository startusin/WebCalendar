@extends('admin.layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <button class="col-2 btn btn-primary ml-3 mb-3"  id="Save">Save</button>
        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">

                                <div id="tableContainer"></div>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                <input name="calendar_id" value="{{request()->calendar_user->id}}" hidden/>

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th class="col-1">Type</th>
                                        <th class="col-1">Language</th>
                                        <th class="col-1">Start</th>
                                        <th class="col-1">End</th>
                                        <th class="col-1">From Hours</th>
                                        <th class="col-1">To Hours</th>
                                        <th class="col-1">Available</th>
                                        <th class="col-1">Quantity</th>
                                        <th class="col-1">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable" style="cursor: pointer;">

                                    </tbody>
                                </table>



                                <!-- /.card-body -->
                        </div>
                            <button class="col-2 btn btn-primary mt-3 ml-4 mb-3"  id="CreateBT">Add Row</button>
                    </div>


                </div>
                <!-- /.row -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@push('js')
    <script src="{{asset('assets/js/slots.js')}}"></script>
@endpush
