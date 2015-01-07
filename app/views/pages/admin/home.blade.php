@extends('layouts.admin.default')

@section('title', 'الرئيسية')
@section('content')

<!-- Pages -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>
                  مرحباً {{ $user->username }}
                  <div class="pull-left">
                    {{ link_to_route('users_changepassword_get', 'تغيير كلمة المرور', null, ['class' => 'btn btn-default']) }}
                    {{ link_to_route('home', 'زيارة الصفحة الرئيسية', null, ['class' => 'btn btn-info']) }}
                  </div>
                </h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
          <div class="well">
            <h3>الأخبار <small>({{ $news_count }})</small></h3>
            <p>
                إدارة الأخبار من خلال الإضافة أو التعديل أو الحذف، يظهر آخر خبر مضاف في الصفحة الرئيسية للموقع.
            </p>
            <p>
                {{ link_to_route('admin_news_index', 'عرض', null, ['class' => 'btn btn-default']) }}
                {{ link_to_route('admin_news_create', 'إضافة', null, ['class' => 'btn btn-primary']) }}
            </p>
          </div>
        </div>
        <div class="col-md-3">
            <h3>الصور <small>({{ $albums_count }}/{{ $photos_count }})</small></h3>
            <p>
                إدارة الألبومات و الصور من خلال الإضافة أو التعديل أو الحذف، يظهر عدد الألبومات متبوعاً بعدد الصور الإجمالي.
            </p>
            <p>
                {{ link_to_route('admin_albums_index', 'عرض', null, ['class' => 'btn btn-default']) }}
                {{ link_to_route('admin_albums_create', 'إضافة', null, ['class' => 'btn btn-primary']) }}
            </p>
        </div>
        <div class="col-md-3">
            <h3>الفيديو <small>({{ $videos_count }})</small></h3>
            <p>
                إدارة الفيديوهات من خلال الإضافة باستخدام رابط Youtube دون الحاجة إلى تعبئة تفاصيل إضافيّة، كما أنّ هناك إمكانيةً للتعديل أو الحذف.
            </p>
            <p>
                {{ link_to_route('admin_videos_index', 'عرض', null, ['class' => 'btn btn-default']) }}
                {{ link_to_route('admin_videos_create', 'إضافة', null, ['class' => 'btn btn-primary']) }}
            </p>
        </div>
        <div class="col-md-3">
            <h3>الصفحات <small>({{ $pages_count }})</small></h3>
            <p>
                إدارة الصفحات من الإضافة أو التعديل أو الحذف، هذه الصفحات لم يحدّد سلوكها، بل يمكن أن تحتوي هذه الصفحة أيّ شيء.
            </p>
            <p>
                {{ link_to_route('admin_pages_index', 'عرض', null, ['class' => 'btn btn-default']) }}
                {{ link_to_route('admin_pages_create', 'إضافة', null, ['class' => 'btn btn-primary']) }}
            </p>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-3">
            <h3>الرمّة <small>({{ $rummahs_count }})</small></h3>
            <p>
                إدارة نشرات الرّمة من خلال الإضافة أو التعديل أو الحذف، يتطلب الأمر رفع ملف النشرة (PDF) سابقاً تفاديّاً لمشاكل التأخير بالنسبة للملفات ذات الأحجام الكبيرة.
            </p>
            <p>
                {{ link_to_route('admin_rummahs_index', 'عرض', null, ['class' => 'btn btn-default']) }}
                {{ link_to_route('admin_rummahs_create', 'إضافة', null, ['class' => 'btn btn-primary']) }}
            </p>
        </div>
        <div class="col-md-3">
            <h3>الأعضاء <small>({{ $members_count }})</small></h3>
            <p>
                إدارة الأعضاء من خلال الإضافة أو التعديل أو الحذف، ينبغي مراعاة الفارق ما بين الأعضاء و المستخدمين، حيث أنّ الأوّل يمثّل من يظهر للعلن في صفحة الأعضاء.
            </p>
            <p>
                {{ link_to_route('admin_members_index', 'عرض', null, ['class' => 'btn btn-default']) }}
                {{ link_to_route('admin_members_create', 'إضافة', null, ['class' => 'btn btn-primary']) }}
            </p>
        </div>

        @if ($user->role == 'admin')
        <div class="col-md-3">
            <h3>المستخدمون <small>({{ $users_count }})</small></h3>
            <p>
                إدارة المستخدمين من خلال الإضافة أو التعديل أو الحذف، لا يملك صلاحيّة الوصول إلى هذه الصفحة غير المدراء.
            </p>
            <p>
                {{ link_to_route('admin_users_index', 'عرض', null, ['class' => 'btn btn-default']) }}
                {{ link_to_route('admin_users_create', 'إضافة', null, ['class' => 'btn btn-primary']) }}
            </p>
        </div>
        @endif
        <!--<div class="col-md-3">
            <h3>القائمة البريديّة <small>({{ $subscribers_count }})</small></h3>
            <p>
                إرسال رسائل إلى القائمة البريديّة، مع إمكانيّة معرفة حالة قراءة الرسالة من عدمها، و غيرها.
            </p>
            <p>
                {{ link_to_route('admin_newsletters_index', 'عرض المشتركين', null, ['class' => 'btn btn-default']) }}
                <a href="#" class="btn btn-primary disabled">إرسال رسالة</a>
            </p>
        </div>-->
        <div class="col-md-3">
            <h3>الداراسات و الأبحاث <small>({{ $researches_count }})</small></h3>
            <p>
                إدارة الدراسات و الأبحاث من خلال الإضافة أو التعديل أو الحذف، يتطلب الأمر رفع الدراسة و البحث (PDF) سابقاً تفاديّاً لمشاكل التأخير بالنسبة للملفات ذات الأحجام الكبيرة.
            </p>
            <p>
                {{ link_to_route('admin_categories_index', 'عرض', null, ['class' => 'btn btn-default']) }}
                {{ link_to_route('admin_categories_create', 'إضافة', null, ['class' => 'btn btn-primary']) }}
            </p>
        </div>

    </div>

</div><!-- Pages end -->

@stop
