@extends('layouts.admin.default')

@section('title', 'إضافة صفحة')
@section('content')

<!-- Add page -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة صفحة</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'admin_pages_store']) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('content', 'المحتوى') }}
                            {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('إضافة الصفحة', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add page end-->

@stop
