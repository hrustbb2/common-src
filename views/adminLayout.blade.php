<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @stack('styles')
    </head>
    <body>
        <div class="wrapper openned-sidebar js-wrapper">
            <header class="main-header js-main-header">
                <nav class="navbar navbar-static-top">
                    <div class="sidebar-toggle js-sidebar-toggle-button">
                        <span class="fas fa-bars"></span>
                    </div>
                </nav>
            </header>

            <article class="article">
                @yield('sideBar')

                <div class="content-wrapper">
                    <section class="content-header">
                        @yield('breadcrumbs')
                    </section>

                    @yield('content')
                </div>
            </article>
        </div>
        @stack('scripts')
    </body>
</html>
