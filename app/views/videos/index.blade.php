@extends('layouts.default')

@section('title', 'الفيديو')
@section('content')

<!-- Videos -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>الفيديو <small>({{ $videos->count() }})</small></h3>
                    </div>
                </div>
            </div>

    @if ($videos->count() == 0)
    <p>
        <i class="fa fa-warning"></i>
        لم يتم إضافة فيديو حتّى الآن.
    </p>
    @endif

    @foreach(array_chunk($videos->toArray(), 3) as $videosRow)
        <div class="row">
            @foreach($videosRow as $video)
            <div class="col-md-4">
                <!-- 4:3 aspect ratio -->
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{ $video['youtube_id'] }}?rel=0" allowfullscreen></iframe>
                </div>
                <h4><a href="//www.youtube.com/embed/{{ $video['youtube_id'] }}?rel=0">{{ $video['title'] }} <small>({{ $video['readable_created_at'] }})</small></a></h4>
                <p>{{ $video['description'] }}</p>
            </div>
            @endforeach
        </div>
        <hr />
    @endforeach

</div><!-- Videos end-->

@stop
