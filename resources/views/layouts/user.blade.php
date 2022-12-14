<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('imgs/Intelectologo.svg')}}" type="image/svg+xml" sizes="32x32">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <x-userside-styles></x-userside-styles>


</head>
<body style="height: 100vh">
<!-- ======= Header ======= -->
<x-userside-header></x-userside-header>

@yield('main')

<x-userside-scripts></x-userside-scripts>

@yield('scripts')


</body>

</html>
