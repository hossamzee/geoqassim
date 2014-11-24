@extends('layouts.default')

@section('title', 'الألبومات')
@section('content')

<!-- Albums -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>الألبومات <small>({{ $albums->count() }})</small></h3>
                    </div>
                </div>
            </div>

    @if ($albums->count() == 0)
      <p>
          <i class="fa fa-warning"></i>
          لم يتم إضافة صور حتّى الآن.
      </p>
    @endif
    @foreach(array_chunk($albums->toArray(), 3) as $albumsRow)
        <div class="row">
            @foreach($albumsRow as $album)

            <div class="col-md-4">

                <a href="{{ route('photos_index', [$album['id']]) }}">
                  <div class="album-div">
                    @if ($album['last_photo'])
                      <img src="{{ $album['last_photo']['thumb_url'] }}" class="img-thumbnail" alt="{{ $album['title'] }}" />
                    @else
                      <img src="/assets/images/default-thumb.png" class="img-thumbnail" alt="{{ $album['title'] }}" />
                    @endif
                  </div>
                </a>

                <h4>{{ link_to_route('photos_index', $album['title'], [$album['id']]) }} <small>({{ count($album['photos']) }})</small></h4>
                <p>{{ $album['description'] }}</p>
                <p><a href="{{  route('albums_like', [$album['id']]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $album['likes_count'] }}</a></p>
            </div>
            @endforeach
        </div>
        <hr />
    @endforeach

</div><!-- Albums end-->

@stop
