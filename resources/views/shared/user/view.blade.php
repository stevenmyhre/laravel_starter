@extends('layout')

@section('scripts')
<script>
    function removeUser(event,id) {
        event.stopPropagation();
        event.preventDefault();
        if( !confirm('Remove User?') )
            return;

        var url = "{{$urlBase}}/user/remove/"+id;
        location.href = url;
        return;
    }
</script>
@endsection


@section('content')

@if($user)
<h2>User {{ $user->id }}</h2>
@if($user->user_type_id != App\PERS\UserType::$admin)
    <a class="button small" href="{{$urlBase}}/user/impersonate/{{ $user->id }}">Impersonate</a>
@endif
<a class="button small" href="" onclick="removeUser(event,{{ $user->id }});">Delete User</a>
<table class="table table-condensed" style="width: 400px">
    <tbody>
    <tr>
        <td>First Name</td>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td>User Type</td>
        <td>{{ $user->user_type->user_type_name }}</td>
    </tr>
    <tr>
        <td>Customer Account</td>
        <td>
        @if($user->customer == null)
            No customer attached
        @else
            <a href="/dealer/customer/view/{{ $user->customer->id}}">
            {{ $user->customer->full_name }}
            @if(!empty($user->customer->account_number))
                ( {{ $user->customer->account_number }} )
            @endif
            </a>
        @endif</td>
    </tr>
    <tr>
        <td>Created</td>
        <td>{{ $user->created_at }}</td>
    </tr>
    <tr>
        <td>Modified</td>
        <td>{{ $user->updated_at }}</td>
    </tr>

    </tbody>
</table>


@else
<h3>No user exists!</h3>
@endif
@endsection