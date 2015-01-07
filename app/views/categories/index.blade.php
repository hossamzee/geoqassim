@extends('layouts.default')

@section('title', 'تصنيفات الأبحاث و الدراسات')
@section('content')

<!-- Categories -->
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>تصنيفات الأبحاث و الدراسات <small>({{ $categories->count() }})</small></h3>
                    </div>
                </div>
            </div>

    @if ($categories->count() == 0)
      <p>
          <i class="fa fa-warning"></i>
          لم يتم إضافة تصنيفات أبحاث و دراسات حتّى الآن.
      </p>

    @else

    <div class="row">
        <div class="col-md-12 lead">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>التصنيف</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ link_to_route('researches_index', $category['title'], [$category['id']]) }} <small>({{ count($category['researches']) }})</small></td>
                            <td><a href="{{  route('categories_like', [$category['id']]) }}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> {{ $category['likes_count'] }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- Categories end-->

    @endif
</div>
@stop
