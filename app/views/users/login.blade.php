@extends('layouts.admin.default')

@section('title', 'تسجيل الدخول')
@section('content')

<!-- Add user -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تسجيل الدخول</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'users_login_post']) }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('username', 'اسم المستخدم') }}
                            {{ Form::text('username', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('password', 'كلمة المرور') }}
                            {{ Form::password('password', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        {{ Form::submit('تسجيل الدخول', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add user end-->

@stop
