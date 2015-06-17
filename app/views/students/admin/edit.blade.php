@extends('layouts.admin.default')

@section('title', 'تعديل طالب - '. $student->name)
@section('content')

<!-- Edit student -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل طالب - {{$student->name }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_students_update', $student->id], 'files' => true]) }}
              <div class="row">
                  <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('name', 'اسم الباحث') }}
                            {{ Form::text('name', $student->name, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('gender', 'الجنس') }}
                            {{ Form::select('gender', $genders, $student->gender, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('major', 'التخصّص') }}
                            {{ Form::text('major', $student->major, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            {{ Form::label('interests', 'الاهتمامات العلمية') }}
                            {{ Form::text('interests', $student->interests, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('email', 'البريد الإلكتروني (اختياري)') }}
                            {{ Form::text('email', $student->email, ['class' => 'form-control']) }}
                        </div>
                    </div>
                  <div class="col-md-12 text-right">
                      {{ Form::submit('تعديل الطالب', ['class' => 'btn btn-primary btn-lg']) }}
                  </div>
              </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit student end-->

@stop
