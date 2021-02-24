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

    @hasSection('use_quasar')
    <link rel="stylesheet" href="{{ mix('css/quasar.css', 'backend') }}">
    @endif

    @hasSection('use_bootstrap')
        <link rel="stylesheet" href="{{ mix('css/bootstrap.css', 'backend') }}">
    @endif

    @hasSection('use_layui')
        <link rel="stylesheet" href="{{ mix('vendor/layui.css', 'backend') }}">
        <link rel="stylesheet" href="{{ mix('css/layui.css', 'backend') }}">
    @endif

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
    <script type="text/javascript" src="{{ mix('vendor/common.js', 'backend') }}"></script>

    @hasSection('use_quasar')
        <script type="text/javascript" src="{{ mix('vendor/quasar.js', 'backend') }}"></script>
        <script type="text/javascript" src="{{ mix('js/quasar.js', 'backend') }}"></script>
    @endif

    @hasSection('use_bootstrap')
        <script type="text/javascript" src="{{ mix('vendor/bootstrap.js', 'backend') }}"></script>
        <script type="text/javascript" src="{{ mix('js/bootstrap.js', 'backend') }}"></script>
    @endif

    @hasSection('use_layui')
        <script type="text/javascript" src="{{ mix('vendor/layui.js', 'backend') }}"></script>
        <script type="text/javascript" src="{{ mix('js/layui.js', 'backend') }}"></script>
    @endif

    @stack('after_script')
</body>
</html>
