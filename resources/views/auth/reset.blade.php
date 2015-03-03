@extends('auth.layout')

@section('content')

    <div class="row">
        <div class="large-6 large-offset-3 columns text-center">
            <h3>Reset Password</h3>

            <form class="form-horizontal" role="form" method="POST" action="/password/reset">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <input type="email" class="border-radius-top" placeholder="Email" name="email"
                       value="{{ old('email') }}">

                <input type="password" placeholder="New Password" name="password">

                <input type="password" placeholder="Confirm Password" name="password_confirmation">

                <button type="submit" class="border-radius-bottom">
                    Reset Password
                </button>
            </form>
            @include('shared._alerts')
        </div>
    </div>
@endsection
