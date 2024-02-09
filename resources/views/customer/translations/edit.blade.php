@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Translations</h1>
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

                    <div class="col-12 mt-2">

                        <div class="card">

                            <div class="card-body table-responsive p-0">
                                <form  id="formTranslations" action="{{route('translations.update')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input name="calendar_id" value="{{auth()->user()->id}}"  hidden>
                                <table class="table table-hover text-nowrap ">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="col-2">Key</th>
                                        @foreach(auth()->user()->languages as $key)
                                            <th class="col-2">{{$key}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($translations as $key => $array)
                                            <tr>
                                                <td>{{$key}}</td>
                                                @foreach(auth()->user()->languages as $language)
                                                    <th class="col-2"><input class="form-control" value="{{$array[$language]??""}}" name="{{$language}}_{{$key}}"></th>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </form>

                            </div>

                            <!-- /.card-body -->
                        </div>
                        <div class="text-center">
                            <input class="btn btn-primary col-4 mt-3" form="formTranslations" type="submit" value="Save">
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
