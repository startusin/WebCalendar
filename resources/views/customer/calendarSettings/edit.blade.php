@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Calendar Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid mb-5">
                <!-- Small boxes (Stat box) -->
                <div class="row">

                    <div class="col-12">
                        <form action="{{route('calendarSettings.update')}}" method="POST" class="w-50" enctype="multipart/form-data">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            @method('PUT')
                            <input name="calendar_id" value="{{auth()->user()->id}}" hidden >

                            <div class="row">
                                @foreach($langs as $key => $language)
                                    <div class="col-sm-{{ 12 / count($langs) }}">
                                        <div class="form-group">
                                            <label>Default quantity for {{$language}}</label>
                                            <input type="number" name="{{$key}}-default_quantity" value="{{$settings['default_quantity'][$key]??3}}" class="form-control" required >
                                            @error('interval')
                                            <div class="text-danger">{{@$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row">
                                @foreach($langs as $key => $language)
                                    <div class="col-sm-{{ 12 / count($langs) }}">
                                        <div class="form-group">
                                            <label>Interval for {{$language}}</label>
                                            <input type="number" name="{{$key}}-interval" value="{{$settings['interval'][$key]??60}}" class="form-control" required >
                                            @error('interval')
                                            <div class="text-danger">{{@$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row">
                                @foreach($langs as $key => $language)
                                    <div class="col-sm-{{ 12 / count($langs) }}">
                                        <div class="form-group">
                                            <label>Working Hours (from) for {{$language}}</label>
                                            <input type="text" name="{{$key}}-working_hr_start" value="{{$settings['working_hr_start'][$key] ?? '08:00'}}" class="form-control" required >
                                            @error('working_hr_start')
                                            <div class="text-danger">{{@$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row">
                                @foreach($langs as $key => $language)
                                    <div class="col-sm-{{ 12 / count($langs) }}">
                                        <div class="form-group">
                                            <label>Working Hours (to) for {{$language}}</label>
                                            <input type="text" name="{{$key}}-working_hr_end" value="{{$settings['working_hr_end'][$key] ?? '20:00'}}" class="form-control" required >
                                            @error('working_hr_end')
                                            <div class="text-danger">{{@$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>Primary color</label>
                                <input type="color" name="primary_color" value="{{$settings['primary_color']}}" class="form-control" required >
                                @error('primary_color')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Secondary color</label>
                                <input type="color" name="secondary_color" value="{{$settings['secondary_color']}}" class="form-control" required >
                                @error('secondary_color')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Default Languages</label>
                                <select class="select2" name="language" style="width: 100%;">
                                    @foreach($langs as $key => $language)
                                        <option {{ $settings['language'] == $key ? 'selected' : ''}} value="{{ $key }}">
                                            {{ $language }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('language')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="languages">Excluded days</label>
                                <select class="select2" name="excluded_days[]" id="excluded_days" multiple="multiple" style="width: 100%;">
                                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                        <option {{ in_array($day, $settings['excluded_days'] ?? []) ? 'selected' : '1' }} value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                @error('excluded_days')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Country</label>
                                <table>
                                    @foreach($settings['countries'] as $item)
                                        <tr>
                                        <td class="pr-2">{{$item}} </td>
                                        <td><i class="fa-solid fa-trash"></i></td>
                                        </tr>
                                    @endforeach
                                </table>
                                <a class="mt-2 btn btn-primary" href="{{route('create.country')}}">Create Country</a>
                            </div>



                            <div class="form-group">
                                <label>Background color</label>
                                <input type="color" name="bg_color" value="{{$settings['bg_color']}}" class="form-control" required >
                                @error('bg_color')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>



                            <div>
                                <label >Background Image</label>
                            </div>
                            <div class="myImage BgImage">
                                <img src="{{ isset($settings['bg_image']) ? asset('storage/' . $settings['bg_image']) : '' }}" alt=""  style="width: 100%; height: 100%;border-radius:10px;">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <div class="custom-file">
                                    <input type="file" name="bg_image" id="bg_image" class="custom-file-input">
                                    <label class="custom-file-label">File</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>


                            <div>
                                <label >Logotype</label>
                            </div>
                            <div class="myImage logoImage">
                                <img src="{{ isset($settings['logo']) ? asset('storage/' . $settings['logo']) : '' }}" alt=""  style="width: 100%; height: 100%;border-radius:10px;">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <div class="custom-file">
                                    <input type="file" name="logo" id="logo" class="custom-file-input">
                                    <label class="custom-file-label">File</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>

                            <div>
                                <label >Banner</label>
                            </div>
                            <div class="myImage bannerImage">
                                <img src="{{ isset($settings['banner']) ? asset('storage/' . $settings['banner']) : '' }}" alt=""  style="width: 100%; height: 100%;border-radius:10px;">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <div class="custom-file">
                                    <input type="file" name="banner" id="banner" class="custom-file-input">
                                    <label class="custom-file-label">File</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@push('js')
    <script>
        let icons = document.querySelectorAll('.form-group table tr td i');

        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        icons.forEach(function(icon) {
            icon.addEventListener('click', function() {
                let countryName = this.parentElement.previousElementSibling.textContent.trim();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: '/deleteCountry',
                    type: 'DELETE',
                    contentType: 'application/json',
                    data: JSON.stringify({ country: countryName }),
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log('Помилка під час видалення країни ' + countryName);
                    }
                });
            });
        });


    </script>
@endpush
