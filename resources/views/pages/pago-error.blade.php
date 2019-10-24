@extends('layouts.app')

@section('Content')

<div class="alert alert-danger center" role="alert">
  <h4 class="alert-heading">Error!</h4>
  @if(Session::has('message'))
  <p>{{ Session::get('message') }}</p>
  @else
    <p>Ocurrió un error al efectuar la transacción.<br/>La compra no pudo ser finalizada.</p>
  @endif
</div>
<div class="center">
    <a href="/" class="primary-btn order-submit">Aceptar</a>
</div>

@endsection


@section('style')
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('css/pago-error.css') }}" rel="stylesheet"/>
@endsection