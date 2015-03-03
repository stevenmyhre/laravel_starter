@extends('auth.layout')

@section('content')


    <div id="register" class="row" style="margin: auto">
        <div class="large-6 large-offset-3 columns text-center">
            <p>
                Welcome to mPath!</p>
            <p>Register yourself a user below to get started:
            </p>
            <form class="form-horizontal" role="form" method="POST" action="/auth/register">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="code" value="{{ $code }}">

                <input type="text" class="border-radius-top" name="name" placeholder="Name" value="{{ old('name') }}">

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">

                <input type="password" placeholder="Password" name="password">

                <input type="password" name="password_confirmation" placeholder="Confirm Password">

                <button type="submit" class="button small border-radius-bottom">
                    Register
                </button>

            </form>
            @include('shared._alerts')
        </div>
    </div>
@endsection
