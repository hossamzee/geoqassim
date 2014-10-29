@extends('layouts.default')

@section('title', 'الأخبار - ' . $news->title)
@section('content')

<!-- Single news -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ $news->title }} <small>({{ $news->created_at }})</small><a href="#" class="btn btn-default pull-left">طباعة</a></h3>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="lead">
                {{ $news->content }}
            </p>
        </div>
    </div>
</div><!-- Single news end-->

@stop