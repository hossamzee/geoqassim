
<script type="text/javascript" src="/assets/javascripts/jquery.form.min.js"></script>

<script type="text/javascript">

    $(function(){

        resetUpload();

        var options = {
                target: null,
                beforeSubmit: beforeSubmit,
                uploadProgress: OnProgress, //upload progress callback
                success: afterSuccess,
                error: afterError,
                resetForm: true
        };

        $('#upload-form').submit(function() {
            $(this).ajaxSubmit(options);
            return false;
        });
    });

    function beforeSubmit()
    {
        $('#progress-div').show();

        $('#upload-status-div').html('تجري محاولة رفع الرمّة إلى الخادم...');
        $('#upload-status-div').show();

        $('#upload-div').hide();
    }

    function OnProgress(event, position, total, percentComplete)
    {
        $('#progress').attr('aria-valuenow', percentComplete);
        $('#progress').width(percentComplete + '%');
    }

    // function afterSuccess(response)
    // {
    //     // Get the URL.
    //     var url = response.url;
    //
    //     $('#progress').removeClass('active');
    //     $('#progress').addClass('progress-bar-success');
    //     $('#upload-div').html('تم رفع الرمّة بنجاح و إدراج رابط النشرة في الأسفل.<br /><a target="_blank" href="' + url + '" class="btn btn-link">' + url + '</a>');
    //
    //     // Set the value of the field.
    //     $('#url').val(url);
    // }

    function afterError(response)
    {
        $('#progress').removeClass('active');
        $('#progress').addClass('progress-bar-danger');
        $('#upload-status-div').html('<div>لا يمكن رفع الرمّة ، إمّا لخطأ في الإدخال أو لخطأ في الخادم.</div><br /><div><a class="btn btn-default" href="#" onclick="resetUpload()">رفع رمّة أخرى</a></div>');
    }

    function resetUpload()
    {
        $('#upload-div').show();
        $('#upload-status-div').hide();

        $('#progress-div').hide();

        $('#progress').attr('aria-valuenow', 0);
        $('#progress').width('0');

        $('#progress').removeClass('progress-bar-danger');
    }

</script>

<div class="row well">
    <div class="col-md-12" id="upload-div">
        {{ Form::open(['route' => 'admin_rummahs_upload', 'files' => true, 'id' => 'upload-form']) }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('title', 'ملف PDF (اختياري)') }}
                        {{ Form::file('pdf') }}
                        <p class="help-block">في حال لم يتم رفع النشرة إلى أيّ خادم آخر؛ قم برفع الملف من هنا.</p>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    {{ Form::submit('رفع ملف PDF', ['class' => 'btn btn-default']) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
    <div class="col-md-12" id="upload-status-div"></div>
</div>
