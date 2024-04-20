<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.metas')

    <!-- PAGE TITLE HERE -->
    <title>Admin Dashboard</title>

    @stack('css')
    @include('partials.styles')

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('layouts.nav-header')

        @include('layouts.header')

        @include('layouts.sidebar')

        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    @include('partials.scripts')

</body>

</html>