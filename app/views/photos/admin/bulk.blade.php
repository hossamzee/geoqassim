@extends('layouts.admin.default')

@section('title', 'إضافة عدّة صور')
@section('content')

<script type="text/javascript">

    // Big thanks to Raymond Camden.
    // http://www.raymondcamden.com/2013/9/10/Adding-a-file-display-list-to-a-multifile-upload-HTML-control

    $(function(){
        $('#files').on('change', function(e){

            if (!e.target.files) return;

            // Clean the inner HTML.
            $('#chosen_photos').html('');

            var files = e.target.files;

            $("#chosen_photos_count").html('(' + files.length + ')');

            $.each(files, function(index, file){

                if(!file.type.match("image.*")) return;

                var reader = new FileReader();

                reader.onload = function (e){
                    var html = "<div class=\"col-md-3\"><img src=\"" + e.target.result + "\" class=\"img-responsive\" /><p>" + file.name + "</p></div>";
                    $('#chosen_photos').append(html);
                }

                reader.readAsDataURL(file);
            });
        });
    });
</script>

<!-- Add photo -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>إضافة عدّة صور <small id="chosen_photos_count">(0)</small></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_photos_bulk_post', $album->id], 'files' => true]) }}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('photos', 'الصور') }}
                            {{ Form::file('photos[]', ['multiple' => true, 'id' => 'files']) }}
                        </div>
                    </div>
                </div>
                <div class="row well" id="chosen_photos">
                    <!-- Selected photos will be here. -->
                    تفضّل باختيار صورةٍ أو أكثر ليتم منحها عنواناً عشوائيّاً و رفعها إلى الخادم. هنا تظهر معاينة سريعة و مصغّرة للصور.
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        {{ Form::submit('إضافة الصور', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Add photo end-->

@stop
