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
                            {{ Form::textarea('content', $news->content, ['class' => 'form-control']) }}
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
