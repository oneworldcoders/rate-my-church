@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.auth.errors')

      <div class="card">
        <div class="card-header">{{ __('Add a Question') }}</div>

          <div class="card-body">
            <form action="{{ route('questions.store') }}" method="POST">
              @csrf

              <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                <div class="col-md-6">
                  <input type="text" name="title" class="form-control" placeholder="Question Title">
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descriprion') }}</label>
                <div class="col-md-6">
                  <textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
                </div>
              </div>

              <div class="form-group row">
              <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                <div class="col-md-6">
                  <select name="type" id="type" class="form-control">
                    <option value="" disabled>Type of Question</option>
                    <option value="rate">Rating</option>
                  </select>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Add Question') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
