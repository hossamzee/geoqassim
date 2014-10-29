@extends('layouts.default')

@section('title', 'الأخبار')
@section('content')

<!-- News -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الأخبار</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach($news as $single_news)
                <h4><small><i class="fa fa-file-o"></i></small> {{ link_to_route('single_news', $single_news->title, $single_news->id) }} <small>{{ $single_news->created_at }}</small></h4>
            @endforeach

        </div>
    </div>
</div><!-- News end -->

@stop