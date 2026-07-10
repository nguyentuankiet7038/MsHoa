@extends(auth()->user()->role === 'student' ? 'layouts.app' : 'layouts.dashboard')

@section('title', 'Danh sách thông báo')

@section('content')
    @include('pages.notifications._list')
@endsection

@section('contentdashboard')
    @include('pages.notifications._list')
@endsection
