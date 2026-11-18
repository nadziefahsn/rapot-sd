@extends('adminlte::auth.login')

@section('auth_header', 'Masuk untuk memulai sesi Anda')

@section('css')
<style>
    .login-logo a {
        font-size: 0 !important;
        line-height: 0 !important;
    }

    .login-logo a img {
        max-width: 100%;
        height: auto !important;
    }
</style>
@stop