@extends('layouts.default')

@section('title', 'الرئيسية')
@section('content')

<!-- Header. -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-4 hidden-xs">
                <script>
                    $(function(){

                        $.ajaxSetup({ cache: false });

                        // Hide the weather links and icons untill the weather is being read.
                        $('.not-ready-link').hide();

                        $.getJSON('http://api.openweathermap.org/data/2.5/weather?lat=26.33&lon=43.97&units=metric', function(data){

                            $('#weather-temp').html(data.main.temp + '°م');
                            $('#weather-pressure').html(data.main.pressure + 'م');
                            $('#weather-humidity').html(data.main.humidity + '%');
                            $('#weather-wind').html(data.wind.speed + 'كم، ' + data.wind.deg + '°');

                            // Show the icons and hide the waiting link.
                            $('.not-ready-link').show();
                            $('#waiting').hide();
                        });
                    })
                </script>

                <a href="#" class="btn btn-link" title="معلومات الطقس مقدّمة من openweathermap.org">طقس القصيم الآن</a>
                <a href="#" class="btn btn-link disabled" id="waiting">يجري جلب معلومات الطقس...</a>
                <a href="#" class="btn btn-link not-ready-link" title="درجة الحرارة"><i class="fa fa-sun-o"></i> <span id="weather-temp"></span></a>
                <a href="#" class="btn btn-link not-ready-link" title="الضغط الجوّي"><i class="fa fa-cloud-download"></i> <span id="weather-pressure"></span></a>
                <a href="#" class="btn btn-link not-ready-link" title="الرطوبة"><i class="fa fa-tint"></i> <span id="weather-humidity"></span></a>
                <a href="#" class="btn btn-link not-ready-link" title="الرياح"><i class="fa fa-paper-plane"></i> <span id="weather-wind"></span></a>

            </div>
            <div class="col-md-6 col-sm-8">
                {{ Form::open(['route' => 'search']) }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                {{ Form::text('query', null, ['class' => 'form-control', 'placeholder' => 'أدخل عبارة للبحث عنها في الأرشيف.']) }}
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </span>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</header>

<!-- Latest news and a random photo -->
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @foreach ($last_news as $single_last_news)

                <div class="row">
                    <div class="col-md-12">

                        <h4>
                          {{ link_to_route('news_show', $single_last_news->title, [$single_last_news->id]) }}
                        </h4>

                        <div class="pull-right">
                          @if ($single_last_news->main_photo)
                            <img src="{{ $single_last_news->main_photo }}" class="img-thumbnail img-latest-news" />
                          @else
                            <img src="/assets/images/default-thumb.png" class="img-thumbnail img-latest-news" />
                          @endif
                        </div>

                        <p>
                          {{ $single_last_news->snippet }}
                        </p>

                        <p class="text-left">
                          <a href="#" class="btn btn-link disabled"><i class="fa fa-calendar-o"></i> نشر {{ $single_last_news->readable_created_at }}</a>
                          {{ link_to_route('news_show', 'المزيد', [$single_last_news->id], ['class' => 'btn btn-primary', 'role' => 'button']) }}
                        </p>

                    </div>
                </div>

                @endforeach
            </div>
            <div class="col-md-6">
                @if ($random_photo)
                  <a href="{{ route('photos_show', [$random_photo->album_id, $random_photo->id]) }}"><img src="{{ $random_photo->large_url }}" class="img-responsive img-featured" /></a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Matter Ones. -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>{{ link_to_route('pages_show', 'الجغرافيا في القصيم', ['1']) }}</h2>

            @if ($about_page)
            <p>{{ $about_page->snippet }}</p>
            @endif

            <p>
                {{ link_to_route('pages_show', 'المزيد', ['1'], ['class' => 'btn btn-default']) }}
            </p>
        </div>
        <div class="col-md-4">
            <h2>{{ link_to_route('pages_show', 'وراج', ['3']) }} <small>(وحدة الرحلات الاستكشافية الجغرافية)</small></h2>

            @if ($wraj_page)
            <p>{{ $wraj_page->snippet }}</p>
            @endif

            <p>
                {{ link_to_route('pages_show', 'المزيد', ['3'], ['class' => 'btn btn-default']) }}
            </p>
        </div>
        <div class="col-md-4">
            <h2>{{ link_to_route('rummahs_index', 'نشرة الرمة') }}</h2>
            <p>نشرة «الرمة» تصدر عن قسم الجغرافيا بجامعة القصيم، وهي وريقات جغرافية متواضعة، تعكس صورة ما جرى من قبل، وما يجري حالياً في فلك الجغرافيين في القسم من أنشطة علمية، وأخبار جغرافية، ومخرجات معرفية، ورحلات ميدانية، نستهدف بها، ونأمل منها مد جسر التوصل مع الأقسام والكليات والعمادات بجامعة القصيم أولاً، والجامعات الأخرى ثانياً، وعموم المتابعين ثالثاً، وتجدر الإشارة إلى أن مشاركات الزملاء تم اختصارها واختزالها بصورة نرجو ألا تكون مخلة، بسبب ضيق المساحة. مع تحياتي الرمة.</p>
            <p>
                @if ($last_rummah)
                {{ link_to_route('rummahs_show', 'تحميل آخر نسخة (PDF)', [$last_rummah->id], ['class' => 'btn btn-primary']) }}
                {{ link_to_route('rummahs_index', 'نسخ سابقة', null, ['class' => 'btn btn-default']) }}
                @endif
            </p>
        </div>
    </div>
</div>

@stop
