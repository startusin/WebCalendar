@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit user</h1>
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

                        <form action="{{route('customer.team.update')}}" method="POST" class="w-25">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="email" name="email" class="form-control" required value="{{ $user->email }}">
                                @error('email')
                                <div class="text-danger">{{@$email}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" required value="{{ $user->first_name }}">
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" required value="{{ $user->last_name }}">
                            </div>

                            <div class="form-group">
                                <label for="languages">Excluded permissions</label>
                                <select class="select2" name="excluded_permissions[]" id="excluded_permissions" multiple="multiple" style="width: 100%;">
                                    @foreach(['slot', 'product', 'custom_prices', 'brunch', 'history_purchases', 'promocode'] as $permission)
                                        <option {{ in_array($permission, $user->excluded_permissions ?? []) ? 'selected' : '1' }} value="{{ $permission }}">{{ $permission }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="number" value="{{$user->id}}" name="id" class="form-control" hidden>

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
