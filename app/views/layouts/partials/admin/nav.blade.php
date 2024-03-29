<!-- Navigation. -->
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#geoqassim-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin_home') }}"><img src="/assets/images/admin-logo.png"/></a>
            {{ link_to_route('home', '', null, ['class' => 'navbar-brand']) }}
        </div>
        <div class="navbar-collapse collapse" id="geoqassim-navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                <li>{{ link_to_route('admin_members_index', 'الأعضاء') }}</li>
                <li>{{ link_to_route('admin_news_index', 'الأخبار') }}</li>
                <li>{{ link_to_route('admin_pages_index', 'الصفحات') }}</li>
                <li>{{ link_to_route('admin_albums_index', 'الصور') }}</li>
                <li>{{ link_to_route('admin_videos_index', 'الفيديو') }}</li>
                <li>{{ link_to_route('admin_rummahs_index', 'الرمّة') }}</li>
                <!--<li>{{ link_to_route('admin_newsletters_index', 'القائمة البريديّة') }}</li>-->
                <li>{{ link_to_route('admin_categories_index', 'الأبحاث و الدراسات') }}</li>
                <li>{{ link_to_route('admin_users_index', 'المستخدمون') }}</li>
                <li><a href="{{ route('admin_users_logout') }}"><i class="fa fa-sign-out"></i></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-->
</div>

<div class="progress" id="progress-div" style="display: none;">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress"></div>
</div>
