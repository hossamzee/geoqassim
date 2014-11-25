@extends('layouts.admin.default')

@section('title', 'الأعضاء')
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the members. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف العضو؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_members_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الأعضاء {{ link_to_route('admin_members_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="col-md-6">اسم العضو (لمحة)</th>
                        <th>الدور</th>
                        <th>البريد الإلكتروني</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($members) == 0)
                    <tr>
                        <td colspan="5">
لا يوجد أعضاء مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($members as $member)
                <tr>
                    <td>
                      <a href="{{ route('admin_members_moveup', [$member->id]) }}" class="btn btn-link"><i class="fa fa-arrow-up"></i></a>
                      <a href="{{ route('admin_members_movedown', [$member->id]) }}" class="btn btn-link"><i class="fa fa-arrow-down"></i></a>
                    </td>
                    <td>{{ link_to_route('members_show', $member->name, [$member->id]) }}<br /><span class="text-muted">{{ $member->bio }}</span></td>
                    <td>{{ $member->readable_role }}</td>
                    <td><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></td>
                    <td>
                        {{ link_to_route('admin_members_edit', 'تعديل', [$member->id], ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $member->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Pages end -->

@stop
