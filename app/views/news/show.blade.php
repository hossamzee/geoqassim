@extends('layouts.default')

@section('title', 'الأخبار - ' . $news->title)
@section('content')

<!-- Single news -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ $news->title }}
                    <small>({{ $news->created_at }})</small>
                    <div class="pull-left">
                        <a href="#" class="btn btn-default"><i class="fa fa-eye"></i> {{ $news->views_count }}</a>
                        <a href="{{ route('news_like', [$news->id]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $news->likes_count }}</a>
                        <!-- <a href="#" class="btn btn-default"><i class="fa fa-print"></i></a> -->
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="lead">
                {{ nl2br($news->content) }}
            </p>
        </div>
    </div>
</div><!-- Single news end-->

@stop
