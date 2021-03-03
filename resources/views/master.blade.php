@extends('voyager::main')

@section('use_bootstrap', true)

@section('body_class', isset($dataType) && isset($dataType->slug) ? $dataType->slug : '')

@section('wrap_content')
    <div id="voyager-loader">
        <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
        @if($admin_loader_img == '')
            <img src="{{ voyager_asset('images/logo-icon.png') }}" alt="Voyager Loader">
        @else
            <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader">
        @endif
    </div>

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
