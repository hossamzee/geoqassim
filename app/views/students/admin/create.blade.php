@extends('layouts.admin.default')

@section('title', 'إضافة طالب')
@section('content')

<!-- Add student -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة طالب</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'admin_students_store', 'files' => true]) }}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('name', 'اسم الباحث') }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('gender', 'الجنس') }}
                            {{ Form::select('gender', $genders, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('major', 'التخصّص') }}
                            {{ Form::text('major', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            {{ Form::label('interests', 'الاهتمامات العلمية') }}
                            {{ Form::text('interests', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('email', 'البريد الإلكتروني (اختياري)') }}
                            {{ Form::text('email', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('إضافة الطالب', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add student end-->

@stop
