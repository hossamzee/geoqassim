@extends('layouts.admin.default')

@section('title', 'القائمة البريديّة')
@section('content')

<!-- News -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>القائمة البريديّة <a class="btn btn-primary disabled pull-left" href="#">إرسال رسالة</a></h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>م</th>
                        <th class="col-md-6">البريد الإلكتروني</th>
                        <th>الحالة</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($subscribers) == 0)
                    <tr>
                        <td colspan="4">
لا يوجد بريد إلكتروني مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($subscribers as $subscriber)
                <tr>
                    <td>{{ $subscriber->id }}</td>
                    <td>{{ $subscriber->email }}</td>
                    <td>{{ $subscriber->readable_is_active }}</td>
                    <td>-</td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- News end -->

@stop
