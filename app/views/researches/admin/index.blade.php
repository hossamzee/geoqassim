@extends('layouts.admin.default')

@section('title', 'الأبحاث و الدراسات - ' . $category->title)
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the researches. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف البحث و الدراسة؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_researches_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Researches -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>
                    {{ link_to_route('admin_categories_index', 'تصنيفات الأبحاث و الدراسات') }} - {{ $category->title }}
                    {{ link_to_route('admin_researches_create', 'إضافة', [$category->id], ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="col-md-6">العنوان (المؤلف)</th>
                        <th>التاريخ</th>
                        <th>القراءات</th>
                        <th>الإعجاب</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($researches) == 0)
                    <tr>
                        <td colspan="6">
لا يوجد بحث و دراسة مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($researches as $research)
                <tr>
                    <td>
                      <a href="{{ route('admin_researches_moveup', [$research->id]) }}" class="btn btn-link"><i class="fa fa-arrow-up"></i></a>
                      <a href="{{ route('admin_researches_movedown', [$research->id]) }}" class="btn btn-link"><i class="fa fa-arrow-down"></i></a>
                    </td>
                    <td>{{ link_to_route('researches_show', $research->title, [$research->category_id, $research->id]) }}<br /><span class="text-muted">{{ $research->author }}</span></td>
                    <td>{{ $research->created_at }}</td>
                    <td>{{ $research->views_count }}</td>
                    <td>{{ $research->likes_count }}</td>
                    <td>
                        {{ link_to_route('admin_researches_edit', 'تعديل', [$research->id], ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $research->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Researches end -->

@stop
