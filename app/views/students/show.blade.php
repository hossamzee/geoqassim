@extends('layouts.default')

@section('title', 'الطلاب - ' . $student->name)
@section('content')

<!-- Single student -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <center>
                @if ($student->photo_url)
                  <img src="{{ $student->photo_url }}" class="img-thumbnail" alt="{{ $student->name }}" />
                @else
                  <img src="/assets/images/default-thumb.png" class="img-thumbnail" alt="{{ $student->name }}" />
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
                <h3>{{ $student->name }}
                    <small>({{ $student->major }})</small>
                    <div class="pull-left">
                        @if ($student->email)
                        <a href="mailto:{{ $student->email }}" class="btn btn-default"><i class="fa fa-envelope"></i></a>
                        @endif

                        <a href="#" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i></a>
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="lead">{{ $student->interests }}</p>
      </div>
    </div>
</div><!-- Single student end-->

@stop
