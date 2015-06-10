@extends('layouts.admin.default')

@section('title', 'الإعلانات')
@section('content')

<!-- TODO: Show alert to check if the user is sure to delete the ads. -->
<script type="text/javascript">
function confirm_delete(id)
{
    var result = confirm('هل أنت متأكّد من أنّك ترغب في حذف الإعلان؟');

    if (result == false)
    {
        return false;
    }

    var url = '{{ urldecode(route('admin_ads_destroy')) }}';

    url = url.replace('{id}', id);

    window.location.replace(url);
}
</script>

<!-- News -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>الإعلانات {{ link_to_route('admin_ads_create', 'إضافة', null, ['class' => 'btn btn-primary pull-left']) }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>م</th>
                        <th class="col-md-6">العنوان</th>
                        <th>التاريخ</th>
                        <th>القراءات</th>
                        <th>الإعجاب</th>
                        <th class="col-md-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>

                @if(count($ads) == 0)
                    <tr>
                        <td colspan="6">
لا يوجد إعلانات مضافة إلى قاعدة البيانات.
                        </td>
                    </tr>
                @endif

            @foreach($ads as $ad)
                <tr>
                    <td>{{ $ad->id }}</td>
                    <td>{{ link_to_route('ads_show', $ad->title, $ad->id) }}</td>
                    <td>{{ $ad->created_at }}</td>
                    <td>{{ $ad->views_count }}</td>
                    <td>{{ $ad->likes_count }}</td>
                    <td>
                        {{ link_to_route('admin_ads_edit', 'تعديل', $ad->id, ['class' => 'btn btn-default btn-sm']) }}
                        <a href="#" onclick="confirm_delete({{ $ad->id }})" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- News end -->

@stop
