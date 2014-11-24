@extends('layouts.default')

@section('title', 'نتائج البحث عن ' . e($query))
@section('content')

<!-- Single page -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>نتائج البحث عن <b>{{ e($query) }}</b>
                  <small>({{ $results->count() }})</small>
                  <div class="pull-left">
                      <a href="#" class="btn btn-default" title="ثانية"><i class="fa fa-cogs"></i> {{ $taken_time }}</a>
                  </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          @foreach ($results as $result)
            <p>
              <b><a href="{{ url($result->uri) }}">{{ $result->getHighlightedTitle($keywords) }}</a></b>
            </p>
            <p>
              {{ $result->getHighlightedSnippet($keywords) }}
            </p>
            <p class="text-warning">
              {{ $result->url }}
            </p>
            <br />
          @endforeach
        </div>
    </div>
</div><!-- Single page end-->

@stop
