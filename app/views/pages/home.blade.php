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
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="subscribe-email" placeholder="أدخل عبارة للبحث عنها في الأرشيف.">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Latest news and latest videos. -->
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><a href="#">مدير جامعة القصيم يفتتح فعاليات يوم المهنة و200 وظيفة أمام خريجيها.</a></h1>
                <p>
                    <i class="fa fa-calendar-o"></i> نشر بتاريخ 24 يناير 2014.
                </p>
                <p>
                    وقد قص معاليه شريط المعرض وتجول في أركانه مكرماً رعاة المعرض والمشاركين فيه مؤكداً أن الجامعة تنظم يوم المهنة سنوياً كجزء من رسالتها في توعية خريجي الجامعة وتثقيفهم وتعريفهم بآليات البحث عن عمل وإعداد السيرة الذاتية وإجراءات المقابلة الشخصية، والتأهيل المهني. اضافة الى تعريف الخريجين بالفرص الوظيفية المتاحة لدى الجهات المشاركة.
                </p>
                <p>
                <a href="page.html" class="btn btn-primary btn-lg" role="button">المزيد</a>
                <a href="news.html" class="btn btn-default btn-lg" role="button">المزيد من الأخبار</a>
                </p>
            </div>
            <div class="col-md-6">
                <!-- 4:3 aspect ratio -->
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/XuTuCmjSbZI?rel=0&showinfo=0&controls=0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Matter Ones. -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2><a href="#">الجغرافيا في القصيم</a></h2>
            <p>يعد قسم الجغرافيا بكلية اللغة العربية والدراسات الاجتماعية بجامعة القصيم ضمن أقدم خمسة أقسام جغرافية على مستوى الجامعات السعودية، وكانت للقسم مشاركات علمية رائدة على مستوى الندوات الجغرافية، وخلال هذه المسيرة التي تقترب من ثلاثة عقود استطاع أن يضخ للمجتمع كوادر بشرية ساهمت في البناء والتنمية والتعليم لهذا الوطن.</p>
            <p>
                <a class="btn btn-default" href="#" role="button">المزيد</a>
            </p>
        </div>
        <div class="col-md-4">
            <h2><a href="#">وراج <small>(وحدة الرحلات الاستكشافية الجغرافية)</small></a></h2>
            <p>وراج وقام (العازمي، 2009) بقياس زحف الكثبان الهلالية في صحراء الدهناء, باستخدام مرئيات الاستشعار عن بعد للفترة من 2003م حتى 2007م، وتوصلت الدراسة إلى أن المعدل السنوي لزحف الكثبان الرملية خلال فترة الدراسة يبلغ 9,7م، وأن اتجاه زحف الكثبان الهلالية يتوافق مع اتجاه الرياح السائدة،</p>
            <p>
                <a class="btn btn-default" href="#" role="button">المزيد</a>
            </p>
        </div>
        <div class="col-md-4">
            <h2><a href="#">نشرة الرمة</a></h2>
            <p>كلمة الرمة باسم الله نبدأ، وبحمد لله نستفتح العدد الأول من نشرة «الرمة», الصادرة عن قسم الجغرافيا بجامعة القصيم، وهي وريقات جغرافية متواضعة، تعكس صورة ما جرى من قبل وما يجري حالياً في فلك الجغرافيين في القسم من أنشطة علمية، وأخبار جغرافية، ومخرجات معرفية، ورحلات ميد</p>
            <p>
                <a class="btn btn-primary" href="#" role="button">تحميل آخر نسخة <span>(PDF)</span></a>
                <a class="btn btn-default" href="#" role="button">نسخ سابقة</a>
            </p>
        </div>
    </div>
</div>

@stop