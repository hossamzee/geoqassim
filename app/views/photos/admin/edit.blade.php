@extends('layouts.admin.default')

@section('title', 'تعديل صورة - '. $photo->title)
@section('content')

<!-- Edit photo -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل صورة - {{$photo->title }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_photos_update', $photo->id], 'files' => true]) }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <img src="{{ $photo->thumb_url }}" class="img-responsive" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('photo', 'الصورة') }}
                            {{ Form::file('photo') }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', $photo->title, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('description', 'الوصف') }}
                            {{ Form::textarea('description', $photo->description, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        {{ Form::submit('تعديل الصورة', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit photo end-->

@stop
