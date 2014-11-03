@extends('layouts.admin.default')

@section('title', 'إضافة رمّة')
@section('content')

<!-- Add rummah -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة رمّة</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'admin_rummahs_store', 'files' => true]) }}
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('version', 'العدد (الإصدار)') }}
                            {{ Form::text('version', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('description', 'الوصف') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('url', 'رابط النشرة (PDF)'); }}
                            {{ Form::text('url', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('cover', 'صورة الغلاف'); }}
                            {{ Form::file('cover') }}
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        {{ Form::submit('إضافة الرمّة', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add rummah end-->

@stop
