
@if (Session::has('error_message') || Session::has('success_message') || Session::has('warning_message'))

<!-- Messages -->
<script type="text/javascript">
    $(function() {
        $(".notification").show().delay(3000).fadeOut();
    });
</script>

@if (Session::has('error_message'))
<div class="alert alert-danger notification" role="alert">
      <strong>خطأ</strong> {{ Session::get('error_message') }}
</div>
@endif

@if (Session::has('success_message'))
<div class="alert alert-success notification" role="alert">
      <strong>نجاح</strong> {{ Session::get('success_message') }}
</div>
@endif

@if (Session::has('warning_message'))
<div class="alert alert-warning notification" role="alert">
      <strong>تحذير</strong> {{ Session::get('warning_message') }}
</div>
@endif

@endif

@if (Session::has('info_message'))
<div class="alert alert-info static-notification" role="alert">
      <strong>معلومة</strong> {{ Session::get('info_message') }}
</div>
@endif
