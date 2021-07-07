<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    @include('frontend.partials.styles')
</head>
<body>
@include('frontend.partials.header')
@yield('content')
@include('frontend.partials.footer')
@include('frontend.partials.scripts')
</body>
</html>
