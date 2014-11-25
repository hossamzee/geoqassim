@extends('layouts.admin.default')

@section('title', 'تعديل خبر - '. $news->title)
@section('content')

<!-- Add news -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل خبر - {{$news->title }}</h3>
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
            $('#upload-status-div').html('<div>تم رفع الصورة بنجاح و إدراج رابط الصورة في المحتوى.</div><br /><div><a class="btn btn-default" target="_blank" href="' + url + '">فتح الصورة في لسان جديد</a> <a class="btn btn-default" href="#" onclick="resetUpload()">رفع صورة أخرى</a></div>');

            // Set the value of the field.
            $('#content').val($('#content').val() + '= صورة وسطى ' + url);
        }

    </script>

    @include('layouts.partials.admin.photos.upload')

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_news_update', $news->id]]) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', $news->title, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('content', 'المحتوى') }}
                            {{ Form::textarea('content', $news->content, ['class' => 'form-control', 'id' => 'content']) }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('تعديل الخبر', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add news end-->

@stop
