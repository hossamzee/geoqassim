@extends('layouts.admin.default')

@section('title', 'إضافة عضو')
@section('content')

<!-- Add member -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة عضو</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'admin_members_store', 'files' => true]) }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('name', 'الاسم') }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('role', 'الدور') }}
                            {{ Form::select('role', $roles, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('bio', 'لمحة') }}
                            {{ Form::textarea('bio', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('cv', 'السيرة الذاتية') }}
                            {{ Form::textarea('cv', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('photo', 'الصورة الشخصيّة (اختيارية)') }}
                            {{ Form::file('photo') }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('email', 'البريد الإلكتروني (اختياري)') }}
                            {{ Form::text('email', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('twitter_account', 'حساب Twitter (اختياري)') }}
                            {{ Form::text('twitter_account', null, ['class' => 'form-control', 'placeholder' => 'حساب Twitter دون رمز (@)']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('linkedin_account', 'حساب Linkedin (اختياري)') }}
                            {{ Form::text('linkedin_account', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('إضافة العضو', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add member end-->

@stop
