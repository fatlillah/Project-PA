<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.metas')

    <!-- PAGE TITLE HERE -->
    <title>Admin Dashboard</title>

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

        @extends('layouts.header')

        @include('layouts.sidebar')

        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>




        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">DexignLab</a> 2021</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    @include('partials.scripts')

</body>

</html>