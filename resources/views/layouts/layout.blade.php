<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    @yield('header')

    @yield('content')

    @yield('footer')
    <!-- jquery読みこみ -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        'use strict';

        $('.nav_toggle').on('click', function() {
            $('.nav_toggle, .nav').toggleClass('show');
        });

        function checkSubmit() {
            if (window.confirm('送信してよろしいですか？')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>