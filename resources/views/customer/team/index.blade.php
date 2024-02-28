@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My team</h1>
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
                        <a href="{{route('customer.team.create')}}" class="btn btn-primary">Create</a>
                    </div>
                    <div class="col-12 mt-2">

                        <div class="card">

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap ">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="col-2">Email</th>
                                        <th class="col-2">Full Name</th>
                                        <th class="col-2">Excluded Permissions</th>
                                        <th class="col-2">Date</th>
                                        <th class="col-4" colspan="3">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($team as $user)
                                        <tr>
                                            <td class="col-2">{{ $user->email }}</td>
                                            <td class="col-2">{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td class="col-2">{{ implode(',', $user->excluded_permissions ?? ['-']) }}</td>
                                            <td class="col-2">{{ $user->created_at }}</td>
                                                <td class="col-1"></td>
                                                <td class="col-2"><a href="{{route('customer.team.edit', $user->id)}}"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td class="col-1">
                                                    <form action="{{route('customer.team.delete',$user->id)}}" method="POST">
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
