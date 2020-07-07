@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        @if ($questions)
          @include('includes.question.questions')  
        @else
          @include('includes.question.no_questions')
        @endif

      </div>
  </div>
</div>
@endsection
