@extends('layouts.admin.default')

@section('title', 'إضافة بحث و دراسة')
@section('content')

<!-- Add research -->
<div class="container">

    <!-- Step (1) -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة بحث و دراسة</h3>
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
            $('#upload-status-div').html('<div>تم رفع البحث و دراسة بنجاح و إدراج رابط البحث و دراسة في الأسفل.</div><br /><div><a class="btn btn-default" target="_blank" href="' + url + '">فتح البحث و دراسة في لسان جديد</a> <a class="btn btn-default" href="#" onclick="resetUpload()">رفع بحث و دراسة أخرى</a></div>');

            // Set the value of the field.
            $('#url').val(url);
        }

    </script>

    @include('layouts.partials.admin.researches.upload')

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'admin_researches_store', 'files' => true]) }}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('author', 'المؤلف') }}
                            {{ Form::text('author', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('url', 'رابط البحث و الدراسة (PDF)'); }}
                            {{ Form::text('url', null, ['class' => 'form-control', 'id' => 'url']) }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('إضافة البحث و دراسة', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add research end-->

@stop
