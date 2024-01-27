@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Custom Price</h1>
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

                        <form action="{{route('customer.price.update')}}" method="POST" class="w-25">
                            @csrf
                            @method('PUT')

                            <input name="id" value="{{$price->id}}" hidden >

                            <div class="form-group">
                                <label for="description">Price</label>
                                <input class="form-control" type="number" value="{{$price->price}}"  step="0.01" name="price" required>
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Date</label>
                                <input  class="form-control" type="text" name="two-datetime"  />
                            </div>

                            <div class="form-group">
                                <label>Product</label>
                                <select class="select2" name="product_id" style="width: 100%;">
                                    @foreach($products as $product)
                                        @foreach($product['title'] as $lg => $item)
                                            @if(\Illuminate\Support\Facades\Cookie::get('locale') == $lg)
                                                <option value="{{ $product->id }}" {{$product->id == $price->product_id ? "selected" : ""}} >
                                                    {{ $item }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>

                                @error('product_id')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <input type="submit" class="btn btn-primary" value="Edit">
                        </form>
                    </div>

                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
