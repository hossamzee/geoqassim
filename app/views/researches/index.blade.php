@extends('layouts.default')

@section('title', 'الأبحاث و الدراسات')
@section('content')

<!-- Researches -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>الأبحاث و الدراسات <small>({{ $researches->count() }})</small></h3>
                    </div>
                </div>
            </div>

      @if ($researches->count() == 0)
      <p>
          <i class="fa fa-warning"></i>
          لم يتم إضافة بحث و دراسة حتّى الآن.
      </p>
    @endif

    <!-- TODO: Make this one a better one by having one array. -->
    @foreach($researches as $research)
        <div class="row">
            <div class="col-md-6">
              <h4><a href="{{ route('researches_show', [$research['id']]) }}">{{ $research->title }}</a></h4>
            </div>
            <div class="col-md-3">
              <h5>{{ $research->author }}</h5>
            </div>
            <div class="col-md-3">
              <p>
                {{ link_to_route('researches_show', 'تحميل نسخة (PDF)', [$research->id], ['class' => 'btn btn-primary']) }}
                <a href="#" class="btn btn-default"><i class="fa fa-eye"></i> {{ $research->views_count }}</a>
                <a href="{{ route('researches_like', [$research->id]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $research->likes_count }}</a>
              </p>
            </div>
        </div>
        <hr />
    @endforeach

</div><!-- Researches end-->

@stop
