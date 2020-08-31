@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          <div class="row mx-auto">
            @can('viewAny', App\RoleUser::class)
              <div class="card m-2" style="width: 14rem;">
                <h5 class="mx-auto pt-2 card-title">Permissions</h5>
                <a href="{{ route('permissions.index') }}"><img class="card-img-top" src={{url('assets/permission.svg')}} alt="Permission image"></a>
              </div>
            @endcan
            @can('viewAny', App\Church::class)
              <div class="card m-2 p-2" style="width: 14rem;">
                <h5 class="mx-auto pt-2 card-title">Churches</h5>
                <a href="{{ route('churches.index') }}"><img class="card-img-top" src={{url('assets/church.svg')}} alt="Church image"></a>
              </div>
            @endcan
            @can('viewAny', App\Question::class)
              <div class="card m-2 p-2" style="width: 14rem;">
                <h5 class="mx-auto pt-2 card-title">Questions</h5>
                <a href="{{ route('questions.index') }}"><img class="card-img-top" src={{url('assets/question.svg')}} alt="Question image"></a>
              </div>
            @endcan
            @can('viewAny', App\Survey::class)
              <div class="card m-2" style="width: 14rem;">
                <h5 class="mx-auto pt-2 card-title">Surveys</h5>
                <a href="{{ route('surveys.index') }}"><img class="card-img-top" src={{url('assets/survey.svg')}} alt="Survey image"></a>
              </div>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
