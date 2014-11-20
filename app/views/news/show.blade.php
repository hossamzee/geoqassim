@extends('layouts.default')

@section('title', 'الأخبار - ' . $news->title)
@section('content')

<!-- Single news -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ $news->title }}
                    <small>({{ $news->readable_created_at }})</small>
                    <div class="pull-left">
                        <a href="#" class="btn btn-default"><i class="fa fa-eye"></i> {{ $news->views_count }}</a>
                        <a href="{{ route('news_like', [$news->id]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $news->likes_count }}</a>
                        <a href="#" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i></a>
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 lead">
            {{ nl2br($news->parsedContent) }}
        </div>
    </div>
</div><!-- Single news end-->

@stop
