@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($church_name)

                <br></br>
                <div class="card">
                    <div class="card-header">{{ $church_name }}</div>

                    <div class="card-body">
                        <form method="POST">
                            @csrf

                            @foreach ($questions as $question)
                                <div class="form-group row">
                                    <label for="  {{ $question->id }} " class="col-md-4 col-form-label text-md-right">{{ __($question->description ) }}</label>
                                    <div class="col-md-6">
                                        <input class="radio-inline m-2" type="radio" name=" {{ $question->id }} " value="1">1
                                        <input class="radio-inline m-2" type="radio" name=" {{ $question->id }} " value="2">2
                                        <input class="radio-inline m-2" type="radio" name=" {{ $question->id }} " value="3">3
                                        <input class="radio-inline m-2" type="radio" name=" {{ $question->id }} " value="4">4
                                        <input class="radio-inline m-2" type="radio" name=" {{ $question->id }} " value="5">5
                                        
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit Response') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                       
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>

            @endif

        </div>
    </div>
</div>
@endsection
