<?php
$message = Session::get('message');
$error = Session::get('error');
$priv = Context::isPowerUser();

?>

@if($error)
    <div data-alert class="alert-box alert">
        {{ $error }}
        <a href="#" class="close">&times;</a>
    </div>
@endif

@if($errors->any())
    <div class="alert-box warning">
        There are one or more errors in the form - please correct them and try again:
        <ul>
            @foreach($errors->all() as $err)
                <li>{{$err}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($message)
    <div data-alert class="alert-box success">
        {{ $message }}
        <a href="#" class="close">&times;</a>
    </div>
@endif