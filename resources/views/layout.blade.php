<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>mPath</title>

    <link href="/vendor/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/dataTables.foundation.css" rel="stylesheet">
    <link href="/vendor/angular-ui-select/dist/select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/select2.css">
    <link rel="stylesheet" href="/vendor/angular-growl-v2/build/angular-growl.min.css">
    <link rel="stylesheet" href="/vendor/angular-busy/dist/angular-busy.min.css">
    {{--<link href="{{ elixir("site.min.css") }}" rel="stylesheet">--}}
    <link href="/css/site.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="full-width wrapper">
    <header>
        <nav class="top-bar" data-topbar role="navigation">
            <ul class="title-area">
                <li class="name">
                    <h1><a href="{{$homeUrl}}" title="mPath"><span class="logo"></span></a>
                    </h1>
                </li>

                <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
            </ul>
            <section class="top-bar-section">

                <!-- Right Nav Section -->
                <ul class="right">
                    <li><a href="{{$homeUrl}}">Home</a></li>
                    @if(!Context::is_currently_admin() && !Context::is_currently_dealer())
                        <li class="{{ Request::is( '/') ? ' active' : '' }}"><a href="/dashboard">Dashboard</a></li>
                        <li><a href="/#/contacts">Contacts</a></li>
                    @endif
                    @if(Context::is_currently_admin())
                        <li class="{{ Request::is( 'admin/*') ? ' active' : '' }}"><a href="/admin/customer">Admin</a></li>
                    @endif
                    @if(Auth::guest())
                        <li><a href="/auth/login">Log In</a></li>
                    @else
                        <li><a href="/auth/logout">Logout {{ Auth::user()->name }}</a></li>
                    @endif
                </ul>
                @if(Context::is_impersonating())
                    <ul class="left impersonating">
                        <li><a class=btn href="/auth/unimpersonate">
                                Cancel Impersonating {{Context::is_impersonating_user() ? 'User' : 'Customer'}}
                                {{ Context::impersonation_name() }}
                            </a>
                        </li>
                    </ul>
                @endif

            </section>
        </nav>
    </header>

    <section role="main">
        <div class="wrapper clearfix">
            <div class="sidebar">
                @include('sidebar')
            </div>
            <section class="content" data-ng-class="{loading: $root.loading}">
                <div class="row full-width">
                    <div class="small-12 columns">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>
    </section>


</div>
<footer>
    <div class="row full-width">
        <div class="small-12 columns">
            <p>
                Copyright &copy; 2015 | rockWilliRMR
            </p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="/vendor/jquery/dist/jquery.min.js"></script>
<script src="/vendor/foundation/js/foundation.min.js"></script>
<script src="/vendor/jQuery-Mask-Plugin/dist/jquery.mask.min.js"></script>
<script src="/vendor/mustache/mustache.min.js"></script>
<script src="/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.foundation.js"></script>
<script src="/vendor/lodash/dist/lodash.min.js"></script>
<script src="/vendor/moment/min/moment.min.js"></script>
<script src="/vendor/angular/angular.js"></script>
<script src="/vendor/angular-ui-router/release/angular-ui-router.js"></script>
<script src="/vendor/angular-ui-select/dist/select.min.js"></script>
<script src="/vendor/angular-growl-v2/build/angular-growl.min.js"></script>
<script src="/vendor/angular-animate/angular-animate.min.js"></script>
<script src="/vendor/angular-busy/dist/angular-busy.min.js"></script>
<script src="/vendor/angular-google-maps/dist/angular-google-maps.min.js"></script>
<script src="/js/site.js"></script>
<script type="text/javascript">
    $(function () {
        $(document).foundation();
        $('.toggle-sidebar').on('click', function () {
            $('.side-nav').toggleClass('opened');
        });
        $('.utc-dttm').each(function () {
            var t = moment.utc($(this).text()).local()
            $(this).text(t.format("L") + ' ' + t.format("LT"));
        });
        $('.phone').mask("(000) 000-0000");
        $('.mmyy').mask("00/00", {placeholder: '__/__'});
        $('form').submit(function () {
            $('.phone').unmask();
        })
        Mustache.tags = ['[[', ']]'];
    })


</script>
@yield('scripts')

</body>
</html>
