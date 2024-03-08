@extends('admin.layouts.main')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Country</h1>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <form action="{{route('store.country')}}" method="POST" class="w-25">
                            @csrf
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" required >
                            </div>
                            <input type="submit" class="btn mt-2 btn-primary" value="Create">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection


