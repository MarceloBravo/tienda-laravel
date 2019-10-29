@extends('layouts.app')

@section('header')
	@include('includes.header-bar')
@endsection

@section('Content')
    
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop01.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Laptop<br>Colección</h3>
								<a href="#" class="cta-btn">Comprar ahora <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop03.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Accesorios<br>Colección</h3>
								<a href="#" class="cta-btn">Comprar ahora <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop02.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Cámaras<br>Colección</h3>
								<a href="#" class="cta-btn">Comprar ahora <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION DESTACADOS -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Nuevos Productos</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
									<li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
									<li><a data-toggle="tab" href="#tab1">Cámaras</a></li>
									<li><a data-toggle="tab" href="#tab1">Accesorios</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										@foreach($destacados as $producto)
										<div class="product">
											<div class="product-img">
												<img src="{{ asset($producto->imagenes()->where('default','=',true)->first()->url ) }}" alt="">
												<div class="product-label">
													<span class="sale">-{{ number_format((100 / $producto->precio_anterior) * $producto->precio, 0) }}%</span>
													<span class="new">Nuevo</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{ $producto->categoria->nombre }}</p>
												<h3 class="product-name"><a href="#">{{ $producto->nombre }}</a></h3>
												<h4 class="product-price">${{ $producto->precio }}<del class="product-old-price"> ${{ $producto->precio_anterior }}</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													Ver detalle<button onclick="window.location = '/detalle/{{ $producto->id }}'" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Ver detalle</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<a class="add-to-cart-btn" href="/agregar/{{ $producto->slug }}">lo quiero</a>
											</div>
										</div>
										@endforeach
										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION DESTACADOS -->

		@foreach($ofertas as $oferta)
		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section" style="background-image: url({{ asset($oferta->src_imagen) }} );">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Días</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Horas</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Minutos</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Segundos</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">{{ $oferta->texto1 }}</h2>
							<p>{{ $oferta->texto2 }}</p>
							<a class="primary-btn cta-btn" href="#">Ver las ofertas</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->
		@endforeach

		@if(count($masVendidos) > 0)
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Mas vendidos</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
									<li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
									<li><a data-toggle="tab" href="#tab2">Cámeras</a></li>
									<li><a data-toggle="tab" href="#tab2">Accesorios</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										@foreach($masVendidos as $item) 
										<div class="product">
											<div class="product-img">												
												<img src="{{ $item->imagenes()->where('default','=',true)->first()->url }}" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{ $item->categoria->nombre }}</p>
												<h3 class="product-name"><a href="#">{{ $producto->nombre }}</a></h3>
												<h4 class="product-price">{{ $item->precio }} <del class="product-old-price">{{ $item->precio_anterior }}</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													Ver detalle<button onclick="window.location = '/detalle/{{ $item->id }}'" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Ver detalle</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<a class="add-to-cart-btn" href="/agregar/{{ $item->slug }}">lo quiero</a>												
											</div>
										</div>
										@endforeach
										<!-- /product -->
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		@endif
		

		@if(count($masVendidos2) > 0)
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Más vendidos</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						
						<div class="products-widget-slick" data-nav="#slick-nav-3">
						
						@foreach($masVendidos2 as $item)
							@if($item->fila == 1 || $item->fila == 4)
							<div>
							@endif
							
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="{{ $item->url }}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{ $item->id }} {{ $item->categoria }}</p>
										<h3 class="product-name"><a href="#">{{ $item->nombre }}</a></h3>
										<h4 class="product-price">$ {{ $item->precio }}<del class="product-old-price">$ {{ $item->precio_anterior }}</del></h4>
									</div>
								</div>
								<!-- /product widget -->
							
							@if($item->fila == 3 || $item->fila == 6)
							</div>
							@endif
						@endforeach
						
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		@endif

		@if(count($masVendidos3) > 0)
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Más vendidos</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						
						<div class="products-widget-slick" data-nav="#slick-nav-3">
							
						@foreach($masVendidos3 as $item)
							@if($item->fila == 1 || $item->fila == 4)
							<div>
							@endif
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="{{ $item->url }}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{ $item->categoria }}</p>
										<h3 class="product-name"><a href="#">{{ $item->nombre }}</a></h3>
										<h4 class="product-price">$ {{ $item->precio }}<del class="product-old-price">$ {{ $item->precio_anterior }}</del></h4>
									</div>
								</div>
								<!-- /product widget -->
							@if($item->fila == 3 || $item->fila == 6)
							</div>
							@endif
						@endforeach
						
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		@endif

		@if(count($masVendidos4) > 0)
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Más vendidos</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						
						<div class="products-widget-slick" data-nav="#slick-nav-3">
							
						@foreach($masVendidos4 as $item)
							@if($item->fila == 1 || $item->fila == 4)
							<div>
							@endif
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="{{ $item->url }}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{ $item->categoria }}</p>
										<h3 class="product-name"><a href="#">{{ $item->nombre }}</a></h3>
										<h4 class="product-price">$ {{ $item->precio }}<del class="product-old-price">$ {{ $item->precio_anterior }}</del></h4>
									</div>
								</div>
								<!-- /product widget -->
							@if($item->fila == 3 || $item->fila == 6)
							</div>
							@endif
						@endforeach
						
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		@endif
		
@endsection
