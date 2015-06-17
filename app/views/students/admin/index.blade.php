@extends('layouts.admin.default')

@section('title', 'الطلاب')
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the students. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف الطالب؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_students_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Students -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الطلاب {{ link_to_route('admin_students_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="col-md-6">اسم الباحث (الاهتمامات العلمية)</th>
                        <th>التخصّص</th>
                        <th>البريد الإلكتروني</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($students) == 0)
                    <tr>
                        <td colspan="5">
لا يوجد طلاب مضافون إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($students as $student)
                <tr>
                    <td>
                      <a href="{{ route('admin_students_moveup', [$student->id]) }}" class="btn btn-link"><i class="fa fa-arrow-up"></i></a>
                      <a href="{{ route('admin_students_movedown', [$student->id]) }}" class="btn btn-link"><i class="fa fa-arrow-down"></i></a>
                    </td>
                    <td>{{ link_to_route('students_show', $student->name, [$student->id]) }}<br /><span class="text-muted">{{ $student->interests }}</span></td>
                    <td>{{ $student->major }}</td>
                    <td><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></td>
                    <td>
                        {{ link_to_route('admin_students_edit', 'تعديل', [$student->id], ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $student->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Students end -->

@stop
