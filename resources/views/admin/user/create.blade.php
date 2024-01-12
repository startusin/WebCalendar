@extends('admin.layouts.main')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
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

                    <form action="{{route('admin.user.store')}}" method="POST" class="w-25">
                        @csrf
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" required >
                            @error('first_name')
                                <div class="text-danger">{{@$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                            @error('last_name')
                            <div class="text-danger">{{@$message}}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required >
                            @error('email')
                            <div class="text-danger">{{@$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" required >
                            @error('password')
                            <div class="text-danger">{{@$message}}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="languages">Languages</label>
                            <select class="select2" name="languages[]" id="languages" multiple="multiple" style="width: 100%;" required>
                                @foreach($languages as $key => $language)
                                    <option value="{{ $language }}">
                                        {{ $key }}
                                    </option>
                                @endforeach
                            </select>
                            @error('languages')
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
