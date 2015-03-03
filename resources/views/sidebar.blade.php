@if(Context::is_currently_admin() && Request::is('admin/*'))
    <ul class="show-for-small-only">
        <li class="toggle-sidebar toggle-topbar">
            <a href="#"><span>Open Admin Nav</span></a>
        </li>
    </ul>
    <ul class="side-nav">
        <li class="{{ Request::is( 'admin/customer*') ? ' selected' : '' }}"><a href="/admin/customer">Customers</a></li>
        <li class="{{ Request::is( 'admin/user*') ? ' selected' : '' }}"><a href="/admin/user">Users</a></li>
        <li class="{{ Request::is( 'admin/dealer*') ? ' selected' : '' }}"><a href="/admin/dealer">Dealers</a></li>
        <li class="{{ Request::is( 'admin/device*') ? ' selected' : '' }}"><a href="/admin/device">Devices</a></li>
    </ul>
@elseif(Context::is_currently_dealer())
    <ul class="show-for-small-only">
        <li class="toggle-sidebar toggle-topbar">
            <a href="#"><span>Open Dealer Nav</span></a>
        </li>
    </ul>
    <ul class="side-nav">
        <li class="{{ Request::is( 'dealer/customer*') ? ' selected' : '' }}"><a href="/dealer/customer">Customers</a></li>
        <li class="{{ Request::is( 'dealer/user*') ? ' selected' : '' }}"><a href="/dealer/user">Users</a></li>
        <li class="{{ Request::is( 'dealer/device*') ? ' selected' : '' }}"><a href="/dealer/device">Devices</a></li>
    </ul>
@else
    <div>
        <pers-menu devices="devices" current-device="currentDevice"></pers-menu>
    </div>
@endif