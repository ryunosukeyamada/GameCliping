@if ($errors -> any())
  <div class="card-text alert">
    @foreach ($errors->all() as $error)
    <h5 class="text-danger"> {{$error}} <span class="badge badge-danger">Error</span></h5>
    @endforeach
  </div>
@endif