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

                        <form action="{{route('admin.user.update')}}" method="POST" class="w-25">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" required>
                                @error('first_name')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" >
                                @error('last_name')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="{{$user->email}}" required>
                                @error('email')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>New password</label>
                                <input type="text" name="password" class="form-control">
                                @error('password')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Languages</label>
                                <select class="form-select js-choice" name="languages[]" multiple="multiple" data-placeholder="Вибрати теги"
                                        style="width: 100%;" required data-options='{"removeItemButton":true,"placeholder":true}'>
                                    @foreach($languages as $key => $language)
                                        <option {{in_array($language,  $user->languages) ? 'selected' : '1'}} value="{{ $language }}">
                                            {{ $key }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('languages_ids')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <input type="submit" class="btn mt-2 btn-primary" value="Edit">
                        </form>
                    </div>

                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
