@extends('layouts.app')

@section('header')
	@include('includes.header-bar2')
@endsection


@section('Content')

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Carro de compras</h3>
						<ul class="breadcrumb-tree">
							<li><a href="/">Home</a></li>
                            <li><a href="/detalle/{{ url()->previous() }}">Detalles</a></li>
                            <li class="active">Carro de compras</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					
					<!-- Order Details -->
					<div class="col-md-12 order-details">
						<div class="section-title text-center">
							<h3 class="title">Tu Carrito de compras</h3>
						</div>
						<div class="container-fluid">
						<div class="row">

							@if(count($carrito)>0)
								<div>
									<a class="btn btn-danger" href="/carrito/vaciar"><i class="fa fa-trash"></i> Vaciar el Carrito</a>
								</div>
								<br/>
								<div class="col-md-12">
									<table class="table table-bordered table-hover table-sm table-responsive">
										<thead>
											<tr>
												<th clas="col-imagen">Imagén</th>
												<th class="col-nombre">Producto</th>
												<th>Precio</th>
												<th class="col-cantidad">Cantidad</th>
												<th>Sub-Total</th>
												<th class="col-eliminar"></th>
											</tr>
										</thead>
										<tbody>
										
										@foreach($carrito as $item)
										
											<tr>
												<td class="col-imagen"><img src="{{ asset( $item->imagenes()->where('default','=',true)->first()->url ) }}"/></td>
												<td class="col-nombre">{{ $item->nombre }}</td>
												<td>$ {{ number_format($item->precio, 0) }}</td>
												<td>
													<input type="number" id="cant_{{ $item->id }}" class="input-cant" min="1"  max="100" value="{{ $item->cantidad }}" data-slug="{{ $item->slug }}"/>
												</td>
												<td>$ {{ number_format($item->precio * $item->cantidad, 0 )}}</td>
												<td><a class="btn btn-danger" href="/carrito/eliminar/{{ $item->slug }}"><i class="fa fa-remove"></i></a></td>
											</tr>
											@endforeach										
										</tbody>
									</table>
								</div>
								<div class="div-total">
									<label>Total: </label><span>$ {{ number_format($total, 0) }}</span>
								</diV>
							@else
								<div class="msg-empty-cart">
									<h3><span class="label label-warning">No hay productos en el carrito.</span></h3>
								</div>
							@endif
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<a href="/" class="primary-btn order-submit"><i class="fa fa-chevron-circle-left"></i> Seguir comprando</a>
							</div>
							<div class="col-md-6">
								<a href="/detalle-compra" class="primary-btn order-submit">Pagar <i class="fa fa-chevron-circle-right"></i></a>
							</div>						
						</div>
						
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/custom/carrito.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/pages/carrito.js') }}"></script>
@endsection