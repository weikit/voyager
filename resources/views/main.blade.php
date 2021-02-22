<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'WeiKit')">
    @yield('meta')

    @stack('before_style')

    <link rel="stylesheet" href="{{ mix('css/common.css', 'backend') }}">

    <link rel="stylesheet" href="{{ mix('css/quasar.css', 'backend') }}">

    @stack('after_style')
</head>

<body class="voyager @yield('body_class')">
    @yield('before_content')

    <div id="@yield('wrapper_id', 'app')" class="@yield('wrapper_class')">
    @hasSection('wrap_content')
        @yield('wrap_content')
    @endif

    @sectionMissing('wrap_content')
        @yield('content')
    @endif
    </div>

    @yield('after_content')

    @stack('before_script')

    <script type="text/javascript" src="{{ mix('js/manifest.js', 'backend') }}"></script>
    <script type="text/javascript" src="{{ mix('js/vendor.js', 'backend') }}"></script>

    <script type="text/javascript" src="{{ mix('js/quasar-vendor.js', 'backend') }}"></script>
    <script type="text/javascript" src="{{ mix('js/quasar.js', 'backend') }}"></script>

    @stack('after_script')
</body>
</html>
