@extends('layouts.app')

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
							<div class="col-md-12">
								<table class="table table-bordered table-hover table-sm table-responsive">
									<thead>
										<tr>
											<th clas="col-imagen">Imagen</th>
											<th>Producto</th>
											<th>Precio</th>
											<th>Cantidad</th>
											<th>Sub-Total</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									@foreach($carrito as $item)		
										<tr>
											<td class="col-imagen"><img src="{{ asset( $item->imagenes()->where('default','=',true)->first()->url ) }}"/></td>
											<td>{{ $item->nombre }}</td>
											<td>{{ number_format($item->precio, 0) }}</td>
											<td>{{ $item->cantidad }}</td>
											<td>{{ number_format($item->precio * $item->cantidad, 0 )}}</td>
											<td><a class="btn btn-danger"><i class="fa fa-remove"></i></a></td>
										</tr>
										@endforeach										
									</tbody>
								</table>
							</div>
						</div>

						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<a href="#" class="primary-btn order-submit">Place order</a>
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
<!-- Bootstrap -->
<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
<!-- Slick -->
<link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}"/>
<!-- nouislider -->
<link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>
<!-- Font Awesome Icon -->
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<!-- Custom stlylesheet -->
<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="{{ asset('css/custom/carrito.css') }}">
@endsection

@section('script')
<!-- jQuery Plugins -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/nouislider.min.js') }}"></script>
<script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection