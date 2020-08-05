@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.auth.errors')

      <div class="card">
        <div class="card-header">{{ __('Add a Church') }}</div>

          <div class="card-body">
            <form action="{{ route('churches.store') }}" method="POST">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Name of Church">
                </div>
              </div>

              <div class="form-group row">
                <label for="religion" class="col-md-4 col-form-label text-md-right">{{ __('Religion') }}</label>

                <div class="col-md-6">
                  <select name="religion_id" id="church_id" class="form-control" required>
                    <option value="" disabled>Choose a Religion</option>
                    <option value="">{{ __('None') }}</option>


                    @foreach ($religions as $religion)
                      <option value=" {{ $religion->id }} ">{{ $religion->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

             <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                <div class="col-md-6">
                  <input id="address" type="text" name="address[fullname]" class="form-control" placeholder="Full Address" required onchange="checkAddress(this.value)">
                </div>
              </div>

              <div class="row justify-content-md-center">
                <span id="address-error" class="text-danger"></span>
              </div>

              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Latitude') }}</label>
                <div class="col-md-6">
                  <input id='lat' type="text" name="address[lat]" class="form-control" placeholder="Latitude" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Longitude') }}</label>
                <div class="col-md-6">
                  <input id='lng' type="text" name="address[lng]" class="form-control" placeholder="Longitude" readonly>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Add Church') }}
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

<script>

function checkAddress(fullAddress)
{
  fetch('https://nominatim.openstreetmap.org/search/'+ encodeURIComponent(fullAddress) + '?format=json&addressdetails=1&limit=1')
  .then(response => response.json())
  .then(data => {
    if(data.length === 0){
      document.getElementById('address-error').innerHTML = "couldn't find address";
      document.getElementById('lat').value = "";
      document.getElementById('lng').value = "";
    } else {
      document.getElementById('address-error').innerHTML = ""
      document.getElementById('lat').value = data[0].lat;
      document.getElementById('lng').value = data[0].lon;
    }
  });
}
</script>


@endsection
