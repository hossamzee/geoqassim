@extends('layouts.admin.default')

@section('title', 'تعديل عضو - '. $member->name)
@section('content')

<!-- Edit member -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل عضو - {{$member->name }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_members_update', $member->id], 'files' => true]) }}
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          {{ Form::label('name', 'الاسم') }}
                          {{ Form::text('name', $member->name, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          {{ Form::label('role', 'الدور') }}
                          {{ Form::select('role', $roles, $member->role, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          {{ Form::label('bio', 'لمحة') }}
                          {{ Form::textarea('bio', $member->bio, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          {{ Form::label('cv', 'السيرة الذاتية') }}
                          {{ Form::textarea('cv', $member->cv, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <img src="{{ $member->photo_url }}" class="img-responsive" />
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          {{ Form::label('photo', 'الصورة الشخصيّة') }}
                          {{ Form::file('photo') }}
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          {{ Form::label('email', 'البريد الإلكتروني (اختياري)') }}
                          {{ Form::text('email', $member->email, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          {{ Form::label('twitter_account', 'حساب Twitter (اختياري)') }}
                          {{ Form::text('twitter_account', $member->twitter_account, ['class' => 'form-control', 'placeholder' => 'حساب Twitter دون رمز (@)']) }}
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          {{ Form::label('linkedin_account', 'حساب Linkedin (اختياري)') }}
                          {{ Form::text('linkedin_account', $member->linkedin_account, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-12 text-right">
                      {{ Form::submit('تعديل العضو', ['class' => 'btn btn-primary btn-lg']) }}
                  </div>
              </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit member end-->

@stop
