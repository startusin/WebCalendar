@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard brunches</h1>
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
                    <div class="col-1">
                        <a href="{{route('customer.brunch.create')}}" class="btn btn-primary">Create</a>
                    </div>
                    <div class="col-12 mt-2">

                        <div class="card">

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap ">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="col-2">ID</th>
                                        <th class="col-2">Time</th>
                                        <th class="col-2">Price</th>
                                        <th class="col-2">Excluded Days</th>
                                        <th class="col-4" colspan="3">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($brunches as $brunch)
                                        <tr>
                                            <td  class="col-2">{{ $brunch->id }}</td>
                                            <td  class="col-2">{{ $brunch->time }}</td>
                                            <td  class="col-2">{{ $brunch->price }}</td>
                                            <td  class="col-2">{{ implode(', ', $brunch->excluded_days ?? []) }}</td>
                                                <td class="col-1"></td>
                                                <td class="col-2"><a href="{{route('customer.brunch.edit', $brunch->id)}}"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td class="col-1">
                                                    <form action="{{route('customer.brunch.delete',$brunch->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="bg-transparent border-0">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
