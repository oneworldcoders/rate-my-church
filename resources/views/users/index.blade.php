@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="offset-md-4">
                      <a class="btn btn-primary" href="{{ route('ratings.create') }}">Rate Church</a>
                      <a id="rate-button" class="btn btn-primary" href="{{ route('ratings.index') }}">View Ratings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
