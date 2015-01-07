@extends('layouts.default')

@section('title', 'الأبحاث و الدراسات - ' . $category->title)
@section('content')

<!-- Researches -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>
                          {{ link_to_route('categories_index', 'تصنيفات الأبحاث و الدراسات') }} - {{ $category->title }}
                          <small>({{ $researches->count() }})</small>
                        </h3>
                    </div>
                </div>
            </div>

      @if ($researches->count() == 0)
      <p>
          <i class="fa fa-warning"></i>
          لم يتم إضافة بحث و دراسة حتّى الآن.
      </p>
      @else

      <div class="row">
        <div class="col-md-12 lead">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-7">البحث و الدراسة (سنة النشر)</th>
                        <th>المؤلف</th>
                        <th class="col-md-2">الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($researches as $research)
                        <tr>
                            <td>{{ link_to_route('researches_show', $research->title, [$research['category_id'], $research['id']]) }} <small>({{ $research->publish_year }})</small></td>
                            <td>{{ $research->author }}</td>
                            <td>
                              <a href="{{ route('researches_show', [$research['category_id'], $research->id]) }}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                              <a href="#" class="btn btn-default"><i class="fa fa-eye"></i> {{ $research->views_count }}</a>
                              <a href="{{ route('researches_like', [$research->id]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $research->likes_count }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- Categories end-->
      @endif

</div><!-- Researches end-->

@stop
