@extends('layouts.admin.default')

@section('title', 'تعديل مستخدم - '. $user->username)
@section('content')

<!-- Edit user -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل مستخدم - {{$user->username }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_users_update', $user->id], 'files' => true]) }}
              <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          {{ Form::label('username', 'اسم المستخدم') }}
                          {{ Form::text('username', $user->username, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          {{ Form::label('role', 'الدور') }}
                          {{ Form::select('role', $roles, $user->role, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          {{ Form::label('member_id', 'العضو') }}
                          {{ Form::select('member_id', $members, $user->member_id, ['class' => 'form-control']) }}
                      </div>
                  </div>
                  <div class="col-sm-12 text-right">
                      {{ Form::submit('تعديل المستخدم', ['class' => 'btn btn-primary btn-lg']) }}
                  </div>
              </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit user end-->

@stop
