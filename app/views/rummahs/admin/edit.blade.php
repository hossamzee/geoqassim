@extends('layouts.admin.default')

@section('title', 'تعديل رمّة - '. $rummah->title)
@section('content')

<script type="text/javascript" src="http://www.sanwebe.com/assets/ajax-image-upload-progressbar/js/jquery.form.min.js"></script>

<script type="text/javascript">

    $(function(){

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

<!-- Edit rummah -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل رمّة - {{$rummah->title }}</h3>
            </div>
        </div>
    </div>

    <div class="row well">
        <div class="col-md-12" id="upload-div">
            {{ Form::open(['route' => 'admin_rummahs_upload', 'files' => true, 'id' => 'upload-form']) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('title', 'ملف PDF (اختياري)') }}
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
            {{ Form::open(['route' => ['admin_rummahs_update', $rummah->id], 'files' => true]) }}
              <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                          {{ Form::label('title', 'العنوان') }}
                          {{ Form::text('title', $rummah->title, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          {{ Form::label('version', 'العدد (الإصدار)') }}
                          {{ Form::text('version', $rummah->version, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                          {{ Form::label('description', 'الوصف') }}
                          {{ Form::textarea('description', $rummah->description, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                          {{ Form::label('url', 'رابط النشرة (PDF)'); }}
                          {{ Form::text('url', $rummah->url, ['class' => 'form-control', 'id' => 'url']) }}
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                          <img src="{{ $rummah->cover_url }}" class="img-responsive" />
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                          {{ Form::label('cover', 'صورة الغلاف'); }}
                          {{ Form::file('cover') }}
                      </div>
                  </div>
                  <div class="col-md-12 text-right">
                      {{ Form::submit('تعديل الرمّة', ['class' => 'btn btn-primary btn-lg']) }}
                  </div>
              </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit rummah end-->

@stop
