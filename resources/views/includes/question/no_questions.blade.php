<div class="card">
  <div class="card-header">Dashboard</div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif

    No Questions yet for {{ $church->name }}
  </div>
</div>
