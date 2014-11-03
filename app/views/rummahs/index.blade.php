@extends('layouts.default')

@section('title', 'الرمّة')
@section('content')

<!-- Albums -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>الرمّة <small>({{ count($rummahs) }})</small></h3>
                    </div>
                </div>
            </div>

    @foreach(array_chunk($rummahs->toArray(), 3) as $rummahsRow)
        <div class="row">
            @foreach($rummahsRow as $rummah)
            <div class="col-md-4">
              <a href="{{ route('rummahs_show', [$rummah['id']]) }}"><img src="{{ $rummah['cover_url'] }}" class="img-responsive" /></a>
              <h4><a href="{{ route('rummahs_show', [$rummah['id']]) }}">{{ $rummah['title'] }} <small>({{ $rummah['version'] }})</small></a></h4>
              <p>{{ $rummah['description'] }}</p>
              <p>
                {{ link_to_route('rummahs_show', 'تحميل نسخة (PDF)', [$rummah['id']], ['class' => 'btn btn-primary']) }}
                <a href="{{ route('rummahs_like', [$rummah['id']]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $rummah['likes_count'] }}</a>
              </p>
            </div>
            @endforeach
        </div>
    @endforeach

</div><!-- Albums end-->

@stop
