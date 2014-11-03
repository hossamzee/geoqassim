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
                <li>{{ link_to_route('admin_members_index', 'الأعضاء') }}</li>
                <li>{{ link_to_route('admin_news_index', 'الأخبار') }}</li>
                <li>{{ link_to_route('admin_pages_index', 'الصفحات') }}</li>
                <li>{{ link_to_route('admin_albums_index', 'الصور') }}</li>
                <li>{{ link_to_route('admin_videos_index', 'الفيديو') }}</li>
                <li>{{ link_to_route('admin_rummahs_index', 'الرمّة') }}</li>
                <li><a href="/admin/photos">القائمة البريدية</a></li>
                <li><a href="#">تسجيل الخروج</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-->
</div>
