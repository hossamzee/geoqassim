@extends('layouts.admin.default')

@section('title', 'تعديل ألبوم - '. $album->title)
@section('content')

<!-- Edit album -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل ألبوم - {{$album->title }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_albums_update', $album->id]]) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', $album->title, ['class' => 'form-control', 'id' => 'v_title']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('description', 'الوصف') }}
                            {{ Form::textarea('description', $album->description, ['class' => 'form-control', 'id' => 'v_description']) }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('تعديل الألبوم', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit album end-->

@stop
