<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>قسم الجغرافيا في جامعة القصيم - منطقة الإدارة - @yield('title')</title>

    <link rel="stylesheet" href="/assets/stylesheets/geoqassim.css?version={{ $version }}" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- http://www.devnia.com/fonts/ -->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

@include('layouts.partials.messages')
@include('layouts.partials.admin.nav')

@yield('content')

<!-- Footer -->
<hr />

<div class="container text-muted">
    <ul class="list-inline">
      <li>منطقة الإدارة</li>
      <li>قسم الجغرافيا في جامعة القصيم</li>
      <li>{{ $version }}</li>
    </ul>
</div>

<!-- Bootstrap core JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>
