@extends('layouts.default')

@section('title', 'الألبومات')
@section('content')

<!-- Albums -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>الألبومات <small>({{ count($albums) }})</small></h3>
                    </div>
                </div>
            </div>

    @foreach(array_chunk($albums->toArray(), 3) as $albumsRow)
        <div class="row">
            @foreach($albumsRow as $album)
            <div class="col-md-4">
                <!-- 4:3 aspect ratio -->
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{ $album['youtube_id'] }}?rel=0&showinfo=0&controls=0" allowfullscreen></iframe>
                </div>
                <h4><a href="//www.youtube.com/embed/{{ $album['youtube_id'] }}?rel=0&showinfo=0&controls=0">{{ $album['title'] }} <small>({{ $album['created_at'] }})</small></a></h4>
                <p>{{ $album['description'] }}</p>
            </div>
            @endforeach
        </div>
    @endforeach

</div><!-- Albums end-->

@stop
