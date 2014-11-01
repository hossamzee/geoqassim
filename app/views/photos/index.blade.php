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
                <img src="" class="img-response" />
                <h4>{{ link_to_route('photos_index', 'Photos', [$album->id]) }}</h4>
                <p>{{ $album['description'] }}</p>
            </div>
            @endforeach
        </div>
    @endforeach

</div><!-- Albums end-->

@stop
