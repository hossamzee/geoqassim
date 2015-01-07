@extends('layouts.admin.default')

@section('title', 'تصنيفات الأبحاث و الدراسات')
@section('content')

<!-- Show alert to check if the user is sure to delete the categories. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف تصنيف الأبحاث و الدراسات؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_categories_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تصنيفات الأبحاث و الدراسات {{ link_to_route('admin_categories_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="col-md-4">العنوان</th>
                        <th>التاريخ</th>
                        <th>الأبحاث و الدراسات</th>
                        <th>المشاهدات</th>
                        <th>الإعجاب</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($categories) == 0)
                    <tr>
                        <td colspan="7">
لا يوجد تصنيفات أبحاث و دراسات مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($categories as $category)
                <tr>
                    <td>
                      <a href="{{ route('admin_categories_moveup', [$category->id]) }}" class="btn btn-link"><i class="fa fa-arrow-up"></i></a>
                      <a href="{{ route('admin_categories_movedown', [$category->id]) }}" class="btn btn-link"><i class="fa fa-arrow-down"></i></a>
                    </td>
                    <td>{{ link_to_route('admin_researches_index', $category->title, [$category->id]) }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ count($category->researches) }}</td>
                    <td>{{ $category->views_count }}</td>
                    <td>{{ $category->likes_count }}</td>
                    <td>
                        {{ link_to_route('admin_categories_edit', 'تعديل', [$category->id], ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $category->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Pages end -->

@stop
