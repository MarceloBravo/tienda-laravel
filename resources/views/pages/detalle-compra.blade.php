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
						<h3 class="breadcrumb-header">Detalle de la compra</h3>
						<ul class="breadcrumb-tree">
							<li><a href="/">Home</a></li>
                            <li><a href="/detalle/{{ url()->previous() }}">Detalles</a></li>
                            <li class="active">Detalle de la compra</li>
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
							<h3 class="title">Detalle de la compra</h3>
						</div>
						<div class="container-fluid">
                            <div class="row">

                                @if(count($carrito)>0)
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-md-2">Nombre</label>
                                            <div class="col-md-10">
                                                {{ \Auth::user()->nombre }} {{ \Auth::user()->a_paterno }} {{ \Auth::user()->a_materno }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-2">Dirección</label>
                                            <div class="col-md-10">
                                                {{ \Auth::user()->direccion }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-md-2">Ciudad</label>
                                            <div class="col-md-10">
                                                {{ \Auth::user()->ciudad()->first()->nombre }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-2">Email</label>
                                            <div class="col-md-10">
                                                {{ \Auth::user()->email }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-2">Fono</label>
                                            <div class="col-md-10"> 
                                                {{ \Auth::user()->fono }}
                                            </div>
                                        </div>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach($carrito as $item)
                                            
                                                <tr>
                                                    <td class="col-imagen"><img src="{{ asset( $item->imagenes()->where('default','=',true)->first()->url ) }}"/></td>
                                                    <td class="col-nombre">{{ $item->nombre }}</td>
                                                    <td>$ {{ number_format($item->precio, 0) }}</td>
                                                    <td>{{ $item->cantidad }}</td>
                                                    <td>$ {{ number_format($item->precio * $item->cantidad, 0 )}}</td>
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

                            <div class="row col-md-offset-2">
                                <div class="col-md-4">
                                    <a href="/carrito" class="primary-btn order-submit"><i class="fa fa-chevron-circle-left"></i> Volver al carrito</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="/payment" class="primary-btn order-submit">Pagar con Paypal <i class="fa fa-paypal"></i></a>
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