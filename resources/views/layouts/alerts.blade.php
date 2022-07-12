@if(session()->get('message'))
<div class="alert alert-success dark alert-dismissible fade show" role="alert">
        {{ session()->get('message')}}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->get('error'))
<div class="alert alert-danger dark alert-dismissible fade show" role="alert">
      <strong class="m-l-20">Whoops!</strong> {!! session()->get('error') !!}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->get('warning'))
<div class="alert alert-warning dark alert-dismissible fade show" role="alert">
      {!! session()->get('warning') !!}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->get('welcomeback'))
<div class="alert alert-success dark alert-dismissible fade show" role="alert">
      <strong class="m-l-20">Great!</strong> {{ session()->get('welcomeback')  }} &#128515
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-warning dark alert-dismissible fade show" role="alert">
      @foreach($errors->all() as $error)
            {{ $error }}<br>
      @endforeach
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
