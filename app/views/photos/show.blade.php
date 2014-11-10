@extends('layouts.default')

@section('title', 'الألبومات - ' . $album->title . ' - ' . $photo->title)
@section('content')

<style>

.btn-photo {

}

</style>

<!-- Photo -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>
                            {{ link_to_route('albums_index', 'الألبومات') }} - {{ $album->title }} - {{ $photo->title }}
                            <div class="pull-left">
                                <a href="#" class="btn btn-default"><i class="fa fa-eye"></i> {{ $photo->views_count }}</a>
                                <a href="{{ route('photos_like', [$photo->id]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $photo->likes_count }}</a>
                            </div>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-center">
                    @if ($previous_photos->first())
                        {{ link_to_route('photos_show', 'السابق', [$previous_photos->first()->album_id, $previous_photos->first()->id], ['class' => 'btn btn-primary btn-photo']) }}
                    @endif
                </div>
                <div class="col-md-10">
                    <img src="{{ $photo->large_url }}" class="img-responsive center-block" id="photo" />
                </div>
                <div class="col-md-1 text-center">
                    @if ($next_photos->first())
                        {{ link_to_route('photos_show', 'التالي', [$next_photos->first()->album_id, $next_photos->first()->id], ['class' => 'btn btn-primary btn-photo']) }}
                    @endif
                </div>
            </div>

            <hr />

            <!-- Related photo -->
            <div class="row img-related">
                @foreach ($related_photos as $related_photo)
                  <div class="col-md-2">
                      <a href="{{ route('photos_show', [$related_photo->album_id, $related_photo->id]) }}"><img src="{{ $related_photo->thumb_url }}" class="img-responsive" /></a>
                  </div>
                @endforeach
            </div>

</div><!-- Photo end-->

@stop
