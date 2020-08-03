<div class="accordion" id="accordionExample">
  @foreach($religions as $religion)
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <span class="col text-dark" type="button" data-toggle="collapse" data-target="#collapse{{$religion->id}}" aria-expanded="false" aria-controls="collapse{{$religion->id}}">
            Religion: {{$religion->name}}
          </span>
        </h5>
      </div>

      <div id="collapse{{$religion->id}}" class="collapse">
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach($religion->churches as $church)
              <li class="list-group-item">
                {{ $church->name }}
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endforeach
</div>

