@extends('layouts.default')

@section('title', 'الأعضاء - ' . $member->name)
@section('content')

<!-- Single member -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <center>
                @if ($member->photo_url)
                  <img src="{{ $member->photo_url }}" class="img-thumbnail" alt="{{ $member->name }}" />
                @else
                  <img src="/assets/images/default-thumb.png" class="img-thumbnail" alt="{{ $member->name }}" />
                @endif
              </center>
            </div>
        </div>
    </div>
</header>

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

                        <a href="#" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i></a>
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            @foreach ($member->parsed_cv as $one_parsed_cv)
            <table class="table">
              <thead>
                <tr>
                  <th>
                       <h4>{{ $one_parsed_cv['heading'] }}</h4>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="lead">
                    <ul>
                        @foreach ($one_parsed_cv['items'] as $item)
                          <li> {{ $item }}</li>
                        @endforeach
                    </ul>
                  </td>
                </tr>
              </tbody>
            </table>
            @endforeach

        </div>
    </div>
</div><!-- Single member end-->

@stop
