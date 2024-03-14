@extends('admin.layouts.main')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Country Edit</h1>
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

                    <form action="{{route('admin.country.update')}}" method="POST" class="w-25">
                        @csrf
                        @method('PUT')
                        <input type="text" name="id" value="{{$country->id}}" class="form-control" required hidden >

                        @foreach(\App\Enums\Languages::getLanguages() as $item)

                        <div class="form-group">
                            <label>Name {{\App\Enums\Languages::getStringLanguage($item)}}</label>
                            <input type="text" name="{{$item}}-name" value="{{$country->name[$item]}}" class="form-control" required>
                        </div>

                        @endforeach

                        <div class="form-group">
                            <label>Numeric code</label>
                            <input type="text" name="numeric_code" value="{{$country->numeric_code}}" class="form-control" required >
                        </div>

                        <div class="form-group">
                            <label>Alpha code</label>
                            <input type="text" name="alpha_code" value="{{$country->alpha_code}}" class="form-control" required >
                        </div>

                        <div class="form-group">
                            <label>Full Alpha code</label>
                            <input type="text" name="full_alpha_code" value="{{$country->full_alpha_code}}" class="form-control" required >
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
