@extends('layouts.default')

@section('title', 'الطلاب')
@section('content')

<!-- Albums -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>الطلاب <small>({{ $students->count() }})</small></h3>
                    </div>
                </div>
            </div>

            @if ($students->count() == 0)
              <p>
                  <i class="fa fa-warning"></i>
                  لم يتم إضافة طلاب حتّى الآن.
              </p>
            @endif

    @foreach(array_chunk($students->toArray(), 3) as $studentsRow)
        <div class="row">
            @foreach($studentsRow as $student)
            <div class="col-md-4">
              <a href="{{ route('students_show', [$student['id']]) }}">

                <div class="member-div">
                  @if ($student['photo_url'])
                    <img src="{{ $student['photo_url'] }}" class="img-thumbnail" alt="{{ $student['name'] }}" />
                  @else
                    <img src="/assets/images/default-thumb.png" class="img-thumbnail" alt="{{ $student['name'] }}" />
                  @endif
                </div>
              </a>
              <h4><a href="{{ route('students_show', [$student['id']]) }}">{{ $student['name'] }} <small>({{ $student['major'] }})</small></a></h4>
              <p>{{ $student['interests'] }}</p>
              <p>

                @if ($student['email'])
                  <a href="mailto:{{ $student['email'] }}" class="btn btn-default"><i class="fa fa-envelope"></i></a>
                @endif

              </p>
            </div>
            @endforeach
        </div>
        <hr />
    @endforeach

</div><!-- Albums end-->

@stop
