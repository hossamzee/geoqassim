@extends('layouts.admin.default')

@section('title', 'تعديل رمّة - '. $rummah->title)
@section('content')

<!-- Edit rummah -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل رمّة - {{$rummah->title }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_rummahs_update', $rummah->id], 'files' => true]) }}
              <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                          {{ Form::label('title', 'العنوان') }}
                          {{ Form::text('title', $rummah->title, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          {{ Form::label('version', 'العدد (الإصدار)') }}
                          {{ Form::text('version', $rummah->version, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          {{ Form::label('description', 'الوصف') }}
                          {{ Form::textarea('description', $rummah->description, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          {{ Form::label('url', 'رابط النشرة (PDF)'); }}
                          {{ Form::text('url', $rummah->url, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <img src="{{ $rummah->cover_url }}" class="img-responsive" />
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          {{ Form::label('cover', 'صورة الغلاف'); }}
                          {{ Form::file('cover') }}
                      </div>
                  </div>
                  <div class="col-sm-12 text-right">
                      {{ Form::submit('تعديل الرمّة', ['class' => 'btn btn-primary btn-lg']) }}
                  </div>
              </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit rummah end-->

@stop
