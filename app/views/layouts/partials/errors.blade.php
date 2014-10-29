@if ($errors->any())
<!-- Errors -->
<a name="error"></a>
<div class="container">
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
</div>
@endif