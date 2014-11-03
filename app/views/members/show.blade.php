@extends('layouts.default')

@section('title', 'الأعضاء - ' . $member->name)
@section('content')

<!-- Single member -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>{{ $member->name }}
                    <small>({{ $member->readableRole }})</small>
                    <div class="pull-left">
                        @if ($member->email)
                        <a href="mailto:{{ $member->email }}" class="btn btn-default"><i class="fa fa-envelope"></i></a>
                        @endif

                        @if ($member->twitter_account)
                        <a href="{{ $member->twitter_account_url }}" class="btn btn-default"><i class="fa fa-twitter"></i></a>
                        @endif
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <blockquote>
              <p>{{ $member->bio }}</p>
            </blockquote>

            <p class="lead">
                {{ nl2br($member->cv) }}
            </p>
        </div>
    </div>
</div><!-- Single member end-->

@stop
