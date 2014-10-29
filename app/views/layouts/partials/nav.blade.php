<!-- Navigation. -->
<div class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img src="/assets/images/logo.png"/></a>
            {{ link_to_route('home', '', null, ['class' => 'navbar-brand']) }}
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="members.html">الأعضاء</a></li>
                <li>{{ link_to_route('news', 'الأخبار') }}</li>
                <li><a href="page.html">الماجستير</a></li>
                <li><a href="page.html">الرمّة</a></li>
                <li><a href="page.html">وراج</a></li>
                <li><a href="photos.html">الصور</a></li>
                <li><a href="videos.html">الفيديو</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">الخرائط <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">خرائط Google</a></li>
                        <li><a href="#">خرائط الجمعية</a></li>
                    </ul>
                </li>
                <li><a href="page.html">الخدمات</a></li>
                <li>{{ link_to_route('contact', 'اتصل بنا') }}</li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-->
</div>