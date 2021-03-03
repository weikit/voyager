@extends('voyager::main')

@section('use_vuetify', true)

@section('wrap_content')
    <v-app>
        @yield('content')
    </v-app>
@endsection
