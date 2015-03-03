@extends('auth.layout')

@section('content')

    <div class="row">
        <div class="large-6 large-offset-3 columns text-center">
            <h3>Reset Password</h3>
            @if (session('status'))
                <div class="alert-box success">
                    {{ session('status') }}
                </div>
            @endif

            @include('shared._alerts')

            <form class="form-horizontal" role="form" method="POST" action="/password/email">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="email" class="border-radius-top" name="email" placeholder="Email" value="{{ old('email') }}">

                <button type="submit" class="border-radius-bottom">
                    Send Password Reset Link
                </button>
            </form>
        </div>
    </div>
@endsection
