@extends('layouts.admin.default')

@section('title', 'الأخبار')
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the news. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف الخبر؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_news_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- News -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الأخبار {{ link_to_route('admin_news_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
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
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($news) == 0)
                    <tr>
                        <td colspan="6">
لا يوجد أخبار مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($news as $single_news)
                <tr>
                    <td>{{ $single_news->id }}</td>
                    <td>{{ link_to_route('news_show', $single_news->title, $single_news->id) }}</td>
                    <td>{{ $single_news->created_at }}</td>
                    <td>{{ $single_news->views_count }}</td>
                    <td>{{ $single_news->likes_count }}</td>
                    <td>
                        {{ link_to_route('admin_news_edit', 'تعديل', $single_news->id, ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $single_news->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- News end -->

@stop