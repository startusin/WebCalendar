@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create product</h1>
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

                        <form action="{{route('customer.product.store')}}" method="POST" class="w-25">
                            @csrf
                            <input name="calendar_id" value="{{auth()->user()->id}}" hidden>
                            @error('custom_validation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @foreach($langs as $key => $lang)
                                <div class="form-group">
                                    <label>Title {{$lang}}</label>
                                    <input type="text" name="{{$key}}_title" class="form-control" required>
                                </div>


                                <div class="form-group">
                                    <label for="description">Short Description {{$lang}}</label>
                                    <textarea class="form-control" id="short_description"
                                              name="{{$key}}_short_description" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description {{$lang}}</label>
                                    <textarea class="form-control" id="description" name="{{$key}}_description"
                                              required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">Price {{$lang}}</label>
                                    <input class="form-control" type="number" step="0.01" name="{{$key}}_price" required>
                                </div>
                            @endforeach


                            <div class="form-group">
                                <label for="description">Max quantity</label>
                                <input class="form-control" type="number" name="max_qty" required>
                                @error('max_qty')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="submit" class="btn btn-primary" value="Create">
                        </form>
                    </div>

                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
