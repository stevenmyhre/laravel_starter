@extends('layout')

@section('content')

    <div class="row full-width">
        <div class="large-12 medium-12 small-12 columns">
            <div class="custom-panel">
                <div></div>
                Admin Index view
                {{ var_export($resp) }}
            </div>
        </div>
    </div>
@endsection