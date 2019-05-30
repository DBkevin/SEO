<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')我的网站</title>
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
</head>

<body>
    @include('layouts._header')
    <div class="container-fluid centont">
        @section('centont')
        <div class="jumbotron">
            <h1>欢迎访问我的网站</h1>
            <p>欢迎访问我的网站</p>
            <P>
                想了解更多?</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">点击这里</a></p>
        </div>
        @show
    </div>
    @include('layouts._footer')
</body>

</html>