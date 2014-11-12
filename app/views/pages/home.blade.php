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
                        $.getJSON("http://api.openweathermap.org/data/2.5/weather?q=Riyadh&&units=metric", function(data){
                            $("#weather-temp").html(data.main.temp + "°م");
                        });
                    })
                </script>

                <a href="#" class="btn btn-default">القصيم، درجة الحرارة <span id="weather-temp"></span></a>
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

<!-- Latest news and latest videos. -->
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if ($last_news)
                <h1>{{ link_to_route('news_show', $last_news->title, [$last_news->id]) }}</h1>
                <p>
                    <i class="fa fa-calendar-o"></i> نشر {{ $last_news->readable_created_at }}.
                </p>
                <p>{{ $last_news->snippet }}</p>
                <p>
                {{ link_to_route('news_show', 'المزيد', [$last_news->id], ['class' => 'btn btn-primary btn-lg', 'role' => 'button']) }}
                {{ link_to_route('news_index', 'المزيد من الأخبار', null, ['class' => 'btn btn-default btn-lg', 'role' => 'button']) }}
                </p>
                @endif
            </div>
            <div class="col-md-6">
                @if ($last_video)
                <!-- 4:3 aspect ratio -->
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{ $last_video->youtube_id }}?rel=0&showinfo=0&controls=0" allowfullscreen></iframe>
                </div>
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
            <p>يعد قسم الجغرافيا بكلية اللغة العربية والدراسات الاجتماعية بجامعة القصيم ضمن أقدم خمسة أقسام جغرافية على مستوى الجامعات السعودية، وكانت للقسم مشاركات علمية رائدة على مستوى الندوات الجغرافية، وخلال هذه المسيرة التي تقترب من ثلاثة عقود استطاع أن يضخ للمجتمع كوادر بشرية ساهمت في البناء والتنمية والتعليم لهذا الوطن.</p>
            <p>
                {{ link_to_route('pages_show', 'المزيد', ['1'], ['class' => 'btn btn-default']) }}
            </p>
        </div>
        <div class="col-md-4">
            <h2>{{ link_to_route('pages_show', 'وراج', ['3']) }} <small>(وحدة الرحلات الاستكشافية الجغرافية)</small></h2>
            <p>وراج وقام (العازمي، 2009) بقياس زحف الكثبان الهلالية في صحراء الدهناء, باستخدام مرئيات الاستشعار عن بعد للفترة من 2003م حتى 2007م، وتوصلت الدراسة إلى أن المعدل السنوي لزحف الكثبان الرملية خلال فترة الدراسة يبلغ 9,7م، وأن اتجاه زحف الكثبان الهلالية يتوافق مع اتجاه الرياح السائدة،</p>
            <p>
                {{ link_to_route('pages_show', 'المزيد', ['3'], ['class' => 'btn btn-default']) }}
            </p>
        </div>
        <div class="col-md-4">
            <h2>{{ link_to_route('rummahs_index', 'نشرة الرمة') }}</h2>
            <p>كلمة الرمة باسم الله نبدأ، وبحمد لله نستفتح العدد الأول من نشرة «الرمة», الصادرة عن قسم الجغرافيا بجامعة القصيم، وهي وريقات جغرافية متواضعة، تعكس صورة ما جرى من قبل وما يجري حالياً في فلك الجغرافيين في القسم من أنشطة علمية، وأخبار جغرافية، ومخرجات معرفية، ورحلات ميد</p>
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
