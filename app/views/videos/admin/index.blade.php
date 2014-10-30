@extends('layouts.admin.default')

@section('title', 'الفيديوهات')
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the videos. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف الفيديو؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_videos_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الفيديوهات {{ link_to_route('admin_videos_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
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
                        <th>الرابط</th>
                        <th>التاريخ</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($videos) == 0)
                    <tr>
                        <td colspan="6">
لا يوجد فيديوهات مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($videos as $video)
                <tr>
                    <td>{{ $video->id }}</td>
                    <td><strong>{{ $video->title }}</strong><br /><span class="text-muted">{{ $video->description }}</span></td>
                    <td><a href="{{ $video->url }}" target="_blank"><i class="fa fa-external-link"></i> {{ $video->url }}</a></td>
                    <td>{{ $video->created_at }}</td>
                    <td>
                        {{ link_to_route('admin_videos_edit', 'تعديل', $video->id, ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $video->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- Pages end -->

@stop