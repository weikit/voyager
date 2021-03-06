@extends('voyager::main')

@section('use_bootstrap', true)

@section('body_class', isset($dataType) && isset($dataType->slug) ? $dataType->slug : '')

@section('wrap_content')
    <div class="fadetoblack visible-xs"></div>
    <div class="content-container">
        <!-- Main Content -->
        @yield('page_header')
        <div id="voyager-notifications"></div>
        @yield('content')
    </div>
@endsection
