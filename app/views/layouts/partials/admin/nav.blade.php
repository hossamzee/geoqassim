<!-- Navigation. -->
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img src="/assets/images/admin.logo.png"/></a>
            {{ link_to_route('home', '', null, ['class' => 'navbar-brand']) }}
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="/admin/members">زيارة الموقع</a></li>
                <li><a href="/admin/members">الأعضاء</a></li>
                <li>{{ link_to_route('news', 'الأخبار') }}</li>
                <li><a href="/admin/pages">الصفحات</a></li>
                <li><a href="/admin/photos">الصور</a></li>
                <li><a href="/admin/videos">الفيديو</a></li>
                <li><a href="#">تسجيل الخروج</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-->
</div>