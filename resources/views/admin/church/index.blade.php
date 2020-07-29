@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">{{ __('Churches') }}</div>

        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach ($churches as $church)
              <li class="list-group-item">
                <a href="{{ route('churches.show', $church) }}">{{ $church->name }}</a>
              </li>
            @endforeach
          </ul>

          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('churches.create') }}">Add a Church</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div id="map" style="width: 100%; height: 450px;"> </div>

</div>

 <!-- Google Maps -->
 <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclustererplus@4.0.1.min.js"></script>

<script defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKt4p3f8Opos-7Y2W7uOHpyKUcyYA6Cjw&callback=initMap">
</script>

<script>
let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -1.944960, lng: 30.062040 },
    zoom: 8
  });

  let markers = locations.map(function(location, i) { return new google.maps.Marker({
      position: location,
      label: labels[i % labels.length][0]
    });
  });

  let markerCluster = new MarkerClusterer(map, markers,
      {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}

let labels = {!! json_encode($churches->pluck('name')->all()) !!};
let locations = {!! json_encode($addresses, JSON_NUMERIC_CHECK) !!};

</script>



@endsection
