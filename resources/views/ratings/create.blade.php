@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
        @if (count($survey->questions) > 0)
          @include('includes.question.questions')  
        @else
          @include('includes.question.no_questions')
        @endif

      </div>
  </div>
</div>
@endsection
