@extends('layouts.default')

@section('title', 'الفيديو')
@section('content')

<!-- Videos -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>الفيديو <small>({{ count($videos) }})</small></h3>
                    </div>
                </div>
            </div>

    @foreach(array_chunk($videos->toArray(), 3) as $videosRow)
        <div class="row">
            @foreach($videosRow as $video)
            <div class="col-md-4">
                <!-- 4:3 aspect ratio -->
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{ $video['youtube_id'] }}?rel=0&showinfo=0&controls=0" allowfullscreen></iframe>
                </div>
                <h4><a href="//www.youtube.com/embed/{{ $video['youtube_id'] }}?rel=0&showinfo=0&controls=0">{{ $video['title'] }} <small>({{ $video['created_at'] }})</small></a></h4>
                <p>{{ $video['description'] }}</p>
            </div>
            @endforeach
        </div>
    @endforeach

</div><!-- Videos end-->

@stop