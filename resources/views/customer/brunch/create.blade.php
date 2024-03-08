@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create brunch</h1>
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

                        <form action="{{route('customer.brunch.store')}}" method="POST" class="w-25">
                            @csrf

                            <div class="form-group">
                                <label>Time</label>
                                <input type="text" name="time" class="form-control" required value="10:00">
                                @error('time')
                                <div class="text-danger">{{@$time}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control" required value="1" >
                                @error('quantity')
                                <div class="text-danger">{{@$quantity}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control" required value="1.00" >
                                @error('price')
                                <div class="text-danger">{{@$price}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="languages">Excluded days</label>
                                <select class="form-select js-choice" name="excluded_days[]" id="excluded_days" multiple="multiple" style="width: 100%;"  data-options='{"removeItemButton":true,"placeholder":true}'>
                                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                @error('excluded_days')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <input type="submit" class="btn mt-2 btn-primary" value="Create">
                        </form>
                    </div>

                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
