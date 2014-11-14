@extends('layouts.admin.default')

@section('title', 'إضافة صورة')
@section('content')

<!-- Add photo -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة صورة</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_photos_store', $album->id], 'files' => true]) }}

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('photo', 'الصورة') }}
                            {{ Form::file('photo') }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('description', 'الوصف') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        {{ Form::submit('إضافة الصورة', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add photo end-->

@stop
