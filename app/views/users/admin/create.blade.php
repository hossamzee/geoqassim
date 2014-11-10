@extends('layouts.admin.default')

@section('title', 'إضافة مستخدم')
@section('content')

<!-- Add user -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة مستخدم</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'admin_users_store']) }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('username', 'اسم المستخدم') }}
                            {{ Form::text('username', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('role', 'الدور') }}
                            {{ Form::select('role', $roles, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('member_id', 'العضو') }}
                            {{ Form::select('member_id', $members, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        {{ Form::submit('إضافة المستخدم', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add user end-->

@stop
