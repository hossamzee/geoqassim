@extends('layouts.admin.default')

@section('title', 'ألبوم ' . $album->title . ' - الصور')
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the photos. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف الصورة؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_photos_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>
                    {{ link_to_route('admin_albums_index', 'الألبومات') }}
                     - صور ألبوم {{ $album->title }}
                    <div class="pull-left">
                      {{ link_to_route('admin_photos_create', 'إضافة', [$album->id], ['class' => 'btn btn-primary']) }}
                      {{ link_to_route('admin_photos_bulk_get', 'إضافة عدّة صور', [$album->id], ['class' => 'btn btn-info']) }}
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>م</th>
                        <th class="col-md-6">الصورة</th>
                        <th>التاريخ</th>
                        <th>الصور</th>
                        <th>المشاهدات</th>
                        <th>الإعجاب</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($photos) == 0)
                    <tr>
                        <td colspan="7">
لا يوجد صور مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($photos as $photo)
                <tr>
                    <td>{{ $photo->id }}</td>
                    <td>
                      <div class="media">
                        <a class="pull-right" href="{{ route('photos_show', [$photo->album_id, $photo->id]) }}">
                          <img src="{{ $photo->thumb_url }}" alt="{{ $photo->title }}.">
                        </a>
                        <div class="media-body">
                          {{ link_to_route('photos_show', $photo->title, [$photo->album_id, $photo->id]) }}<br />
                          <span class="text-muted">{{ $photo->description }}</span>
                        </div>
                      </div
                    </td>
                    <td>{{ $photo->created_at }}</td>
                    <td>{{ count($photo->photos) }}</td>
                    <td>{{ $photo->views_count }}</td>
                    <td>{{ $photo->likes_count }}</td>
                    <td>
                        {{ link_to_route('admin_photos_edit', 'تعديل', [$photo->id], ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $photo->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Pages end -->

@stop
