@extends('layouts.default')

@section('title', 'الإعلانات')
@section('content')

<!-- Ad -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الإعلانات</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

              @if ($ads->count() == 0)
              <p>
                  <i class="fa fa-warning"></i>
                  لم يتم إضافة إعلانات حتّى الآن.
              </p>
            @endif

            @foreach($ads as $ad)
                <h4><small><i class="fa fa-file-o"></i></small> {{ link_to_route('ads_show', $ad->title, [$ad->id]) }} <small>({{ $ad->readable_created_at }})</small></h4>
            @endforeach

        </div>
    </div>
</div><!-- Ad end -->

@stop
