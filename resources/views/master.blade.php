@extends('voyager::main')

@section('use_bootstrap', true)

@section('body_class', isset($dataType) && isset($dataType->slug) ? $dataType->slug : '')

@section('wrap_content')
    <div class="fadetoblack visible-xs"></div>
    <div class="row content-container">
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('page_header')
                <div id="voyager-notifications"></div>
                @yield('content')
            </div>
        </div>
    </div>
@endsection
