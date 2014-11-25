@extends('layouts.admin.default')

@section('title', 'إضافة رمّة')
@section('content')

<!-- Add rummah -->
<div class="container">

    <!-- Step (1) -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة رمّة</h3>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        function afterSuccess(response)
        {
            // Get the URL.
            var url = response.url;

            $('#progress').removeClass('active');
            $('#progress').addClass('progress-bar-success');
            $('#upload-status-div').html('<div>تم رفع الرمّة بنجاح و إدراج رابط الرمّة في الأسفل.</div><br /><div><a class="btn btn-default" target="_blank" href="' + url + '">فتح الرمّة في لسان جديد</a> <a class="btn btn-default" href="#" onclick="resetUpload()">رفع رمّة أخرى</a></div>');

            // Set the value of the field.
            $('#url').val(url);
        }

    </script>

    @include('layouts.partials.admin.rummahs.upload')

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'admin_rummahs_store', 'files' => true]) }}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('version', 'العدد (الإصدار)') }}
                            {{ Form::text('version', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('description', 'الوصف') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('url', 'رابط النشرة (PDF)'); }}
                            {{ Form::text('url', null, ['class' => 'form-control', 'id' => 'url']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('cover', 'صورة الغلاف (اختياري)'); }}
                            {{ Form::file('cover') }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('إضافة الرمّة', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add rummah end-->

@stop
