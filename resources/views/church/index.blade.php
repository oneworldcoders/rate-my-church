@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.success')
      @include('includes.search_bar')
      
      <div class="card">
        <div class="card-header">{{ __('Churches') }}</div>

        <div class="card-body">
          @include('includes.church.table')
          @can('create', App\Church::class)
          <br><br>
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
  src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap">
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
      label: String(Math.round(averages[i])),
      churchId: churchIds[i],
      contentString: '<div>' +
                      'Name of Church: ' + churchNames[i]  +'<br>' +
                      'Address: ' + location.fullname + '<br>' +
                      'Average rating: ' + averages[i] + '<br>' +
                      '<div>'
    });
  });

  let markerCluster = new MarkerClusterer(map, markers,
      {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

  markers.forEach(marker => {
    let infoWindow = new google.maps.InfoWindow({
      content: marker.contentString,    
    })

    new google.maps.event.addListener(marker, 'mouseover', function() {
      infoWindow.open(map, marker);
    });

    new google.maps.event.addListener(marker, 'mouseout', function() {
      infoWindow.close(map, marker);
    });

    new google.maps.event.addListener(marker, 'click', function() {
      window.location.href = "/churches/"+this.churchId;
    });
  });
}
let averages = {!! json_encode(App\Church::all_overall_averages($churches)) !!}
let churchNames = {!! json_encode(App\Church::all_church_names($churches)) !!};
let locations = {!! json_encode(App\Church::all_church_addresses($churches), JSON_NUMERIC_CHECK) !!};
let churchIds = {!! json_encode(App\Church::all_church_ids($churches)) !!}
</script>



@endsection
