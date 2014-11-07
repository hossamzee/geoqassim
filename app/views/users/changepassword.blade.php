@extends('layouts.admin.default')

@section('title', 'تغيير كلمة المرور')
@section('content')

<!-- Add user -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تغيير كلمة المرور</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'users_changepassword_post']) }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('current_password', 'كلمة المرور الحاليّة') }}
                            {{ Form::password('current_password', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('new_password', 'كلمة المرور الجديدة') }}
                            {{ Form::password('new_password', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        {{ Form::submit('تغيير كلمة المرور', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add user end-->

@stop
