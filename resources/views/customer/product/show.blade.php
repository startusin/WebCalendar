@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Show product</h1>
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
                            <div class="form-group col-4">
                                <label>Title</label>
                                <p>{{$product->title}}</p>
                            </div>

                            <div class="form-group col-4">
                                <label for="description">Short Description</label>
                                <p>{{$product->short_description}}</p>
                            </div>

                            <div class="form-group col-4">
                                <label for="description">Description</label>
                                <p>{{$product->description}}</p>
                            </div>

                            <div class="form-group col-4">
                                <label for="description">Price</label>
                                <p>{{$product->price}}</p>
                            </div>

                            <div class="form-group col-4">
                                <label for="description">Max quantity</label>
                                <p>{{$product->max_qty}}</p>
                            </div>

                            <a  class="btn btn-primary ml-2"  href="{{route('customer.product.index')}}">Back</a>
                    </div>

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
