@extends('layouts.admin.default')

@section('title', 'الرمّة')
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the rummahs. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف الرمّة؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_rummahs_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الرمّة {{ link_to_route('admin_rummahs_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>م</th>
                        <th class="col-md-6">العنوان (الوصف)</th>
                        <th>التاريخ</th>
                        <th>القراءات</th>
                        <th>الإعجاب</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($rummahs) == 0)
                    <tr>
                        <td colspan="6">
لا يوجد رمّة مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($rummahs as $rummah)
                <tr>
                    <td>{{ $rummah->id }}</td>
                    <td><a href="{{ $rummah->url }}">{{ $rummah->title }}</a><br /><span class="text-muted">{{ $rummah->description }}</span></td>
                    <td>{{ $rummah->created_at }}</td>
                    <td>{{ $rummah->views_count }}</td>
                    <td>{{ $rummah->likes_count }}</td>
                    <td>
                        {{ link_to_route('admin_rummahs_edit', 'تعديل', [$rummah->id], ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $rummah->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Pages end -->

@stop
