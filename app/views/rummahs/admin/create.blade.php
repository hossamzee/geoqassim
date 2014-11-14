@extends('layouts.admin.default')

@section('title', 'إضافة رمّة')
@section('content')

<script type="text/javascript" src="http://www.sanwebe.com/assets/ajax-image-upload-progressbar/js/jquery.form.min.js"></script>

<script type="text/javascript">

    $(function(){

        $('#progress-div').hide();

        var options = {
                target: null,
                beforeSubmit: beforeSubmit,
                uploadProgress: OnProgress, //upload progress callback
                success: afterSuccess,
                error: afterError,
                resetForm: true
        };

        $('#upload-form').submit(function() {
            $(this).ajaxSubmit(options);
            return false;
        });
    });

    function beforeSubmit()
    {
        // TODO: The file should be checked if it is PDF.
        $('#progress-div').show();
        $('#upload-div').html('يجري رفع الملف، لحظات من فضلك...');
    }

    function OnProgress(event, position, total, percentComplete)
    {
        $('#progress').attr('aria-valuenow', percentComplete);
        $('#progress').width(percentComplete + '%');
    }

    function afterSuccess(response)
    {
        // Get the URL.
        var url = response.url;

        $('#progress').removeClass('active');
        $('#progress').addClass('progress-bar-success');
        $('#upload-div').html('تم رفع الملف بنجاح و إدراج رابط النشرة في الأسفل.<br /><a target="_blank" href="' + url + '" class="btn btn-link">' + url + '</a>');

        // Set the value of the field.
        $('#url').val(url);
    }

    function afterError(response)
    {
        $('#progress').removeClass('active');
        $('#progress').addClass('progress-bar-danger');
        $('#upload-div').html('لا يمكن رفع الملف ، إمّا لخطأ في الإدخال أو لخطأ في الخادم.');
    }

</script>

<div id="output"></div>

<div class="progress" id="progress-div">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress"></div>
</div>

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

    <div class="row well">
        <div class="col-md-12" id="upload-div">
            {{ Form::open(['route' => 'admin_rummahs_upload', 'files' => true, 'id' => 'upload-form']) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('title', 'ملف PDF (إن وُجد)') }}
                            {{ Form::file('pdf') }}
                            <p class="help-block">في حال لم يتم رفع النشرة إلى أيّ خادم آخر؛ قم برفع الملف من هنا.</p>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('رفع ملف PDF', ['class' => 'btn btn-default']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>

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
                            {{ Form::label('cover', 'صورة الغلاف'); }}
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
