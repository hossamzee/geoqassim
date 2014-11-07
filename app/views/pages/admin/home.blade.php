@extends('layouts.admin.default')

@section('title', 'الصفحات')
@section('content')

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الصفحات {{ link_to_route('admin_pages_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ link_to_route('users_changepassword_get', 'تغيير كلمة المرور') }}
        </div>
    </div>
</div><!-- Pages end -->

@stop
