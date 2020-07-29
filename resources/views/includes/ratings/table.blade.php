<div class="accordion" id="accordionExample">
  @foreach($chart_data['labels'] as $label)
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <span class="col text-dark" type="button" data-toggle="collapse" data-target="#collapse{{$label}}" aria-expanded="false" aria-controls="collapse{{$label}}">
            Score: {{$label}}
          </span>
        </h5>
      </div>

      <div id="collapse{{$label}}" class="collapse">
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach($ratings->where('score', $label)->all() as $rating)
              <li class="list-group-item">
                {{ $rating->user_name }}
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endforeach
</div>

