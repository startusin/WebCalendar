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
                                <ul class="ml-2">
                                    <li>{:HOUR:}</li>
                                    <li>{:DATE:}</li>
                                </ul>
                                <form id="formEmails" method="POST" action="{{route('sms.update')}}">
                                    @csrf
                                    <input name="calendar_id" value="{{auth()->user()->id}}"  hidden>

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">SMS Reminder - {{ $language }}</h5>

                                        <textarea name="sms-reminder_{{ $language }}" class="w-100" rows="4">
                                            {{ $settings->sms_reminder[$language] ?? 'Reminder sms' }}
                                        </textarea>
                                    @endforeach

                                    @foreach ($languages as $language)
                                        <h5 class="text-center mt-4 mb-3">SMS Sender From - {{ $language }}</h5>
                                        <input type="text" class="w-100" name="sms-sender_{{ $language }}" maxlength="10" value="{{ $settings->sms_sender[$language] ?? 'SMS' }}">
                                    @endforeach
                                    <h5 class="text-center mt-4 mb-3">Remind time (minutes)</h5>
                                    <input type="number" class="w-100" name="sms-remind-time" value="{{ $settings->sms_remind_time ?? '60' }}">
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
