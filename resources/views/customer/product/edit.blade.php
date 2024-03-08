@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit product</h1>
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
                        <form action="{{route('customer.product.update')}}" method="POST" class="w-25">
                            @csrf
                            @method('PUT')
                            <input name="calendar_id" value="{{request()->calendar_user->id}}" hidden >
                            <input name="id" value="{{$product->id}}" hidden >
                            @error('custom_validation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @foreach($product['title'] as $key => $value)
                                <div class="form-group">
                                    <label>Title {{\App\Enums\Languages::getStringLanguage($key)}}</label>
                                    <input type="text" name="{{$key}}_title" class="form-control" value="{{$value}}" required >
                                </div>
                            @endforeach
                            @foreach($product['short_description'] as $key => $value)
                                <div class="form-group">
                                    <label for="description">Short Description  {{\App\Enums\Languages::getStringLanguage($key)}}</label>
                                    <textarea class="form-control" id="short_description" name="{{$key}}_short_description"  required>{{$value}}</textarea>
                                </div>
                            @endforeach
                            @foreach($product['description'] as $key => $value)
                            <div class="form-group">
                                    <label for="description">Description  {{\App\Enums\Languages::getStringLanguage($key)}}</label>
                                    <textarea class="form-control" id="description" name="{{$key}}_description"  required>{{$value}}</textarea>
                                </div>
                            @endforeach

                            @foreach($product['price'] as $key => $value)
                                <div class="form-group">
                                    <label for="description">Price {{\App\Enums\Languages::getStringLanguage($key)}}</label>
                                    <input class="form-control" type="number" step="0.01" value="{{$value}}" name="{{$key}}_price" required>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label for="description">Max quantity</label>
                                <input class="form-control"  type="number" value="{{$product->max_qty}}" name="max_qty" required>
                                @error('max_qty')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="submit" class="btn mt-2  btn-primary" value="Edit">
                        </form>
                    </div>

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
