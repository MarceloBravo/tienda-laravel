@if(Session::has('message'))
<div class="alert alert-{{ Session::has('type-message') ? Session::get('type-message') : 'info' }} alert-dismissible show" role="alert">
  <strong>Información !</strong> {{ Session::get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if($errors->any())
<div class="alert alert-{{ Session::has('type-message') ? Session::get('type-message') : 'info' }} alert-dismissible show" role="alert">
  <strong>Información !</strong>
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif