@extends('layouts.default')

@section('title', $page->title)
@section('content')

<!-- Single page -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ $page->title }}
                    <small>({{ $page->created_at }})</small>
                    <div class="pull-left">
                        <a href="#" class="btn btn-default"><i class="fa fa-eye"></i> {{ $page->views_count }}</a>
                        <a href="{{ route('pages_like', [$page->id]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $page->likes_count }}</a>
                        <a href="#" class="btn btn-default"><i class="fa fa-print"></i></a>
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="lead">
                {{ nl2br($page->content) }}
            </p>
        </div>
    </div>
</div><!-- Single page end-->

@stop