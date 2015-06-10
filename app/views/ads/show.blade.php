@extends('layouts.default')

@section('title', 'الإعلانات - ' . $ad->title)
@section('content')

<!-- Single ad -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ $ad->title }}
                    <small>({{ $ad->readable_created_at }})</small>
                    <div class="pull-left">
                        <a href="#" class="btn btn-default"><i class="fa fa-eye"></i> {{ $ad->views_count }}</a>
                        <a href="{{ route('ads_like', [$ad->id]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $ad->likes_count }}</a>
                        <a href="#" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i></a>
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 lead">
            {{ nl2br($ad->parsed_content) }}
        </div>
    </div>
</div><!-- Single ad end-->

@stop
