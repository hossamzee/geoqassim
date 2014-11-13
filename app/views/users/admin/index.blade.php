@extends('layouts.admin.default')

@section('title', 'المستخدمون')
@section('content')

<!-- Show alert to check if the user is sure to delete the users. -->

<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف المستخدم؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_users_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>المستخدمون {{ link_to_route('admin_users_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>م</th>
                        <th class="col-md-6">اسم المستخدم</th>
                        <th>الدور</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($users) == 0)
                    <tr>
                        <td colspan="5">
لا يوجد مستخدمون مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->readable_role }}</td>
                    <td>
                        {{ link_to_route('admin_users_edit', 'تعديل', [$user->id], ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $user->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Pages end -->

@stop
