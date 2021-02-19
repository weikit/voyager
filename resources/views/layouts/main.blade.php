@php $uiUses = (array) $__env->yieldContent('ui_uses', 'bootstrap'); @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'WeiKit')">
    @yield('meta')

    @stack('before-styles')
    @stack('after-styles')
</head>

<body class="@yield('body_class')">
    <div id="@yield('wrapper_id', 'app')" class="@yield('wrapper_class')">
        @yield('content')
    </div>

    <!-- Scripts -->
    @stack('before-scripts')

        <script src="{{ mix('js/manifest.js', 'backend') }}"></script>
        <script src="{{ mix('js/vendor.js', 'backend') }}"></script>

@foreach($uiUses as $ui)

    @if($ui == 'quasar')

        <script src="{{ mix('js/quasar-vendor.js', 'backend') }}"></script>
        <script src="{{ mix('js/quasar.js', 'backend') }}"></script>

    @elseif ($ui == 'bootstrap')

        <script src="{{ mix('js/bootstrap-vendor.js', 'backend') }}"></script>
        <script src="{{ mix('js/bootstrap.js', 'backend') }}"></script>

    @endif

@endforeach

    @stack('after-scripts')
</body>
</html>
