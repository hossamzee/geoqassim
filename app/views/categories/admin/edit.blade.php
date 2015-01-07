@extends('layouts.admin.default')

@section('title', 'تعديل ألبوم - '. $category->title)
@section('content')

<!-- Edit category -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل تصنيف أبحاث و دراسات - {{$category->title }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_categories_update', $category->id]]) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', $category->title, ['class' => 'form-control', 'id' => 'v_title']) }}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        {{ Form::submit('تعديل تصنيف الأبحاث و الدراسات', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit category end-->

@stop
