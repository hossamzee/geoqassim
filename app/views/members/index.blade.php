@extends('layouts.default')

@section('title', 'الأعضاء')
@section('content')

<!-- Albums -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>الأعضاء <small>({{ $members->count() }})</small></h3>
                    </div>
                </div>
            </div>

            @if ($members->count() == 0)
              <p>
                  <i class="fa fa-warning"></i>
                  لم يتم إضافة أعضاء حتّى الآن.
              </p>
            @endif

    @foreach(array_chunk($members->toArray(), 3) as $membersRow)
        <div class="row">
            @foreach($membersRow as $member)
            <div class="col-md-4">
              <a href="{{ route('members_show', [$member['id']]) }}"><img src="{{ $member['photo_url'] }}" class="img-responsive" alt="{{ $member['name'] }}" /></a>
              <h4><a href="{{ route('members_show', [$member['id']]) }}">{{ $member['name'] }} <small>({{ $member['readable_role'] }})</small></a></h4>
              <p>{{ $member['bio'] }}</p>
              <p>

                {{ link_to_route('members_show', 'السيرة الذاتية', [$member['id']], ['class' => 'btn btn-primary']) }}

                @if ($member['email'])
                  <a href="mailto:{{ $member['email'] }}" class="btn btn-default"><i class="fa fa-envelope"></i></a>
                @endif

                @if ($member['twitter_account'])
                  <a href="{{ $member['twitter_account_url'] }}" class="btn btn-default"><i class="fa fa-twitter"></i></a>
                @endif

              </p>
            </div>
            @endforeach
        </div>
    @endforeach

</div><!-- Albums end-->

@stop
