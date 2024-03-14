@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-2">
                        <form id="formEmails" method="POST" action="{{route('styles.store')}}">
                            @csrf
                            <input name="calendar_id" value="{{auth()->user()->invited_by??auth()->user()->id}}" hidden>


                            <label>Custom Style</label>
                            <textarea name="custom_styles" class="form-control mt-2 " style=" min-height: 150px;">{{$settings['custom_styles']??""}}</textarea>

                            <label>Custom Script</label>
                            <textarea name="custom_script" class="form-control mt-2 " style=" min-height: 150px;">{{$settings['custom_script']??""}}</textarea>



                            <button type="submit" class="mt-2 btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
