@extends('layouts.admin.default')

@section('title', 'تعديل فيديو - '. $video->title)
@section('content')

<!-- TODO: Handle errors whenever they occur. -->

<script type="text/javascript">

function getYoutubeVideoDetails(url)
{
    var id = extractYoutubeVideoId(url);

    $.ajax({
        type: 'GET',
        url: 'http://gdata.youtube.com/feeds/api/videos/' + id,
        dataType: 'xml',
        success: function (xml){

            var entry = $(xml).find('entry').first();
            var title = entry.find('title').first().text();
            var description = entry.find('description').first().text();

            // Set the values on the other fields.
            $('#v_title').val(title);
            $('#v_description').val(description);
        }
    });
}

function extractYoutubeVideoId(url)
{
    var parsedUrl = parseURL(url);
    return parsedUrl.searchObject['v'];
}

// TODO: This method should be moved to top level.
function parseURL(url)
{
    var parser = document.createElement('a'),
        searchObject = {},
        queries, split, i;

    // Let the browser do the work
    parser.href = url;

    // Convert query string to object
    queries = parser.search.replace(/^\?/, '').split('&');

    for(i=0; i<queries.length; i++)
    {
        split = queries[i].split('=');
        searchObject[split[0]] = split[1];
    }

    return {
        protocol: parser.protocol,
        host: parser.host,
        hostname: parser.hostname,
        port: parser.port,
        pathname: parser.pathname,
        search: parser.search,
        searchObject: searchObject,
        hash: parser.hash
    };
}

$(function(){

    $('#v_url').change(function(){
        getYoutubeVideoDetails($(this).val());
    });

});
</script>

<!-- Edit video -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>تعديل فيديو - {{$video->title }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => ['admin_videos_update', $video->id]]) }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('url', 'الرابط') }}
                            {{ Form::text('url', $video->url, ['class' => 'form-control', 'id' => 'v_url']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('title', 'العنوان') }}
                            {{ Form::text('title', $video->title, ['class' => 'form-control', 'id' => 'v_title']) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('description', 'الوصف') }}
                            {{ Form::textarea('description', $video->description, ['class' => 'form-control', 'id' => 'v_description']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        {{ Form::submit('تعديل الفيديو', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div><!-- Edit video end-->

@stop
