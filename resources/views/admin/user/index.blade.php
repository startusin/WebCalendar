@extends('admin.layouts.main')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard users</h1>
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
                    <a href="{{route('admin.user.create')}}" class="btn btn-primary">Create</a>
                </div>
                <div class="col-12 mt-2">

                    <div class="card">

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td><a class="showUser" href="#" data-route="{{ route('admin.user.show', $user->id) }}" data-toggle="modal" data-target="#showMyModal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                        <td><a href="{{route('admin.user.edit', $user->id)}}"><i class="fas fa-pencil-alt"></i></a></td>
                                        <td>
                                            <form action="{{route('admin.user.delete',$user->id)}}" method="POST">
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
        @include('admin.user.modals.showMyModal')
    </section>
    <!-- /.content -->
</div>
@endsection
