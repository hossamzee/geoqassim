@extends('layouts.default')

@section('title', 'الأخبار')
@section('content')

<!-- News -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الأخبار</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

              @if ($news->count() == 0)
              <p>
                  <i class="fa fa-warning"></i>
                  لم يتم إضافة أخبار حتّى الآن.
              </p>
            @endif

            @foreach($news as $single_news)
                <h4><small><i class="fa fa-file-o"></i></small> {{ link_to_route('news_show', $single_news->title, [$single_news->id]) }} <small>{{ $single_news->created_at }}</small></h4>
            @endforeach

        </div>
    </div>
</div><!-- News end -->

@stop
