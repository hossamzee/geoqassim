<!-- Navigation. -->
<div class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#geoqassim-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img src="/assets/images/logo.png" alt="قسم الجغرافيا في جامعة القصيم" /></a>
            {{ link_to_route('home', '', null, ['class' => 'navbar-brand']) }}
        </div>
        <div class="navbar-collapse collapse" id="geoqassim-navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>{{ link_to_route('pages_show', 'عن القسم', ['1']) }}</li>
                <li>{{ link_to_route('members_index', 'الأعضاء') }}</li>
                <li>{{ link_to_route('news_index', 'الأخبار') }}</li>
                <li>{{ link_to_route('students_index', 'الطلاب') }}</li>
                <li>{{ link_to_route('ads_index', 'الإعلانات') }}</li>
                <li>{{ link_to_route('rummahs_index', 'الرمّة') }}</li>
                <li>{{ link_to_route('categories_index', 'الأبحاث و الدراسات') }}</li>
                <li>{{ link_to_route('albums_index', 'الصور') }}</li>
                <li>{{ link_to_route('videos_index', 'الفيديو') }}</li>
                <li>{{ link_to_route('pages_show', 'الخرائط', ['5']) }}</li>
                <li>{{ link_to_route('pages_show', 'الخدمات', ['4']) }}</li>
                <li>{{ link_to_route('contact_get', 'اتصل بنا') }}</li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-->
</div>
