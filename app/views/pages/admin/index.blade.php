@extends('layouts.admin.default')

@section('title', 'الصفحات')
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the pages. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف الصفحة؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_pages_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>م</th>
                        <th>العنوان</th>
                        <th>التاريخ</th>
                        <th>القراءات</th>
                        <th>الإعجاب</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($pages) == 0)
                    <tr>
                        <td colspan="6">
لا يوجد صفحات مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ link_to_route('pages_show', $page->title, $page->id) }}</td>
                    <td>{{ $page->created_at }}</td>
                    <td>{{ $page->views_count }}</td>
                    <td>{{ $page->likes_count }}</td>
                    <td>
                        {{ link_to_route('admin_pages_edit', 'تعديل', $page->id, ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $page->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Pages end -->

@stop