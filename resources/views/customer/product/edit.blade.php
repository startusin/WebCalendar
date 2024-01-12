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
                            <input name="calendar_id" value="{{auth()->user()->id}}" hidden >
                            <input name="id" value="{{$product->id}}" hidden >
                            @error('custom_validation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="{{$product->title}}" class="form-control" required >
                                @error('title')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Short Description</label>
                                <textarea class="form-control"  id="short_description" name="short_description" required>{{$product->short_description}}</textarea>
                                @error('short_description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control"  id="description" name="description" required>{{$product->description}}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Price</label>
                                <input class="form-control" type="number" step="0.01" value="{{$product->price}}" name="price" required>
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Max quantity</label>
                                <input class="form-control"  type="number" value="{{$product->max_qty}}" name="max_qty" required>
                                @error('max_qty')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="submit" class="btn btn-primary" value="Edit">
                        </form>
                    </div>

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
