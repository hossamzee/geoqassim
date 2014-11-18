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

    <title>قسم الجغرافيا في جامعة القصيم - @yield('title')</title>

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
@include('layouts.partials.nav')

@yield('content')

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4>القائمة البريدية</h4>

                <p>
                {{ Form::open(['route' => 'newsletters_subscribe']) }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'أدخل بريدك الإلكتروني']) }}
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </span>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
                </p>
                <p>
                    تفضل بالاشتراك معنا في القائمة البريدية ليصلك جديد الموقع.
                </p>
                <p>
                    <a href="https://twitter.com/2013Qugeo" class="btn btn-info"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="btn btn-danger"><i class="fa fa-youtube"></i></a>
                </p>
            </div>
            <div class="col-md-4">
                <h4>آخر الأخبار</h4>
                <ul class="list-unstyled">
                    @foreach ($footer_latest_news as $footer_single_news)
                    <li><h5><span class="fa fa-file-o"></span> {{ link_to_route('news_show', $footer_single_news->title, [$footer_single_news->id]) }}</h5></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-2">
                <h4>صورة عشوائية</h4>
                <p>
                    @if ($footer_random_photo)
                      <a href="{{ route('photos_show', [$footer_random_photo->album_id, $footer_random_photo->id]) }}"><img src="{{ $footer_random_photo->thumb_url }}" class="img-thumbnail" alt="{{ $footer_random_photo->title }}" /></a>
                    @endif
                </p>
            </div>
            <div class="col-md-3">
                <h4>جميع الحقوق محفوظة <small>(2014)</small></h4>
                <ul class="list-unstyled">
                    <li><h5><span class="fa fa-code"></span> <a href="//hossamzee.github.io/about.html">تصميم و تطوير حسام الزغيبي</a></h5></li>
                    <li><h5><span class="fa fa-check"></span> <a href="mailto:hossam_zee@yahoo.com" >إبلاغ عن خطأ أو ملاحظة</a></h5></li>
                    <li>&nbsp;</li>
                    <li><h5>{{ $version }}</h5></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56731261-1', 'auto');
  ga('send', 'pageview');

</script>

</body>

</html>
