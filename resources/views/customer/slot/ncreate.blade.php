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
                                <input name="calendar_id" value="{{auth()->user()->id}}" hidden/>

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th class="col-1">ID</th>
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
                                    <tbody>
                                    @foreach($slots as $slot)
                                    <tr>
                                        <td class="align-middle">1</td>
                                        <td>
                                            <select name="dynamicSelect" class="select2" aria-label="Default select example">
                                                <option {{$slot['dynamicSelect'] == "months"?'selected':""}}  value="months">Range of month</option>
                                                <option {{$slot['dynamicSelect'] == "days"?'selected':""}}    value="days">Range of days</option>
                                                <option {{$slot['dynamicSelect'] == "customs"?'selected':""}} value="customs">Custom date Range</option>
                                                <option {{$slot['dynamicSelect'] == "allWeeks"?'selected':""}}value="allWeeks">All week</option>
                                            </select>
                                        </td>

                                        <td>
                                            <div>
                                                <select class="select2" name="language" style="width: 100%;">
                                                    @foreach($languages as $key => $language)
                                                        <option {{$language == $slot['language']?"selected":""}}  value="{{ $language }}">
                                                            {{ $key }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('language')
                                                <div class="text-danger">{{@$message}}</div>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="row Start">
                                                    <input type="text" name="start"  class="datetimes form-control"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="row End">
                                                    <input type="text" name="end"  class="datetimes form-control" />
                                                </div>
                                            </div>
                                        </td>
                                        <td><input name="fromHour" type="time" class="form-control" value="10:05 AM" /></td>
                                        <td><input name="toHour"   type="time" class="form-control" value="10:05 AM" /></td>
                                        <td>
                                            <div>
                                                <select class="select2" name="is_available" style="width: 100%;">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <div>
                                                <input type="number" name="quantity" class="form-control" required >
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                                <button  class="bg-transparent border-0 deleteBut">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                <button id="CreateBT">Add Row</button>
                                <button id="Save">Add Row</button>

                                <!-- /.card-body -->
                        </div>

                    </div>


                </div>
                <!-- /.row -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
