@extends('layouts.admin.default')

@section('title', 'الألبومات')
@section('content')

<!-- Show alert to check if the user is sure to delete the albums. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف الألبوم؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_albums_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الألبومات {{ link_to_route('admin_albums_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="col-md-5">العنوان (الوصف)</th>
                        <th>التاريخ</th>
                        <th>الصور</th>
                        <th>المشاهدات</th>
                        <th>الإعجاب</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($albums) == 0)
                    <tr>
                        <td colspan="7">
لا يوجد ألبومات مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($albums as $album)
                <tr>
                    <td>
                      <a href="{{ route('admin_albums_moveup', [$album->id]) }}" class="btn btn-link"><i class="fa fa-arrow-up"></i></a>
                      <a href="{{ route('admin_albums_movedown', [$album->id]) }}" class="btn btn-link"><i class="fa fa-arrow-down"></i></a>
                    </td>
                    <td>{{ link_to_route('admin_photos_index', $album->title, [$album->id]) }}<br /><span class="text-muted">{{ $album->description }}</span></td>
                    <td>{{ $album->created_at }}</td>
                    <td>{{ count($album->photos) }}</td>
                    <td>{{ $album->views_count }}</td>
                    <td>{{ $album->likes_count }}</td>
                    <td>
                        {{ link_to_route('admin_albums_edit', 'تعديل', [$album->id], ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $album->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Pages end -->

@stop
