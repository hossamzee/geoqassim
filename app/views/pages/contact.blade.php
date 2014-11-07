@extends('layouts.default')

@section('title', 'اتصل بنا')
@section('content')

<!-- Map -->
<div id="map-canvas" class="carousel"></div>
<!-- Map end -->

<!-- Contact -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="page-header">
                <h3>اتصل بنا</h3>
            </div>
            <p>
                إنه من عمق مسؤوليتنا أن نسمع رأيك، نستقبل صوتك، و هذا ما نؤمن أنه سيقودنا إلى طريق التحسين، مرحباً بك بصدق.
            </p>
            {{ Form::open(['route' => 'contact_post']) }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('name', 'الاسم') }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('email', 'البريد الإلكتروني') }}
                            {{ Form::text('email', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('subject', 'الموضوع') }}
                            {{ Form::text('subject', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('content', 'المحتوى') }}
                            {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('إرسال الرسالة', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}<!--Contact form-->
        </div>
        <div class="col-md-4">
            <div class="page-header">
                <h3>معلومات الإتصال</h3>
            </div>
            <p class="margin-btm20">
                جامعة القصيم هي احدى جامعات المملكة العربية السعودية تقع في المليداء بمنطقة القصيم شمال غرب بريدة، وهي تحت إشراف وزارة التعليم العالي السعودية.
            </p>
            <ul class="list-unstyled contact-list margin-btm20">
                <li><i class="ion-home"></i> المملكة العربية السعودية، بريدة.</li>
                <li><i class="ion-ios7-mobile"></i> <strong>الجوّال:</strong> +911234567890</li>
                <li><i class="ion-ios7-telephone"></i> <strong>الهاتف:</strong> +911234567890</li>
                <li><i class="ion-ios7-email"></i> <strong>البريد الإلكتروني:</strong> mail@domain.com</li>
            </ul>
        </div>
    </div>
</div><!--Contact end-->

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>

<script type="text/javascript">

      var myLatlng;
      var map;
      var marker;

      function initialize() {

        myLatlng = new google.maps.LatLng(26.355394,43.75881);

        var mapOptions = {
          zoom: 13,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          scrollwheel: false,
          draggable: false
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Marker'
        });

      }

      google.maps.event.addDomListener(window, 'load', initialize);

</script>

@stop
