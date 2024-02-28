@extends('admin.layouts.main')

@section('content')
    <script src="https://cdn.tiny.cloud/1/ar5ocqumo4lqd1tble3coieldo40u53h4kgzoyzbmihhmi5d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '.email-templates',
            height: '480',
            plugins: 'advcode'
        });
    </script>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Emails</h1>
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
                                <form id="formEmails" method="POST" action="{{route('emails.update')}}">
                                    @csrf
                                    <input name="calendar_id" value="{{auth()->user()->id}}"  hidden>

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" value="{{$settings->main_name}}" name="main_name" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" value="{{$settings->main_email}}" name="main_email" class="form-control">
                                    </div>

                                    <h4 class="mt-3 ml-3">Available shortcodes:</h4>
                                    <ul class="ml-2">
                                        <li>{:LOGOTYPE:}</li>
                                        <li>{:ITEMS:}</li>
                                        <li>{:LANGUAGE:}</li>
                                    </ul>

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">Customer satisfaction - {{ $language }}</h5>

                                        <textarea class="email-templates" name="cs-email_{{ $language }}">
                                            @if (isset($settings->cs_email[$language]) && !empty($settings->cs_email[$language]))
                                                {{ $settings->cs_email[$language] }}
                                            @else
                                                @include('customer.emails.email.cs')
                                            @endif
                                        </textarea>
                                    @endforeach

                                    <hr class="my-5" />

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">Purchase mail - {{ $language }}</h5>

                                        <textarea class="email-templates" name="purchase-email_{{ $language }}">
                                            @if (isset($settings->purchase_email[$language]) && !empty($settings->purchase_email[$language]))
                                                {{ $settings->purchase_email[$language] }}
                                            @else
                                                @include('customer.emails.email.purchase')
                                            @endif
                                        </textarea>
                                    @endforeach

                                    <hr class="my-5" />

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">Purchase mail admin - {{ $language }}</h5>

                                        <textarea class="email-templates" name="admin-email_{{ $language }}">
                                            @if (isset($settings->admin_email[$language]) && !empty($settings->admin_email[$language]))
                                                {{ $settings->admin_email[$language] }}
                                            @else
                                                @include('customer.emails.email.admin')
                                            @endif
                                        </textarea>
                                    @endforeach

                                    <h4 class="mt-5 ml-3">Available shortcodes:</h4>
                                    <ul class="ml-2">
                                        <li>{:TITLE:}</li>
                                        <li>{:QUANTITY:}</li>
                                        <li>{:PRICE:}</li>
                                        <li>{:TOTAL_PRICE:}</li>
                                        <li>{:LANGUAGE:}</li>
                                    </ul>

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">Item template - {{ $language }}</h5>

                                        <textarea class="email-templates" name="item-email_{{ $language }}">
                                            @if (isset($settings->item_email[$language]) && !empty($settings->item_email[$language]))
                                                {{ $settings->item_email[$language] }}
                                            @else
                                                @include('customer.emails.email.item')
                                            @endif
                                        </textarea>
                                    @endforeach

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">Customer satisfaction title - {{ $language }}</h5>
                                        <input type="text" class="w-100" name="title-email-cs_{{ $language }}" value="{{ $settings->cs_email_title[$language] ?? 'Customer satisfaction message' }}">
                                    @endforeach

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">Purchase title - {{ $language }}</h5>
                                        <input type="text" class="w-100" name="title-email-purchase_{{ $language }}" value="{{ $settings->purchase_email_title[$language] ?? 'Purchase message' }}">
                                    @endforeach

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">Purchase admin title - {{ $language }}</h5>
                                        <input type="text" class="w-100" name="title-admin-purchase_{{ $language }}" value="{{ $settings->admin_email_title[$language] ?? 'Purchase admin message' }}">
                                    @endforeach

                                    <h5 class="text-center mt-4 mb-3">Remind time (minutes)</h5>
                                    <input type="number" class="w-100" name="remind-time" value="{{ $settings->remind_time ?? '60' }}">
                                </form>

                            </div>

                            <!-- /.card-body -->
                        </div>
                        <div class="text-center">
                            <input class="btn btn-primary col-4 mt-3 mb-3" form="formEmails" type="submit" value="Save">
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
