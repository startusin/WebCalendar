@extends('admin.layouts.main')

@section('content')
    <script src="https://cdn.tiny.cloud/1/ar5ocqumo4lqd1tble3coieldo40u53h4kgzoyzbmihhmi5d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '.email-templates',
            height: '480'
        });
    </script>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-2">
                         <form id="formEmails" method="POST" action="{{route('privacy.store')}}">
                                    @csrf
                                    <input name="calendar_id" value="{{auth()->user()->invited_by??auth()->user()->id}}" hidden>
                             @foreach(auth()->user()->languages as $item)
                                 <label>Footer text {{\App\Enums\Languages::getLanguageLabel($item)}}</label>
                                <textarea name="{{$item}}-footer_text" class="email-templates mt-2 " style=" min-height: 150px;">{{$settings->footer_text[$item]??""}}</textarea>

                                 <label>Title Button1 {{\App\Enums\Languages::getLanguageLabel($item)}}</label>
                                 <input name="{{$item}}-policy_1_title" type="text" class="form-control mt-2" value="{{$settings->policy_1['title'][$item]??""}}">
                                 <label>Content 1 {{\App\Enums\Languages::getLanguageLabel($item)}}</label>
                                 <textarea name="{{$item}}-policy_1_content" class="email-templates mt-2 " style=" min-height: 150px;">{{$settings->policy_1['content'][$item]??""}}</textarea>

                                 <label>Title Button2 {{\App\Enums\Languages::getLanguageLabel($item)}}</label>
                                 <input name="{{$item}}-policy_2_title" type="text" class="form-control mt-2"  value="{{$settings->policy_2['title'][$item]??""}}">
                                 <label>Content 2 {{\App\Enums\Languages::getLanguageLabel($item)}}</label>
                                 <textarea name="{{$item}}-policy_2_content" class="email-templates mt-2" style=" min-height: 150px;">{{$settings->policy_2['content'][$item]??""}}</textarea>

                                 <label>Title Button3 {{\App\Enums\Languages::getLanguageLabel($item)}}</label>
                                 <input name="{{$item}}-policy_3_title" type="text" class="form-control mt-2"  value="{{$settings->policy_3['title'][$item]??""}}">
                                 <label>Content 3 {{\App\Enums\Languages::getLanguageLabel($item)}}</label>
                                 <textarea name="{{$item}}-policy_3_content" class="email-templates mt-2" style=" min-height: 150px;">{{$settings->policy_3['content'][$item]??""}}</textarea>
                             @endforeach

                             <button type="submit" class="mt-2 btn btn-primary">Save</button>
                         </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
