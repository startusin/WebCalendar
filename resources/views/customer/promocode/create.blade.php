@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create promocode</h1>
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

                        <form action="{{route('customer.promocode.store')}}" method="POST" class="w-25">
                            @csrf
                            <input name="calendar_id" value="{{auth()->user()->id}}" hidden >

                            <div class="form-group">
                                <label>Promocode</label>
                                <input type="text" name="promocode" class="form-control" required >
                                @error('promocode')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Price</label>
                                <input class="form-control" type="number"  step="0.01" name="price" required>
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Date</label>
                                <input  class="form-control" type="text" name="two-datetime" />
                            </div>
                            <div class="form-group">
                                <label>Product</label>
                                <select class="select2" name="product_id" style="width: 100%;">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <div class="text-danger">{{@$message}}</div>
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
