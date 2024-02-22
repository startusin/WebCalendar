@extends('admin.layouts.main')

@section('content')
    <iframe src="/calendar/{{ auth()->user()->alias }}?direct-booking=true" style="width: 100%; min-height: 800px;"></iframe>
@endsection
