@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">{{ __('Churches') }}</div>

        <div class="card-body">
          @include('includes.church.table')
          @can('create', App\Church::class)
            <div class="offset-md-4">
              <a class="btn btn-primary" href="{{ route('churches.create') }}">Add a Church</a>
            </div>
          @endcan
        </div>
      </div>
      
      <div id="map" style="width: 100%; height: 800px;"> </div>
    </div>
  </div>
  

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
    zoom: 9
  });

  let markers = locations.map(function(location, i) { return new google.maps.Marker({
      position: location,
      label: labels[i % labels.length][0]
    });
  });

  let markerCluster = new MarkerClusterer(map, markers,
      {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}

let labels = {!! json_encode(App\Religion::all_church_names($religions)) !!};
let locations = {!! json_encode(App\Religion::all_church_addresses($religions), JSON_NUMERIC_CHECK) !!};
console.log(locations)
</script>



@endsection
