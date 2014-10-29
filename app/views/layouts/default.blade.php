<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>قسم الجغرافيا في جامعة القصيم - @yield('title')</title>

    <!-- CSS, TODO: Font Awesome to be local -->

    <link rel="stylesheet" href="/assets/stylesheets/geoqassim.css?version=1.0" />
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

@include('layouts.partials.nav')

@yield('content')

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4>القائمة البريدية</h4>

                <p>
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="subscribe-email" placeholder="أدخل بريدك الإلكتروني.">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </span>
                            </div>
                        </div>
                    </div>
                </form>
                </p>
                <p>
                    تفضل بالاشتراك معنا في القائمة البريدية ليصلك جديد الموقع.
                </p>
                <p>
                    <a href="#" class="btn btn-info"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="btn btn-warning"><i class="fa fa-rss"></i></a>
                </p>
            </div>
            <div class="col-md-3">
                <h4>آخر الأخبار</h4>
                <ul class="list-unstyled">
                    <li><span class="fa fa-file-o"></span> <a href="#">مدير جامعة القصيم يفتتح فعاليات يوم المهنة و200 وظيفة أمام خريجيها.</a></li>
                    <li><span class="fa fa-file-o"></span> <a href="#">نورة بنت محمد تزف 4914 خريجة من مختلف التخصصات.</a></li>
                    <li><span class="fa fa-file-o"></span> <a href="#">فيصل بن بندر يزف “14 ” خريجاً بدبلومات كلية المجتمع من الدفعة الثالثة في سجن بريدة.</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>صورة عشوائة</h4>
                <p>
                    <a href="#"><img src="/assets/images/photo1.jpg" class="img-responsive" /></a>
                </p>
            </div>
            <div class="col-md-3">
                <h4>جميع الحقوق محفوظة <small>(2014)</small></h4>
                <p>
                    <a href="#" class="btn btn-default btn-sm">تصميم و تطوير حسام الزغيبي</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- TODO: Bootstrap core JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>