<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/assets/icons/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/icons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/icons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/icons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/assets/icons/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/assets/icons/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/assets/icons/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/assets/icons/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="/assets/icons/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="/assets/icons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="/assets/icons/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/assets/icons/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="/assets/icons/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="/assets/icons/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="/assets/icons/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="/assets/icons/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="/assets/icons/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="/assets/icons/mstile-310x310.png" />

    <title>قسم الجغرافيا في جامعة القصيم - تسجيل الدخول</title>

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

<body class="login-body">

    <!-- Login user -->
    <div class="container">

        {{ Form::open(['route' => 'users_login_post', 'class' => 'form-login']) }}

            <h2 class="form-login-heading">
                <img src="/assets/images/admin-logo.png" />
            </h2>

            {{ Form::label('username', 'اسم المستخدم', ['class' => 'sr-only']) }}
            {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'اسم المستخدم']) }}


            {{ Form::label('password', 'كلمة المرور', ['class' => 'sr-only']) }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'كلمة المرور']) }}

            {{ Form::submit('تسجيل الدخول', ['class' => 'btn btn-lg btn-primary btn-block']) }}

        {{ Form::close() }}

    </div>

<!-- Bootstrap core JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</body>

</html>