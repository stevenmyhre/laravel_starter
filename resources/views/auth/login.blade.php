@extends('auth.layout')

@section('content')



    <div id="login" class="row" style="margin: auto">
        <div class="large-6 large-offset-3 columns text-center">
            <img src="/img/logoWhite.png" alt="logo">

            <form class="form-horizontal" role="form" method="POST" action="/auth/login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input id="email" name="email" type="text" placeholder="Email" class="border-radius-top" value="{{ old('email') }}">

                <input id="password" name="password" type="password" placeholder="Password" class="no-radius">

                <button type="submit" class="button small border-radius-bottom coral-bg" style="width: 100%">Login
                </button>
            </form>
            <div class="panel-body">
                @include('shared._alerts')
            </div>
            <a href="/password/email">Forgot Your Password?</a>


        </div>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/jquery-ui/ui/effect.js"></script>
    <script src="/vendor/jquery-ui/ui/effect-shake.js"></script>
    <script>
        $(function() {
            @if(count($errors) > 0)
                $("#login").effect("shake");
            @endif
            $('#email').focus();
        });
    </script>
@endsection
