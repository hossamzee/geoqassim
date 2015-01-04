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
    @foreach(array_chunk($researches->toArray(), 3) as $researchesRow)
        <div class="row">
            @foreach($researchesRow as $research)
            <div class="col-md-4">

              <h4><a href="{{ route('researches_show', [$research['id']]) }}">{{ $research['title'] }}</a></h4>

              <p class="text-muted"><i class="fa fa-user"></i> {{ $research['author'] }}</p>
              <p>
                {{ link_to_route('researches_show', 'تحميل نسخة (PDF)', [$research['id']], ['class' => 'btn btn-primary']) }}
                <a href="{{ route('researches_like', [$research['id']]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $research['likes_count'] }}</a>
              </p>

            </div>
            @endforeach
        </div>
        <hr />
    @endforeach

</div><!-- Researches end-->

@stop
